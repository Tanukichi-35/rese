@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/listTable.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/stores.css') }}" />
@endsection

@section('content')
<div class="div__main">
  <h2 class="h2__title">登録店舗一覧</h2>
  <div class="div__table-content">
    <div class="div__button">
      <a class="a__register" href="/manager/store/register">新規登録</a>
      <form action="/manager/store/batchDelete" method="POST" id="form__batch-button">
        @csrf
        @method('DELETE')
        <button class="button__delete">一括削除</button>
      </form>
      {{-- <form id="form__import" action="/manager/store/import" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="csv" accept=".csv" id="input__file" onchange="OnFileSelect(this)" hidden/>
        <label class="label__file" for="input__file">CSVインポート</label>
      </form> --}}
      <a class="a__import" href="/manager/store/import">CSVインポート</a>
    </div>
    {{ $stores->links() }}
    <table class="table__list">
      <tr class="tr__header">
        <th class="th__checkbox">
        </th>
        <th class="th__name">店舗名</th>
        <th class="th__manager">店舗代表者</th>
        <th class="th__area">地域</th>
        <th class="th__genre">ジャンル</th>
        <th class="th__function"></th>
      </tr>
      @foreach ($stores as $store)
      <tr class="tr__contents">
        <td class="th__checkbox">
          <input type="checkbox" name="{{$store->id}}" form="form__batch-button">
        </td>
        <td>{{$store->name}}</td>
        <td>{{$store->manager->name}}</td>
        <td>{{$store->area->name}}</td>
        <td>{{$store->genre->name}}</td>
        <td>
          <div class="div__button">
            <button class="button__modal-detail">詳細</button>
            {{-- modal-detail-page --}}
            <div class="div__modal div__modal-detail">
              <div class="div__overlay"></div>
              <div class="div__modal-page-contents">
                <div class="div__modal-page-header">
                  <h2 class="h2__modal-detail-header">店舗情報</h2>
                  <div class="div__modal-page-close">
                    <button class="button__modal-close button__modal-page-close"></button>
                  </div>
                </div>
                <div class="div__modal-page-content">
                  <div class="div__store">
                    <div class="div__store-name">
                        <h2 class="h2__store-name">{{$store->name}}</h2>
                    </div>
                    <div class="div__store-image">
                      <img class="img__store-image" src="{{asset($store->imageURL)}}" alt="画像が登録されていません">
                    </div>
                    <div class="div__store-tag">
                      <p class="p__area-tag">#{{$store->area->name}}</p>
                      <p class="p__genre-tag">#{{$store->genre->name}}</p>
                    </div>
                    <div class="div__store-description">
                      <p>{{$store->description}}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <a class="a__edit" href="/manager/bookings/{{$store->id}}">予約情報</a>
            <a class="a__edit" href="/manager/store/edit/{{$store->id}}">編集</a>
            <form action="/manager/store/delete" method="POST" class="form__delete">
              @csrf
              @method('DELETE')
              <input type="text" name="id" value="{{$store->id}}" hidden>
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

@section('script')
  <script src="{{ asset('js/stores.js') }}"></script>
@endsection