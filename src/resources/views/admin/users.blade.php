@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/listTable.css') }}" />
@endsection

@section('content')
<div class="div__main">
  <h2 class="h2__title">登録ユーザー一覧</h2>
  <div class="div__table-content">

    {{ $users->links() }}
    <table class="table__list">
      <tr class="tr__header">
        <th class="th__name">ユーザー名</th>
        <th class="th__email">メールアドレス</th>
        <th class="th__created-at">登録日</th>
      </tr>
      @foreach ($users as $user)
      <tr class="tr__contents">
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->created_at->format('Y/m/d')}}</td>
      </tr>
      @endforeach
    </table>
  </div>
</div>

@endsection
