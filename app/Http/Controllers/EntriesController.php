<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// 追加 これがないとダメ
use App\User;
use App\Http\Controllers\Auth;

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
    
    
    public function show($id)
    {
        $entry = \App\Entry::findOrFail($id);
        
        return view('entries.show', [
            'entry' => $entry,
            ]);
        
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
    
    // getでentries/id/editにアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {
        // idの値でメッセージを検索して取得
        $entry = \App\Entry::findOrFail($id);
        
        // ブログ編集ビューでそれを表示
        return view('entries.edit', [
            'entry' => $entry,
            ]);
    }
    
    
    public function update(Request $request, $id)
    {
        // idの値でメッセージを検索して取得
        $entry = \App\Entry::findOrFail($id);
        
        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は メッセージを更新
         if (\Auth::id() === $entry->user_id){
        $entry->title = $request->title;
        $entry->body = $request->body;
        $entry->save();
         }

        // トップページへリダイレクトさせる
        return redirect('/');
    }
    
    public function destroy($id)
    {
        // idの値で投稿を検索して取得
        $entry = \App\Entry::findOrFail($id);
        
        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は、投稿を削除
        if (\Auth::id() === $entry->user_id){
            $entry->delete();
        }
        
        // 前のURLへリダイレクトさせる
        return back();
        
    }
    
    
}
