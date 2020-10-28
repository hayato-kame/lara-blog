@extends('layouts.app')


@php
$page_title = "Toppage"; 
@endphp

{{-- titleの section には　endsection イラナイ --}}
@section('title', $page_title)


@section('content')
    @if (Auth::check())
        <div class="row">
            <aside class="col-sm-5">
                
                {{-- 投稿フォーム --}}
                @include('entries.form')
                
            </aside>
            <div class="col-sm-7">
                {{-- 投稿一覧 --}}
                @include('entries.entries')
            </div>
        </div>
    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Welcome to the Blog</h1>
                {{-- ユーザ登録ページへのリンク --}}
                {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>
    @endif
@endsection

{{--
     Authファサードは認証に関する一連のメソッドを提供しています
     
     Auth::check() は、ユーザがログインしているかどうかを調べるための関数です。
     
     別のメソッドであるAuth::user() を利用するとログイン中のユーザを取得できます。
     
     ちなみに、Bladeファイルの中には素のPHPコードを埋め込むこともできます。
     
     { {  Auth::user()->name  }  } とは違う方法
     
     <  ?  php $user = Auth::user();  ? >
        {  {  $user->name  }  }
     
--}}