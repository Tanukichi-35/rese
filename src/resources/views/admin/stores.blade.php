@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/listTable.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/stores.css') }}" />
@endsection

@section('content')
<div class="div__main">
  <h2 class="h2__title">登録店舗一覧</h2>
  <div class="div__table-content">
    {{ $stores->links() }}
    <table class="table__list">
      <tr class="tr__header">
        <th class="th__name">店舗名</th>
        <th class="th__manager">店舗代表者</th>
        <th class="th__area">地域</th>
        <th class="th__genre">ジャンル</th>
        <th class="th__function"></th>
      </tr>
      @foreach ($stores as $store)
      <tr class="tr__contents">
        <td>{{$store->name}}</td>
        <td>{{$store->manager->name}}</td>
        <td>{{$store->area->name}}</td>
        <td>{{$store->genre->name}}</td>
        <td class="td__button">
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
                    <img class="img__store-image" src="{{asset($store->imageURL)}}" alt="">
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