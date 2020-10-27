{!! Form::open(['route' => 'entries.store']) !!}
    <div class="form-group">
        {!! Form::textarea('title', old('title'), ['class' => 'form-control', 'rows' => '2', 'placeholder' => 'タイトル']) !!}
        {!! Form::textarea('body', old('body'), ['class' => 'form-control', 'rows' => '15', 'placeholder' => '本文']) !!}
        {!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
    </div>
{!! Form::close() !!}