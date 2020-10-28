@extends('layouts.app')

@php
$page_title = "ユーザ一覧"; 
@endphp

{{-- titleの section には　endsection イラナイ --}}
@section('title', $page_title)


@section('content')

    {{-- ユーザ一覧 --}}
    @include('users.users')
    
@endsection

