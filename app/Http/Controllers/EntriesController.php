<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EntriesController extends Controller
{
    public function index()
    {
        $data = [];
        
        if (\Auth::check()) {  // 認証済みの場合
        
            //  認証済みユーザを取得
            $user = \Auth::user();
            
            // 認証済みユーザのブログ一覧を作成日時の降順で取得
            $entries = $user->entries()->orderBy('created_at', 'desc')->paginate(10);
            
            $data = [
                'user' => $user,
                'entries' => $entries,
                ];
        }
        // Welcomeビューでそれらを表示
        return view('welcome', $data);
    }
    
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'title' => 'required|max:80',
            'body' => 'required'
            ]);
            
        // 認証済みユーザ（閲覧者）の投稿として作成（リクエストされた値をもとに作成）
        $request->user()->entries()->create([
            'title' => $request->title,
            'body' => $request->body,
        ]);
            
            // 前のURLへリダイレクトさせる
            return back();
    }
    
    
}
