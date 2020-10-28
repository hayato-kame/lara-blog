<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


// 追加 これがないとダメ
use App\User;
use App\Http\Controllers\Auth;

// インポートを追加.自分のemailアドレスはチェック対象外にしたい 一意チェックに、除外条件も追加できます。ここではwhereNotを利用します。
use Illuminate\Validation\Rule;


class AccountsController extends Controller
{
    public function show() // ここでは引数いらない
    {
        
        $user = \Auth::user();

        // アカウント！！詳細ビューでそれを表示
        return view('accounts.show', [
            'user' => $user,
            
            ]);
    }
    
    public function edit()
    {
        $user = \Auth::user();
        
        return view('accounts.edit', [
            'user' => $user,
            
            ]);
    }
    
    // 自分のemailアドレスはチェック対象外にしたい  、なにも更新せずに、更新ボタンを押しても、通るように
    //  一意チェックに、除外条件も追加できます。ここではwhereNotを利用します。// インポートを追加  use Illuminate\Validation\Rule;

    public function update(Request $request)
    {
        // 自分のメールアドレス  Authの前に\ が無いとダメ
        $myEmail = \Auth::user()->email;
        
        // バリデーション
        $request->validate([
            'name' => 'required|max:255',
             // usersテーブルのemailカラムについて、
              // 「email != $myEmail」のレコードに対して、一意チェックを行う  Rule::unique('users', 'email')->whereNot('email', $myEmail)
              'email' => [Rule::unique('users', 'email')->whereNot('email', $myEmail), 'required', 'string', 'email', 'max:255'],
              
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            
            ]);
        
        // idで探すのではなくて認証ユーザをさがす
        $user = \Auth::user();
        
        // ユーザを更新する
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        
        // ユーザアカウント詳細へリダイレクト
        return view('accounts.show', [
            'user' => $user,
            ]);
    }
}
