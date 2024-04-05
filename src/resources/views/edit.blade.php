@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/detail.css') }}" />
@endsection

@section('content')
{{-- <div class="div__main"> --}}
  {{-- 店詳細 --}}
  <div class="div__store">
    <div class="div__store-name">
        <button class="button__back" onclick="goBackPage()">&lt;</button>
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

  {{-- 予約フォーム --}}
  <div class="div__booking">
    <h3 class="h3__booking">予約</h3>
    <form action="/booking/restore" method="POST" class="form__booking">
      @csrf
      <div class="div__inner">
        <input class="input__booking_id" name="id" type="number" value="{{$booking->id}}" hidden>
        <input class="input__date" id="input__date" name="date" type="date" min="{{date('Y-m-d')}}" max="{{date('Y-m-d', strtotime('3 month'))}}" value="{{$booking->date}}">
        <div class="div__error">
          <ul>
            @error('date')
            <li class="li__error">
              {{$message}}
            </li>
            @enderror
          </ul>
        </div>
        <div class="div__time">
          <select class="select__time" id="select__time" name="time">
            @foreach ($store->getHours() as $key => $value)
              <option value="{{$key}}" @if($value == substr($booking->time, 0, -3)) selected @endif>{{$value}}</option>
            @endforeach
          </select>
        </div>
        <div class="div__error">
          <ul>
            @error('time')
            <li class="li__error">
              {{$message}}
            </li>
            @enderror
          </ul>
        </div>
        <div class="div__fee" hidden>
          <input type="number" name="fee" class="input__fee" value="3000">
        </div>
        <div class="div__number">
          <select class="select__number" id="select__number" name="number">
            @foreach ($store->getNumbers() as $key => $value)
              <option value="{{$key}}" @if($value == $booking->number) selected @endif>{{$value}}</option>
            @endforeach
          </select>
        </div>
        <div class="div__error">
          <ul>
            @error('number')
            <li class="li__error">
              {{$message}}
            </li>
            @enderror
          </ul>
        </div>
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
      <button class="button__booking">変更する</button>
    </form>
  </div>

{{-- </div> --}}
@endsection

@section('script')
  <script src="{{ asset('js/detail.js') }}"></script>
@endsection