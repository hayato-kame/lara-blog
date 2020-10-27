<!--@extends('layouts.app')-->

<!--@section('content')-->

<!--@php-->
<!--$page_title = "マイアカウント"; -->
<!--@endphp-->

<h1> {{ $page_title ?? '' }} </h1>

<ul class="toolbar">
    {!! link_to_route('accounts.edit', 'アカウント情報の編集', [], ['class' => 'btn btn-lg btn-primary']) !!}
 

  
</ul>


<table class="table table-striped">
  
  <tr>
    <th>Profile Image</th>
   
    <img class="mr-2 rounded" src="{{ Gravatar::get($user->email, ['size' => 50]) }}" alt="">
    
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
