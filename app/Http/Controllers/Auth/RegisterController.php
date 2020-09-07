<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Profile;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $authuser= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $findId=User::all()->last()->id;
        $profile=new Profile();
        $profile->user_id= $findId;
        $profile->first_name= $data['name'];
        $profile->last_name=' ';
        $profile->phone='000-000-000';
        $profile->dob=now();
        $profile->gender='N0 Gender';
        $profile->field='No Field';
        $profile->country='';
        $profile->city='';
        $profile->photo='';
        $profile->website='www.example.com';
        $profile->status='😍😍😍 Lorem, ipsum dolor sit amet consectetur adipisicing elit. Debitis iure ratione, sapiente quam consectetur at, dolores aliquam quis a labore blanditiis incidunt nisi placeat quas voluptatibus. Nostrum minus omnis alias!';
        $profile->save();
        return $authuser;
    }
}
