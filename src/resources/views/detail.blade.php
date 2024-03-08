@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/detail.css') }}" />
@endsection

@section('content')
<div class="div__main">
  
  {{-- 店詳細 --}}
  <div class="div__store">
    <div class="div__store-name">
        <button class="button__back" onclick="goBackPage()"><</button>
        <h3 class="h3__store-name">{{$store->name}}</h3>
    </div>
    <div class="div__store-image">
      <img class="img__store-image" src="{{$store->imageURL}}" alt="">
    </div>
    <div class="div__store-tag">
      <p class="p__area-tag">#{{$store->area->name}}</p>
      <p class="p__category-tag">#{{$store->category->name}}</p>
    </div>
    <div class="div__store-description">
      <p class="p__area-tag">{{$store->description}}</p>
    </div>
  </div>

  {{-- 予約フォーム --}}
  <div class="div__booking">
    <h3 class="h3__booking">予約</h3>
    <form action="/booking" method="POST" class="form__booking">
      @csrf
      <div class="div__inner">
        <input class="input__store_id" id="input__store_id" name="store_id" type="number" value="{{$store->id}}" hidden>
        <input class="input__date" id="input__date" name="date" type="date" min="2024-03-06">
        <select class="select__time" id="select__time" name="time">
          @foreach ($store->getHours() as $key => $value)
            <option value="{{$key}}">{{$value}}</option>
          @endforeach
        </select>
        <select class="select__number" id="select__number" name="number">
          @foreach ($store->getNumbers() as $key => $value)
            <option value="{{$key}}">{{$value}}</option>
          @endforeach
        </select>
      <table class="table__monitor">
        <tr>
          <th>店名</th>
          <td>{{$store->name}}</td>
        </tr>
        <tr>
          <th>日付</th>
          <td id="table__date"></td>
        </tr>
        <tr>
          <th>時間</th>
          <td id="table__time"></td>
        </tr>
        <tr>
          <th>人数</th>
          <td id="table__number"></td>
        </tr>
      </table>
      </div>
      <button class="button__submit">予約する</button>
    </form>
  </div>

</div>
@endsection

@section('script')
  <script src="{{ asset('js/detail.js') }}"></script>
@endsection