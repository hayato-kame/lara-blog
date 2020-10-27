<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


// 追加 これがないとダメ
use App\User;
use App\Http\Controllers\Auth;

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
    
    public function update()
    {
        
    }
}
