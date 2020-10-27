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
    
    
    public function show($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);
        
        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();
        
        // ユーザのブログ投稿一覧を作成日時の降順で取得
        $entries = $user->entries()->orderBy('created_at', 'desc')->paginate(10);
        
        
        // ユーザ詳細ビューでそれを表示
        return view('users.show', [
            'user' => $user,
            'entries' => $entries,
            ]);
    }
    
    
}
