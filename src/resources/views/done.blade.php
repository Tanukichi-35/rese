@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/message.css') }}" />
@endsection

@section('content')
<div class="div__main">
  <div class="div__inner">
    @if(session('booking'))
      <h2 class="h2__message">ご予約ありがとうございます</h2>
      <form action="{{route('stripe.charge')}}" method="POST" onclick="alertMessageCheckout()">
      @csrf
        <input type="hidden" name="uuid" value="{{session('booking')->uuid}}">
        <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="{{ env('STRIPE_KEY') }}"
            data-amount="{{session('booking')->payment}}"
            data-name="お支払い画面"
            data-label="事前決済"
            data-description="現在はデモ画面です"
            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
            data-locale="auto"
            data-currency="JPY">
        </script>
      </form>
    @else
      <h2 class="h2__message">決済が完了しました</h2>
    @endif
    <button class="button__back" onclick="goBackPage()">戻る</button>
  </div>
</div>
@endsection
