<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    
    // protected $current_password; 
    // アクセッサヲ

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    /**
     * このユーザが所有するブログ投稿。（ Entryモデルとの関係を定義）
     * 
     *  UserのインスタンスからそのUserが持つentriesを
     * $user->entries()->get() もしくは
     * $user->entries という簡単な記述で取得できるようになります。
     * 
     */
    public function entries()
    {
        return $this->hasMany(Entry::class);
    }
    
    /**
     * このユーザに関係するモデルの件数をロードする。
     * 
     * これをアクションで $user->loadRelationshipCounts() のように呼び出した後、
     * ビューで $user->entries_count のように件数を取得することになります。
     */
     public function loadRelationshipCounts()
     {
         $this->loadCount('entries');
     }
     
     
}
