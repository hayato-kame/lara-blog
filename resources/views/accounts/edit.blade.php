@extends('layouts.app')

@php
$page_title = "アカウントの編集"; 
@endphp

{{-- titleの section には　endsection イラナイ --}}
@section('title', $page_title)


@section('content')
<h1>{{ $page_title ?? '' }}</h1>

<div class="toolbar">{!! link_to_route('accounts.show', 'マイアカウントへ戻る') !!}</div>

<div class="row">
  <div class="col-sm-6 offset-sm-3">

    {!! Form::model($user, ['route' => ['accounts.update', $user->id], 'method' => 'put']) !!}
    
      <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        
      </div>
      
      <div class="form-group">
        {!! Form::label('email', 'Email:') !!}
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
       
      </div>
      
        {!! Form::submit('更新', ['class' => 'btn btn-primary btn-block']) !!}

        {!! Form::close() !!}
    </div>
</div>
@endsection