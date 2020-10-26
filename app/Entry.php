<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $fillable = ['title', 'body'];
    
    /**
     * このブログ投稿を所有するユーザ。（ Userモデルとの関係を定義）
     * 
     *  Entryのインスタンスが所属している唯一のUser（投稿者の情報）を
     * $entry->user()->first() もしくは  get() は集合を取得するためのメソッドなので、使わないで
     * ここで取得するのは、唯一の　だからです、get() で取得したものは配列に入っているので、
     * 後で、取り出すときにエラーの原因になります。そこで、ようやくエラーが出るため、気を付けてください
     * 
     * $entry->user という簡単な記述で取得できるようになります。
     * 
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
