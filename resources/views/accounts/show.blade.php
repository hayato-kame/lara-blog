@extends('layouts.app')

@php
$page_title = "マイアカウント"; 
@endphp

{{-- titleの section には　endsection イラナイ --}}
@section('title', $page_title)


@section('content')


<h1> {{ $page_title ?? '' }} </h1>

<ul class="toolbar">
    <!--{  !! link_to_route('accounts.edit', 'アカウント情報の編集', [], ['class' => 'btn btn-lg btn-primary']) !!}-->
   {!! link_to_route('accounts.edit', 'アカウント情報の編集') !!}

  
</ul>


<table class="table table-striped">
  
  <tr>
    <th>Profile Image</th>
  <td>
    <img class="mr-2 rounded" src="{{ Gravatar::get($user->email, ['size' => 50]) }}" alt="">
  </td>
  </tr>
  
  
  <tr>
    <th width="150">id</th>
    <td>{{ $user->id }}</td>
  </tr>

  <tr>
    <th>Name</th>
    <td>{{ $user->name }}</td>
  </tr>

  <tr>
    <th>Mail Address</th>
    <td>{{ $user->email }}</td>
  </tr>

</table>
@endsection
