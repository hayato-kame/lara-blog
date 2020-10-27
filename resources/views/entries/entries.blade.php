@if (count($entries) > 0)
    <ul class="list-unstyled">
        @foreach ($entries as $entry)
            <li class="media mb-3">
                {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                <img class="mr-2 rounded" src="{{ Gravatar::get($entry->user->email, ['size' => 50]) }}" alt="">
                <div class="media-body">
                    <div>
                        {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                        {!! link_to_route('users.show', $entry->user->name, ['user' => $entry->user->id]) !!}
                        <span class="text-muted">posted at {{ $entry->created_at }}</span>
                    </div>
                    <div>
                        {{-- ブログ投稿内容 --}}
                        <p class="mb-0">{!! nl2br(e($entry->title)) !!}</p>
                    </div>
                    <div>
                        <p class="mb-0">{!! nl2br(e($entry->body)) !!}</p>
                    </div>
                    
                        {{--  もっと読む --}}
                    
                    <div class="btn-toolbar">
                    <div class="btn-group">
                        
                        @if (Auth::id() == $entry->user_id)
                        
                        {{-- 編集ページへのリンク --}}
            {!! link_to_route('entries.edit', 'Update', ['entry' => $entry->id], ['class' => 'btn btn-success btn-sm']) !!}
                        
                        
                        
                        {{-- ブログ投稿削除ボタンのフォーム --}}
                        {!! Form::open(['route' => ['entries.destroy', $entry->id],'method' => 'delete']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm ']) !!}
                        {!! Form::close() !!}
                        
                        @endif
                        
                    </div>
                    </div>
                    
                </div>
            </li>
        @endforeach
    </ul>
    {{-- ページネーションのリンク --}}
    {{ $entries->links() }}
@endif



{--　以下コメント

Bootstrapで複数ボタンを横並びに配置するときにいい感じにスペースを作る方法
btn-groupをさらにbtn-toolbarで囲ってあげるといい感じにスペースを作ってくれます。

<  div class="btn-toolbar">
<  div class="btn-group">

...


<  /div>
<  /div>

--}