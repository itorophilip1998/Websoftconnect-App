<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\Console\Input\Input;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
 // ---------------------------------------------------------------------
    // github Provider
    public function githubProvider()
    {
        // get user from github
        $github_user=Socialite::driver('github')->user();
        dd($github_user);
        $user=User::where('email',$github_user->getEmail)->first();

        // login if has an account
        Auth::login($user);


        // regiter if has no account
        if(!$user)
        {
            $user=new user();
            $user->username=$github_user->getName;
            $user->email=$github_user->getEmail;
            $user->password=Hash::make($github_user->getId);
            $user->save();
            // login after registration
            Auth::login($user);
            return response()->json(['success'=>'Registered from github!'],200);
        }
        return response()->json(['success'=>'Loggedin from github!'],200);

    }
        // github Reidrect
    public function githubRedirect()
    {
        return Socialite::driver('github')->redirect();
    }
// ---------------------------------------------------------------------
       // google Provider
       public function googleProvider()
       {
           // get user from github
        $github_user=Socialite::driver('github')->user();
        $user=User::where('email',$github_user->getEmail)->first();

        // login if has an account
        Auth::login($user);


        // regiter if has no account
        if(!$user)
        {
            $user=new user();
            $user->username=$github_user->getName;
            $user->email=$github_user->getEmail;
            $user->password=Hash::make($github_user->getId);
            $user->save();
            // login after registration
            Auth::login($user);
            return response()->json(['success'=>'Registered from github!'],200);
        }
        return response()->json(['success'=>'Loggedin from github!'],200);
       }
           // google Reidrect
       public function googleRedirect()
       {
           return Socialite::driver('google')->redirect();
       }


}
