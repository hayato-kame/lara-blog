@if (count($users) > 0)


<div class="row">
  <div class="col-sm-8 offset-sm-2">

  <table class="table">
    <thead>
      <tr>
        <th class="text-center">プロフィール画像</th>
        <th class="text-center">id</th>
        <th class="text-center">氏名</th>
        <!--<th class="text-center">操作</th>-->
      </tr>
    </thead>
    <tbody>

        @foreach ($users as $user)

        <tr>
          <td class="media"><img class="mr-2 rounded" src="{{ Gravatar::get($user->email, ['size' => 50]) }}" alt=""></td>
          <td>{{ $user->id }}</td>
          <td>{!! link_to_route('users.show', $user->name, ['user' => $user->id]) !!}</td>
          <!--<td><　　%= link_to "編集", [:edit, user] %> | <　　%= link_to "削除", user, method: :delete, data: { confirm: "本当に削除しますか？" } %></td>-->
        </tr>

        @endforeach
    </table>
    
    {{-- ページネーションのリンク --}}
    {{ $users->links() }}

@endif