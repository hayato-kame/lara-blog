<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        {{-- トップページへのリンク --}}
        <a class="navbar-brand" href="/">Microposts</a>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                @if (Auth::check())
                    {{-- ユーザ一覧ページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('users.index', 'Users', [], ['class' => 'nav-link']) !!}</li>
                    
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}</a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            {{-- ユーザ詳細ページへのリンク --}}
                            <li class="dropdown-item">{!! link_to_route('users.show', 'My profile', ['user' => Auth::id()]) !!}</li>
                            
                            {{-- ユーザアカウント詳細ページへのリンク ユーザのid -の情報を送らないとだめ　キーをidとすること--}}
                            <li class="dropdown-item">{!! link_to_route('accounts.show', 'My Account', ['user' => Auth::id()]) !!}</li>
                            
                            <li class="dropdown-divider"></li>
                            {{-- ログアウトへのリンク --}}
                            <li class="dropdown-item">{!! link_to_route('logout.get', 'Logout') !!}</li>
                        </ul>
                    </li>
                @else
                    {{-- ユーザ登録ページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('signup.get', 'Signup', [], ['class' => 'nav-link']) !!}</li>
                    {{-- ログインページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('login', 'Login', [], ['class' => 'nav-link']) !!}</li>
                @endif
            </ul>
        </div>
    </nav>
</header>
{{--
     Authファサードは認証に関する一連のメソッドを提供しています
     
     Auth::check() は、ユーザがログインしているかどうかを調べるための関数です。
     
     別のメソッドであるAuth::user() を利用するとログイン中のユーザを取得できます。
     
     ちなみに、Bladeファイルの中には素のPHPコードを埋め込むこともできます。
     
     { {  Auth::user()->name  }  } とは違う方法
     
     <  ?  php $user = Auth::user();  ? >
        {  {  $user->name  }  }
        
        
    Auth::id() というクラスメソッドを使いましたが、
    これはログインユーザのIDを取得することができるメソッドで、
    Auth::user()->id と同じ動きになります。
    
     
--}}