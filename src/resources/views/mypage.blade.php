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
      <?php $i = 1?>
      @foreach ($bookings as $booking)
        <div class="div__booking shadow">
          <div class="div__booking-header">
            <div class="div__booking-title">
              <img src="{{asset('img/watch.svg')}}" alt="" class="img_watch">
              <span >予約{{$i++}}</span>
            </div>
            <div class="div__button">
              <img src="{{asset ('img/QR.svg')}}" alt="" class="img__QR">
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
                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->generate($booking->uuid)) !!} ">
                  </div>
                </div>
              </div>
              @if (!$booking->isCheckout())
              <a href="/booking/restore/{{$booking->uuid}}"><img src="{{asset ('img/edit.svg')}}" alt="" class="img__edit"></a>
              <div class="div__delete">
                <form action="/booking/delete" method="POST" class="form__delete" onsubmit="return confirmDeleteBooking()">
                @csrf
                @method('DELETE')
                  <input type="number" name="id" value="{{$booking->id}}" hidden>
                  <button class="button__delete"></button>
                </form>
              </div>
              @endif
            </div>
          </div>
          <table class="table__monitor">
            <tr>
              <th>店名</th>
              <td>{{$booking->store->name}}</td>
            </tr>
            <tr>
              <th>日付</th>
              <td>{{$booking->date}}</td>
            </tr>
            <tr>
              <th>時間</th>
              <td>{{substr($booking->time, 0, -3)}}</td>
            </tr>
            <tr>
              <th>人数</th>
              <td>{{$booking->number}}</td>
            </tr>
          </table>
          @if (!$booking->isCheckout())
            <form class="form__stripe" id="form__stripe" action="{{route('stripe.charge')}}" method="POST" onclick="alertMessageCheckout()">
            @csrf
              <input type="hidden" name="uuid" value="{{$booking->uuid}}">
              <script
                  src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                  data-key="{{ env('STRIPE_KEY') }}"
                  data-amount="{{$booking->payment}}"
                  data-name="お支払い画面"
                  data-label="事前決済"
                  data-description="現在はデモ画面です"
                  data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                  data-locale="auto"
                  data-currency="JPY">
              </script>
            </form>
          @else
            <p class="p__processed">事前決済済</p>
          @endif
        </div>
      @endforeach
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
          <a href="/detail/{{$store->id}}" class="a__store-detail">詳しくみる</a>
          <form method="POST">
          @csrf
            <input type="number" name="store_id" value="{{$store->id}}" hidden>
            @if(Auth::user())
              <img class="img__favorite" data-user_id={{Auth::user()->id}} data-store_id={{$store->id}} src="{{$store->checkFavorite()?asset('img/heart_on.svg'):asset('img/heart_off.svg')}}">
            @else
              <img class="img__favorite" data-user_id="0" data-store_id={{$store->id}} src="{{$store->checkFavorite()?asset('img/heart_on.svg'):asset('img/heart_off.svg')}}">
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