@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/listTable.css') }}" />
@endsection

@section('content')
<div class="div__main">
  <h2 class="h2__title">レビュー一覧</h2>
  <div class="div__table-content">
    {{ $reviews->links() }}
    <table class="table__list">
      <tr class="tr__header">
        <th class="th__date">日付</th>
        <th class="th__time">ユーザー名</th>
        <th class="th__user">レート</th>
        <th class="th__number">コメント</th>
      </tr>
      @foreach ($reviews as $review)
      <tr class="tr__contents">
        <td>{{$review->created_at->format('y/m/d')}}</td>
        <td>{{$review->user->name}}</td>
        <td>{{$review->rate}}</td>
        <td>{{$review->comment}}</td>
      </tr>
      @endforeach
    </table>
  </div>
</div>
@endsection