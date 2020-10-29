@extends('layouts.app')

@php
$page_title = "ユーザ詳細"; 
@endphp

{{-- titleの section には　endsection イラナイ --}}
@section('title', $page_title)


@section('content')


@if (Auth::check())
  <div class="toolbar">{!! link_to_route('top', '新規ブログを追加する') !!}</div>
 
@endif

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
