@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/mypage.css') }}" />
@endsection

@section('content')
<div class="div__main">
  
  {{-- 予約一覧 --}}
  <div class="div__left-content">
    <div class="div__booking-list">
      <h3 class="h3__booking">予約状況</h3>
      @for ($i = 0; $i < $bookings->count(); $i++)
        <div class="div__booking">
          <div class="div__booking-header">
            <div class="div__booking-title">
              <img src="{{asset('img/watch.png')}}" alt="" class="img_watch">
              <span >予約{{$i+1}}</span>
            </div>
            <div class="div__button">
              <a href="/booking/QR/{{$bookings[$i]->id}}"><img src="{{asset ('img/QR.png')}}" alt="" class="img__QR"></a>
              <a href="/booking/restore/{{$bookings[$i]->id}}"><img src="{{asset ('img/edit.png')}}" alt="" class="img__edit"></a>
              <div class="div__delete">
                <form action="/booking/delete" method="POST" class="form__delete" onsubmit="return confirmDeleteBooking()">
                @csrf
                  <input type="number" name="id" value="{{$bookings[$i]->id}}" hidden>
                  <button class="button__delete"></button>
                </form>
              </div>
            </div>
          </div>
          <table class="table__monitor">
            <tr>
              <th>店名</th>
              <td>{{$bookings[$i]->store->name}}</td>
            </tr>
            <tr>
              <th>日付</th>
              <td>{{$bookings[$i]->date}}</td>
            </tr>
            <tr>
              <th>時間</th>
              <td>{{substr($bookings[$i]->time, 0, -3)}}</td>
            </tr>
            <tr>
              <th>人数</th>
              <td>{{$bookings[$i]->number}}</td>
            </tr>
          </table>
        </div>
      @endfor
    </div>
  </div>

  {{-- お気に入り一覧 --}}
  <div class="div__right-content">
    <h2 class="h2__user-name">{{$user->name}}さん</h2>
    <h3 class="h3__favorite">お気に入り店舗</h3>
    <div class="div__favorite-list">
      @foreach ($stores as $store)
      <div class="div__card">
        <div class="div__image" style="background-image: url({{$store->imageURL}});"></div>
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
            @if($store->checkFavorite())
              <button class="button__favorite" formaction="/favoriteOff">
                <img src="{{asset('img/heart_on.png')}}" alt="" style="height: 100%;">
              </button>
            @else
              <button class="button__favorite" formaction="/favoriteOn">
                <img src="{{asset('img/heart_off.png')}}" alt="" style="height: 100%;">
              </button>
            @endif
          </form>
        </div>
      </div>
      @endforeach
    </div>
  </div>

</div>
@endsection

@section('script')
  <script src="{{ asset('js/mypage.js') }}"></script>
@endsection