@extends('layouts.app')

@section('content')

    <h1> {{ $entry->user->name }} さんのブログ編集ページ</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($entry, ['route' => ['entries.update', $entry->id], 'method' => 'put']) !!}

                <div class="form-group">
                    {!! Form::label('title', 'タイトル:') !!}
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('body', '本文:') !!}
                    {!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => '20']) !!}
                </div>

                {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection