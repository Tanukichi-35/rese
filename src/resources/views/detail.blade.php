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
        <button href="/" class="button__review" id="button__review">レビュー</button>
    </div>
    <div class="div__store-image">
      <img class="img__store-image" src="{{asset($store->imageURL)}}" alt="">
    </div>
    <div class="div__store-tag">
      <p class="p__area-tag">#{{$store->area->name}}</p>
      <p class="p__category-tag">#{{$store->category->name}}</p>
    </div>
    <div class="div__store-description">
      <p>{{$store->description}}</p>
    </div>
  </div>

  {{-- 予約フォーム --}}
  <div class="div__booking">
    <h3 class="h3__booking">予約</h3>
    <form action="/booking" method="POST" class="form__booking">
      @csrf
      <div class="div__inner">
        <input class="input__store_id" name="store_id" type="number" value="{{$store->id}}" hidden>
        <input class="input__date" id="input__date" name="date" type="date" min="{{date('Y-m-d')}}" max="{{date('Y-m-d', strtotime('3 month'))}}">
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
              <option value="{{$key}}">{{$value}}</option>
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
        <div class="div__number">
          <select class="select__number" id="select__number" name="number">
            @foreach ($store->getNumbers() as $key => $value)
              <option value="{{$key}}">{{$value}}</option>
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
      <button class="button__booking">予約する</button>
    </form>
  </div>

{{-- </div> --}}

{{-- レビューページ（モーダルウィンドウ） --}}
<div class="div__review">
  <div class="div__overlay"></div>
  <div class="div__review-window shadow">
    <div class="div__review-header">
      <h3 class="h3__register">レビュー</h3>
      <div class="div__review-close">
        <button class="button__review-close"></button>
      </div>
    </div>
    <div class="div__show-review">
      @foreach ($store->reviews as $review)
        <div class="div__review-content">
          <p class="p__user-name">{{$review->user->name}} <span class="span__review-date">{{($review->created_at->format('Y/m/d'))}}</span></p>
          <div class="div__show-rate">
            @for ($i = 1; $i <= 5; $i++)
              @if ($i <= $review->rate)
                <img src="{{asset('img/star_on.png')}}" alt="">
              @endif
            @endfor
          </div>
          <p class="p__comment">{{$review->comment}}</p>
        </div>
      @endforeach
    </div>
    <div class="div__submit-review">
      <form action="/submit-review" method="POST" class="form__review">
      @csrf
        <h4 class="h4__review-submit">評価する</h4>
        <input type="number" name="store_id" value="{{$store->id}}" hidden>
        <input type="number" class="input__rate" name="rate" value="1" hidden>
        <div class="div__rate">
          <img class="img__star" src="{{asset('img/star_on.png')}}" alt="" onclick="clickStar(1)">
          @for ($i = 2; $i <= 5; $i++)
            <img class="img__star" src="{{asset('img/star_off.png')}}" alt="" onclick="clickStar({{$i}})">
          @endfor
        </div>
        <textarea name="comment" class="textarea__comment" cols="30" rows="3" placeholder="例：〇〇が美味しかった。"></textarea>
        <button class="button__review-submit">投稿</button>
      </form>
    </div>
  </div>
</div>

@if(session('message'))
<script>
  let msg = "<?php echo session('message');?>";
  alert(msg);
</script>
@endisset

@endsection

@section('script')
  <script src="{{ asset('js/detail.js') }}"></script>
@endsection