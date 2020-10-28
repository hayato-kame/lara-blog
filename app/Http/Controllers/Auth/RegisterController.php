<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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

    // トレイトを取り込んでいる、
    // showRegistrationForm アクションと register アクションはRegistersUsersトレイトに定義されてるから、そのまま取り込んでる
    
    // register() の中ではログインも自動的に実行されます（参考：RegisterUsers.php）
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     * ユーザ登録が完了すると、ログイン状態になった上で、指定のリダイレクト先へ飛ぶようになっています。
     * そのリダイレクト先は $redirectTo 変数に設定されている定数 RouteServiceProvider::HOME で定義されています。
     * app/Providers/RouteServiceProvider.php を開いて、以下のように修正します。
     * public const HOME = '/';
     * 
     * これでリダイレクト先がトップページになります
     * 
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


    /**
     * Create a new controller instance.
     * ミドルウェアは コントローラのアクションが実行される前（後）に実行される前処理（後処理）
     * 全アクションに guest ミドルウェアを指定していることになります
     * ゲスト（guest）とは、ログインしていない閲覧者
     * 
     * guest は エイリアス（ニックネームのようなもの）
     * 
     * guest の定義は App\Http\Kernel クラスで確認できます
     * これを読むと guest の正体は \App\Http\Middleware\RedirectIfAuthenticated というクラスであることがわかります。
     * 
     * app/Http/Middleware/RedirectIfAuthenticated.php　を見ると
     * 
     * ログイン済みの場合は RouteServiceProvider::HOME にリダイレクトさせています。リダイレクト先はユーザ登録成功後と同じです
     * 
     * guest ミドルウェアは、アクションの実行前にログイン状態を確認し、
     * ログインしていない場合はそのまま実行させますが
     * 、ログインしている場合は実行させず別のURLへ飛ばします。
     * RegisterController や LoginController これらのコントローラでは、
     * ゲストにだけユーザ登録やログインを実行させるため guest ミドルウェアを指定している
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    /**
     * Get a validator for an incoming registration request.
     * validator() では、ユーザ登録の際のフォームデータのバリデーションを行っています。
     * 
     * RegistersUsersトレイトのregisterメソッドの中身を見ると、 validator() を呼び出しているのがわかります。
     * 
     * RegisterControllerの中で validator() を実装することで、ユーザ登録時のバリデーション処理の内容を定義しています。
     * 
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     * 名前がややこしいのですが、これはRESTfulなアクション7つの内の1つであるcreateアクションではなく、
     * Userを新規作成しているメソッドになります。
     * これもRegistersUsersトレイトのregisterメソッドの中で呼び出されているのがわかります。
     * 
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}


/**
 * 
 * RegisterController => RegistersUsersへと辿りました。
 * そしてRegistersUsersを見ると showRegistrationForm() が定義されており、
 * 中には return view('auth.register'); の1行だけが記述されていることがわかります。
 * 
 * showRegistrationForm() アクションは、
 * ただ単に resources/views/auth/register.blade.php を表示するアクションだ
 * 
 * ユーザを登録するためのModelとControllerは最初から用意されているのですが、
 * 
 * Routingの設定は以下のようにしました。
 * 
 * // ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
 * 
 * あとは用意されていない auth/ フォルダと register.blade.php を作成するだけでユーザ登録が動作します
 * では、authフォルダと、register.blade.php を作りましょう
 * 
 * 
 * 
 * register() の中ではログインも自動的に実行されます（参考：RegisterUsers.php）
 * 
 */ 