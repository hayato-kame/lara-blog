<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



// ごっそりRegisterController からコピーしてきた
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


// 追加 これがないとダメ
use App\User;
use App\Http\Controllers\Auth;

// インポートを追加   条件追加
use Illuminate\Validation\Rule;



class PasswordController extends Controller
{
   
    
    public function show() // passwordは見せないから、対応するビューはいらないから　アカウント修正の手順とはここが違う
    {
        // リダイレクトさせるにはredirect関数にパスを指定する方法
        return redirect('accounts.show'); // 誘導してる
    }
    
    
    public function edit()
    {
        $user = \Auth::user();
        
        return view('password.edit', [
            'user' => $user,
            
            ]);
    }
    
    public function update(Request $request)
    {
        $user = \Auth::user();
        
        // 自分のハッシュされたパスワード     Authの前に\ が無いとダメ
        $current_password = \Auth::user()->password;
        
        // バリデーション
        $request->validate([
             // usersテーブルのpasswordカラムについて、なにも更新せずに、更新ボタンを押しても、通るように　自分のpasswordはチェック対象外にしたい
              // 「email != $myEmail」のレコードに対して、一意チェックを行う  Rule::unique('users', 'password')->whereNot('password', $current_password)
              'password' => [Rule::unique('users', 'password')->whereNot('password', $current_password), 'required', 'string', 'min:8', 'confirmed'],
            ]);
        
        
        if(Hash::check($request->password, $current_password)){
             
            // idで探すのではなくて認証ユーザをさがす
            $user = \Auth::user();
            
            $user->password = $request->password;
            $user->save();
            
            
            $request->session()->flash('flash_message', 'パスワード変更が完了しました');
            return redirect('accounts/:id');  // return viewは使わないでください
            
        }else {
            
            $request->session()->flash('flash_message', 'パスワード変更できませんでした');
            return redirect('accounts/:id');  // return viewは使わないでください

        }
    }
    
}
