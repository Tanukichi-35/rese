@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/mypage.css') }}" />
@endsection

@section('content')
<div class="div__main">
  <h2 class="h2__user-name">{{$user->name}}さん</h2>
  
  {{-- 予約一覧 --}}
  <div class="div__left-content">
    <h3 class="h3__booking">予約状況</h3>
    <div class="div__booking-list">
      @for ($i = 0; $i < $bookings->count(); $i++)
        <div class="div__booking shadow">
          <div class="div__booking-header">
            <div class="div__booking-title">
              <img src="{{asset('img/watch.png')}}" alt="" class="img_watch">
              <span >予約{{$i+1}}</span>
            </div>
            <div class="div__button">
              {{-- <a href="/booking/QR/{{$bookings[$i]->id}}"><img src="{{asset ('img/QR.png')}}" alt="" class="img__QR"></a> --}}
              <img src="{{asset ('img/QR.png')}}" alt="" class="img__QR">
              {{-- modal-QR-page --}}
              <div class="div__modal div__modal-QR">
                <div class="div__overlay"></div>
                <div class="div__modal-page-contents">
                  <div class="div__modal-page-header">
                    <h2 class="h2__modal-QR-header">予約情報</h2>
                    <div class="div__modal-page-close">
                      <button class="button__modal-close button__modal-page-close"></button>
                    </div>
                  </div>
                  <div class="div__modal-page-content">
                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->generate($bookings[$i]->uuid)) !!} ">
                  </div>
                </div>
              </div>
              <a href="/booking/restore/{{$bookings[$i]->uuid}}"><img src="{{asset ('img/edit.png')}}" alt="" class="img__edit"></a>
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
    <h3 class="h3__favorite">お気に入り店舗</h3>
    <div class="div__favorite-list">
      @foreach ($stores as $store)
      <div class="div__store-info shadow">
        <div class="div__image" style="background-image: url({{$store->imageURL}});"></div>
        <h3 class="h3__store-name">{{$store->name}}</h3>
        <div class="div__tag">
            <p class="p__area-tag">#{{$store->area->name}}</p>
            <p class="p__genre-tag">#{{$store->genre->name}}</p>
        </div>
        <div class="div__button">
          <a href="/detail/{{$store->id}}" class="a__store-detail">詳しく見る</a>
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

</div>
@endsection

@section('script')
  <script src="{{ asset('js/mypage.js') }}"></script>
  <script src="{{ asset('js/favorite.js') }}"></script>
@endsection