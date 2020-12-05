<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Cookie;
use App\User;

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
    protected $redirectTo = '/admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $credential = [
            'email'    => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($credential))
        {
            $user = User::where(["email" => $credential['email']])->first();
            
            Auth::login($user);

            Cookie::queue('email', $user->email, 120);
            Cookie::queue('password', $request->password, 120);

            return redirect()->route('home');
        }
        else
        {
            return redirect()->route('login')->with('failed', 'User not found');
        }
    }
}
