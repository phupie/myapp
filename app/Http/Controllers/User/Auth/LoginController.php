<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profile;
use Socialite;

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
    
    public function redirectPath()
    {
        if (isset(auth()->user()->profile)) {
            return '/';
        } else {
            return 'user/home';
        }
    }
    
    public function redirectToGoogle()
    {
        // Google へのリダイレクト
        return Socialite::driver('google')->redirect();
    }
    
    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();
        $user = User::firstOrNew(['email' => $googleUser->email]);

        if (!$user->exists) {
            $user['name'] = $googleUser->getNickName() ?? $googleUser->getName() ?? $googleUser->getNick();
            $user['email'] = $googleUser->email; // Gmailアドレス
            $user['password'] = str_random(); // 適当に生成

            $user->save();
        }

        Auth::login($user);
        return redirect()->route('user.galleries.index');
    }
}
