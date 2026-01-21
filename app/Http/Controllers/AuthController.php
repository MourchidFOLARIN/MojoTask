<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
class AuthController extends Controller
{
    public function login(){
     return view('auth.login');
    }
    public function register(){
        return view('auth.register');
    }
    public function loginPost(Request $request){
        $request->validate([
            
            'email' => 'required',
            'password' => 'required'
        ]);
        $credentials=$request->only('email','password');
        $remember=$request->has('remember');
        if(Auth::attempt($credentials,$remember))
            {
                $request->session()->regenerate();
                return redirect()->intended(route('home'));
            }
        return to_route('login')->with('error' , 'Email ou mot de passe incorrect')->withInput();

    }
    public function registerPost(Request $request){
     $request->validate
     ([
        'name'=>'required|max:255',
        'email'=>'required|email|unique:users,email|max:255',
        'password' => [
        'required',
        'string',
        'min:6',
        'confirmed',
        'regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'],
     ],
     );
      $user = User::create(
        [
          'name'=>$request->name,
          'email'=>$request->email,
          'password'=>$request->password,
          'google_id'=>null
        ]
      );
      Auth::login($user);
      return to_route('home')->with('success',"Bienvenue $request->name votre compte a été crée avec succes");
    }
    public function redirectToGoogle(){
         return Socialite::driver('google')
         ->redirect();
    }
    public function handleGoogleCallback(){
         try {
        $googleUser = Socialite::driver('google')->user();
           } 
        catch (\Exception $e) {
           return redirect()->route('login')
            ->with('error', 'Connexion Google annulée ou échouée');
         }
         $user=User::where('google_id',$googleUser->id)->first();
         if(!$user){
          $user=User::where('email',$googleUser->email)->first();
         }
         if(!$user){
          $user=User::create([
           'name'=>$googleUser->name,
           'password'=>null,
           'google_id'=>$googleUser->id,
           'email'=>$googleUser->email
          ]);
          
         }
         else{
        $user->update([
            'google_id' => $googleUser->id,
        ]);
        }
         Auth::login($user,true);
         return redirect()->intended(route('home')) ->with('success',"Votre connexion a été reussir $googleUser->name");
      }
      

}
