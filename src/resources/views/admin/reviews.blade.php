@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/reviews.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/listTable.css') }}" />
@endsection

@section('content')
<div class="div__main">
  <h2 class="h2__title">口コミ一覧</h2>
  <div class="div__table-content">
    {{-- <div class="div__button">
      <form action="/admin/review/batchDelete" method="POST" id="form__batch-delete">
        @csrf
        @method('DELETE')
        <button class="button__delete">一括削除</button>
      </form>
    </div> --}}
    {{ $reviews->links() }}
    <table class="table__list">
      <tr class="tr__header">
        <th class="th__checkbox">
        </th>
        <th class="th__date">投稿日</th>
        <th class="th__time">ユーザー名</th>
        <th class="th__time">店舗名</th>
        <th class="th__user">レート</th>
        <th class="th__number">コメント</th>
        <th class="th__function"></th>
      </tr>
      @foreach ($reviews as $review)
      <tr class="tr__contents">
        <td class="th__checkbox">
          <input type="checkbox" name="{{$review->id}}" form="form__batch-delete">
        </td>
        <td>{{$review->created_at->format('y/m/d')}}</td>
        <td>{{$review->user->name}}</td>
        <td>{{$review->store->name}}</td>
        <td>{{$review->rate}}</td>
        <td>{{$review->comment}}</td>
        <td>
          <div class="div__button">
            <form action="/admin/review/delete" method="POST" class="form__delete">
              @csrf
              @method('DELETE')
              <input type="text" name="id" value="{{$review->id}}" hidden>
              <button class="button__delete">削除</button>
            </form>
          </div>
        </td>
      </tr>
      @endforeach
    </table>
  </div>
</div>
{{-- <div class="div__main">
  <h2 class="h2__title">口コミ一覧</h2>
  <div class="div__table-content">
    {{ $reviews->links() }}
    <table class="table__list">
      <tr class="tr__header">
        <th class="th__date">投稿日</th>
        <th class="th__time">ユーザー名</th>
        <th class="th__time">店舗名</th>
        <th class="th__user">レート</th>
        <th class="th__number">コメント</th>
      </tr>
      @foreach ($reviews as $review)
      <tr class="tr__contents">
        <td>{{$review->created_at->format('y/m/d')}}</td>
        <td>{{$review->user->name}}</td>
        <td>{{$review->store->name}}</td>
        <td>{{$review->rate}}</td>
        <td>{{$review->comment}}</td>
      </tr>
      @endforeach
    </table>
  </div>
</div> --}}
@endsection