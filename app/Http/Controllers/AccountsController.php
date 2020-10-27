<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


// 追加 これがないとダメ
use App\User;
use App\Http\Controllers\Auth;

class AccountsController extends Controller
{
    public function show()
    {
        // idの値でユーザを検索して取得
        // $user = User::findOrFail($id);
        
        // 関係するモデルの件数をロード
        // $user->loadRelationshipCounts();
        
        $user = \Auth::user();

        // アカウント！！詳細ビューでそれを表示
        return view('accounts.show', [
            'user' => $user,
            
            ]);
    }
    
    public function edit()
    {
        
    }
    
    public function update()
    {
        
    }
}
