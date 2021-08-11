<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $this->middleware('guest:user')->except('logout');
    }
    
    protected function guard()
    {
        return Auth::guard('user');
    }
    
    public function showLoginForm()
    {
        return view('user.auth.login');
    }
    
    public function logout(Request $request)
    {
        Auth::guard('user')->logout();
        
        return $this->loggedOut($request);
    }
    
    public function loggedOut(Request $request)
    {
        return redirect(route('user.login'));
    }
    
    public function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
            'g-recaptcha-response' => 'required|captcha',
        ]);
    }
    
    //ログイン後のリダイレクト先
    public function redirectPath()
    {
        return 'user/profiles/create';
    }
}
