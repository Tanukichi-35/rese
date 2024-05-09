@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')
{{-- 検索 --}}
<div class="div__search">
  <form action="/search" method="GET" class="form__search" id="form__search" >
    @csrf
    {{-- ソート --}}
    <div class="div__sort">
      <div class="div__order">
        <select name="order" id="select__order" class="select__order shadow">
            <option value="" style='display:none;' disabled @if(!isset($request, $request->order)) selected @endif>並び替え：評価高/低</option>
            <option value="0" @if(isset( $request, $request->order ) && $request->order == 0) selected @endif onclick="sort()">ランダム</option>
            <option value="1" @if(isset( $request, $request->order ) && $request->order == 1) selected @endif onclick="sort()">評価が高い順</option>
            <option value="2" @if(isset( $request, $request->order ) && $request->order == 2) selected @endif onclick="sort()">評価が低い順</option>
        </select>
      </div>
    </div>
    <div class="div__filter shadow">
      <div class="div__area">
        <select name="area_id" class="select__search-area"  id="select__search-area" onchange="search()">
          <option value="" style='display:none;' disabled @if(!isset($request, $request->area_id)) selected @endif>地域</option>
          <option value="0" @if(isset( $request, $request->area_id ) && $request->area_id == 0) selected @endif>全て</option>
          @foreach (Area::All() as $area)
          <option value="{{$area->id}}" @if(isset( $request, $request->area_id ) && $request->area_id == $area->id) selected @endif>{{$area->name}}</option>
          @endforeach
        </select>
      </div>
      <div class="div__genre">
        <select name="genre_id" class="select__search-genre" id="select__search-genre"  onchange="search()">
          <option value="" style='display:none;' disabled @if(!isset($request, $request->genre_id)) selected @endif>ジャンル</option>
          <option value="0" @if(isset( $request, $request->genre_id ) && $request->genre_id == 0) selected @endif>全て</option>
          @foreach (Genre::All() as $genre)
          <option value="{{$genre->id}}" @if(isset( $request, $request->genre_id ) && $request->genre_id == $genre->id) selected @endif>{{$genre->name}}</option>
          @endforeach
        </select>
      </div>
      <div class="div__store">
        <img class="img__search" id="img__search" src="{{asset('img/search.png')}}" alt=""  onclick="search()">
        <input type="text" name="store_name" class="input__search-store" id="select__search-store" placeholder="店名で検索" @if (isset( $request )) value="{{$request['store_name']}}"@endif>
      </div>
    </div>
  </form>
</div>
<div class="div__main">
  {{-- 飲食店一覧 --}}
  <div class="div__store-list">
    @foreach ($stores as $store)
    <div class="div__store-info shadow">
    <div class="div__image" style="background-image: url({{asset($store->imageURL)}});"></div>
      <h3 class="h3__store-name">{{$store->name}}</h3>
      <div class="div__tag">
          <p class="p__area-tag">#{{$store->area->name}}</p>
          <p class="p__genre-tag">#{{$store->genre->name}}</p>
      </div>
      <div class="div__button">
        <a href="/detail/{{$store->id}}" class="a__store-detail">詳しくみる</a>
        <form method="POST">
        @csrf
          <input type="number" name="store_id" value="{{$store->id}}" hidden>
          @if(Auth::user())
            <img class="img__favorite" data-user_id={{Auth::user()->id}} data-store_id={{$store->id}} src="{{$store->checkFavorite()?asset('img/heart_on.png'):asset('img/heart_off.png')}}">
          @else
            <img class="img__favorite" data-user_id="0" data-store_id={{$store->id}} src="{{$store->checkFavorite()?asset('img/heart_on.png'):asset('img/heart_off.png')}}">
          @endif
        </form>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection

@section('script')
  <script src="{{ asset('js/index.js') }}"></script>
  <script src="{{ asset('js/favorite.js') }}"></script>
@endsection