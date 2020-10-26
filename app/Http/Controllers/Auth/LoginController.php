<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    //  AuthenticatesUsers トレイトを使っている
    //  Routerで設定した showLoginForm や login のアクションはAuthenticatesUsers トレイトに定義されています。
    
    //  ログイン成功後のリダイレクト先もユーザ登録成功後と同じ RouteServiceProvider::HOME に設定されています
    //  app/Http/Controllers/Auth/LoginController.phpを見ると　　protected $redirectTo = RouteServiceProvider::HOME;
    
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
}
