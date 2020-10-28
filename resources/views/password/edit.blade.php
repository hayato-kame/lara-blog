@extends('layouts.app')

@php
$page_title = "パスワードの変更"; 
@endphp

{{-- titleの section には　endsection イラナイ --}}
@section('title', $page_title)


@section('content')

    <div class="text-center">
        <h1>{{ $page_title ?? '' }}</h1>
    </div>
    
    <div class="toolbar">{!! link_to_route('accounts.show', 'マイアカウントに戻る') !!}</div>
    
    
    {!! Form::model($user, ['route' => ['password.update', $user->id], 'method' => 'put']) !!}
    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            <table class="table table-striped">

                <tr>
                    <td>{!! Form::label('current_password', '現在のパスワード') !!}</td>
                    <td>{!! Form::password('current_password', ['class' => 'form-control']) !!}</td>
                </tr>
                
                <tr>
                    <td>{!! Form::label('password', '新しいパスワード') !!}</td>
                    <td>{!! Form::password('password', ['class' => 'form-control']) !!}</td>
                </tr>
                
                <tr>
                    <td>{!! Form::label('password_confirmation', '確認のため新しいパスワードを入力') !!}</td>
                    <td>{!! Form::password('password_confirmation', ['class' => 'form-control']) !!}</td>
                </tr>
                
            </table>
            
            <div>{!! Form::submit('変更', ['class' => 'btn btn-primary btn-block']) !!}</div>
        </div>
    </div>
    {!! Form::close() !!}

@endsection
