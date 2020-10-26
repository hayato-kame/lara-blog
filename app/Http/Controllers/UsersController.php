<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


// これを忘れずに入れてください
use App\User;

class UsersController extends Controller
{
    //   createアクションやstoreアクションについてはRegisterControllerで実装されているため不要です。
    
    
    public function index()
    {
    // ユーザ一覧をidの昇順で！！取得
    $users = User::orderBy('id', 'asc')->paginate(10);
    
    // ユーザー一覧ビューでそれを表示
    return view('users.index', [
        'users' => $users,
        ]);
        
    }
    
    
}
