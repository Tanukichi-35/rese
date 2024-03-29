@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')
{{-- 検索 --}}
<div class="div__search">
  <form action="/search" method="GET" class="form__search shadow" id="form__search" >
    @csrf
    <div class="div__area">
      <select name="area_id" class="select__search-area"  id="select__search-area">
        <option value="" style='display:none;' disabled selected>地域</option>
        <option value="0" @if(isset( $request ) && $request['area_id'] == 0) selected @endif>全て</option>
        @foreach (Area::All() as $area)
        <option value="{{$area->id}}" @if(isset( $request ) && $request['area_id'] == $area->id) selected @endif>{{$area->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="div__category">
      <select name="category_id" class="select__search-category" id="select__search-category">
        <option value="" style='display:none;' disabled selected>ジャンル</option>
        <option value="0" @if(isset( $request ) && $request['category_id'] == 0) selected @endif>全て</option>
        @foreach (Category::All() as $category)
        <option value="{{$category->id}}" @if(isset( $request ) && $request['category_id'] == $category->id) selected @endif>{{$category->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="div__store">
      <img class="img__search" src="{{asset('img/search.png')}}" alt="">
      <input type="text" name="store_name" class="input__search-store" id="select__search-store" placeholder="店名で検索" @if (isset( $request )) value="{{$request['store_name']}}"@endif>
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
          <p class="p__category-tag">#{{$store->category->name}}</p>
      </div>
      <div class="div__button">
        <a href="/detail/{{$store->id}}" class="a__store-detail">詳しく見る</a>
        <form method="POST">
        @csrf
          <input type="number" name="store_id" value="{{$store->id}}" hidden>
          <img class="img__favorite" data-user_id={{Auth::user()->id}} data-store_id={{$store->id}} src="{{$store->checkFavorite()?asset('img/heart_on.png'):asset('img/heart_off.png')}}">
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