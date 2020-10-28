@extends('layouts.app')

@php
$page_title = $entry->title . "-" . $entry->user->name . "さんのブログ詳細"; 
@endphp

{{-- titleの section には　endsection イラナイ --}}
@section('title', $page_title)

@section('content')


<h1>{{ $page_title }}</h1>

<div class="toolbar">{!! link_to_route('top', 'トップページへ戻る') !!}</div>

<h2>{!! nl2br(e($entry->title)) !!}</h2>
<div>
  {!! nl2br(e($entry->body)) !!}
  
</div>
<div class="toolbar">
{!! link_to_route('users.show', $entry->user->name . 'さんのページへ戻る', ['user' => $entry->user->id]) !!}
</div>



@endsection