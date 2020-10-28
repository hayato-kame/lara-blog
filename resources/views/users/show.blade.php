@extends('layouts.app')

@php
$page_title = "ユーザ詳細"; 
@endphp

{{-- titleの section には　endsection イラナイ --}}
@section('title', $page_title)


@section('content')

{{--  if文　もし、ユーザーが　認証ユーザなら、 新規ブログを作成のリンクを作成すること--}}

    <div class="row">
        <aside class="col-sm-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $user->name }}</h3>
                </div>
                <div class="card-body">
                    {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
                    <img class="rounded img-fluid" src="{{ Gravatar::get($user->email, ['size' => 50]) }}" alt="">
                </div>
            </div>
        </aside>
        <div class="col-sm-8">
            <ul class="nav nav-tabs nav-justified mb-3">
                
                <li class="nav-item">
                    <a href="{{ route('users.show', ['user' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.show') ? 'active' : '' }}">
                        Blog
                        <span class="badge badge-secondary">{{ $user->entries_count }}</span>
                    </a>
                </li>
                
            </ul>
            {{-- ブログ投稿一覧 　第二引数必要か　いらないかも--}}
            @include('entries.entries')
        </div>
    </div>
@endsection


{{--

<  a  href ="{{ route('users.show', ['user' => $user->id]) }}"> で使用している  
route() はヘルパー関数と呼ばれるもので、
今までは link_to_route を使用してきましたが、ここではこちらを使用しています。
理由は、link_to_route だと 
<span class="badge">{{ $user->entries_count }}</span> を含めたリンク名がうまく表示されないからです
（これはLaravelCollectiveの仕様であるため、今のところは使う関数を変更するしかありません）。

$user->entries_count

はUserに関係するEntryの件数を取得しています。
これは、 UsersController@show アクションで呼び出したUserの 
loadRelationshipCounts メソッドの中で、
リレーション entries の件数をロードしたことより可能になっています。


--}}