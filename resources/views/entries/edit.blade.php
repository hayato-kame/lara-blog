@extends('layouts.app')


@php
$page_title = "ブログ編集ページ"; 
@endphp

{{-- titleの section には　endsection イラナイ --}}
@section('title', $page_title)

@section('content')

    <h1> {{ $entry->user->name }} さんの{{ $page_title }}</h1>

    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            {!! Form::model($entry, ['route' => ['entries.update', $entry->id], 'method' => 'put']) !!}

                <div class="form-group">
                    {!! Form::label('title', 'タイトル:') !!}
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('body', '本文:') !!}
                    {!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => '20']) !!}
                </div>

                {!! Form::submit('更新', ['class' => 'btn btn-primary btn-block']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection