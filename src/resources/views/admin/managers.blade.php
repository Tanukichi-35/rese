@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/listTable.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/stores.css') }}" />
@endsection

@section('content')
<div class="div__main">
  <h2 class="h2__title">店舗代表者一覧</h2>
  <div class="div__table-content">
    <div class="div__button">
      <a class="a__register" href="/admin/manager/register">新規登録</a>
      <form action="/admin/manager/batchDelete" method="POST" id="form__batch-delete">
        @csrf
        @method('DELETE')
        <button class="button__delete">一括削除</button>
      </form>
    </div>
    {{ $managers->links() }}
    <table class="table__list">
      <tr class="tr__header">
        <th class="th__checkbox">
        </th>
        <th class="th__name">代表者氏名</th>
        <th class="th__email">メールアドレス</th>
        <th class="th__created-at">登録日</th>
        <th class="th__function"></th>
      </tr>
      @foreach ($managers as $manager)
      <tr class="tr__contents">
        <td class="th__checkbox">
          <input type="checkbox" name="{{$manager->id}}" form="form__batch-delete">
        </td>
        <td>{{$manager->name}}</td>
        <td>{{$manager->email}}</td>
        <td>{{$manager->created_at->format('Y/m/d')}}</td>
        <td>
          <div class="div__button">
            <a class="a__edit" href="/admin/manager/edit/{{$manager->id}}">編集</a>
            <form action="/admin/manager/delete" method="POST" class="form__delete">
              @csrf
              @method('DELETE')
              <input type="text" name="id" value="{{$manager->id}}" hidden>
              <button class="button__delete">削除</button>
            </form>
          </div>
        </td>
      </tr>
      @endforeach
    </table>
  </div>
</div>

@endsection
