@extends('layouts.app')

@section('content')
    @if (Auth::check())
        {{ Auth::user()->name }}
    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Welcome to the Microposts</h1>
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