<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use Auth;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    //credentials for auth login
    /*protected function getCredentials(Request $request)
    {
        return [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
    }*/

    //change auth login with username account
    public function username()
    {
        return 'user_name';
    }

    protected function login(Request $request)
    {

        if (auth()->attempt(array('user_name' => $request->input('user_name'), 'password' => $request->input('password'))))
        {
            if(auth()->user()->is_activated == '0'){
                Auth::logout();
                return redirect('login')->with('warning',"First please active your account.");
            } else {
                return redirect()->to('home');
            }
        } else{
            return back()->with('warning','your username and password are wrong.');
        }
    }

}
