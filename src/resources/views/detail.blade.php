@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/detail.css') }}" />
@endsection

@section('content')
  {{-- 店詳細 --}}
  <div class="div__store">
    <div class="div__store-name">
        <button class="button__back" onclick="goBackPage()">&lt;</button>
        <h2 class="h2__store-name">{{$store->name}}</h2>
        {{-- <button href="/" class="button__review" id="button__review">口コミ</button> --}}
    </div>
    <div class="div__store-image">
      <img class="img__store-image" src="{{asset($store->imageURL)}}" alt="画像が登録されていません">
    </div>
    <div class="div__store-tag">
      <p class="p__area-tag">#{{$store->area->name}}</p>
      <p class="p__genre-tag">#{{$store->genre->name}}</p>
    </div>
    <div class="div__store-description">
      <p>{{$store->description}}</p>
    </div>
    <div class="div__store-review">
      @php
          if(Auth::check())
            $review = Auth::user()->reviews->where('store_id', $store->id)->first();
      @endphp
      @if(isset($review) && $review)
      <button class="button__review" id="button__review">全ての口コミ情報</button>
      <div class="div__self-review">
        <div class="div__edit-review">
          <a href="/detail/{{$review->id}}/edit-review" class="a__edit-review">口コミを編集</a>
          <form action="/detail/delete-review" method="POST" class="form__delete-review" onsubmit="return confirmDeleteReview()">
          @csrf
          @method('DELETE')
            <input type="number" name="id" value="{{$review->id}}" hidden>
            <button class="button__delete-review">口コミを削除</button>
          </form>
        </div>
        <div class="div__show-rate">
          @for ($i = 1; $i <= 5; $i++)
            @if ($i <= $review->rate)
              <img src="{{asset('img/star_on.png')}}" alt="">
            @else
              <img src="{{asset('img/star_off.png')}}" alt="">
            @endif
          @endfor
        </div>
        <p class="p__comment">{{$review->comment}}</p>
      </div>
      @else
      <a href="/detail/{{$store->id}}/review" class="a__review">口コミを投稿する</a>
      @endif
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
        <div class="div__fee" hidden>
          <input type="number" name="fee" class="input__fee" value="3000">
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

  {{-- 全口コミ表示ページ（モーダルウィンドウ） --}}
  <div class="div__review">
    <div class="div__overlay"></div>
    <div class="div__review-window shadow">
      <div class="div__review-header">
        <h3 class="h3__register">口コミ</h3>
        <div class="div__review-close">
          <button class="button__review-close"></button>
        </div>
      </div>
      <div class="div__show-review">
        @foreach ($store->reviews as $review)
          <div class="div__review-content">
            <p class="p__user-name">{{$review->user->name}} <span class="span__review-date">{{($review->created_at->format('Y/m/d'))}}</span></p>
            <div class="div__image">
              @foreach ($review->reviewImages as $reviewImage)
                <img class="img_review" src="{{asset($reviewImage->imageURL)}}" alt="">
              @endforeach
            </div>
            <div class="div__show-rate">
              @for ($i = 1; $i <= 5; $i++)
                @if ($i <= $review->rate)
                  <img src="{{asset('img/star_on.png')}}" alt="">
                @else
                  <img src="{{asset('img/star_off.png')}}" alt="">
                @endif
              @endfor
            </div>
            <p class="p__comment">{{$review->comment}}</p>
          </div>
        @endforeach
      </div>
    </div>
  </div>

  {{-- 画像の拡大表示（モーダルウィンドウ） --}}
  <div class="div__image-modal">
    <div class="div__overlay"></div>
    {{-- <div class="div__image-window" id="div__image-window" shadow> --}}
      <img id="img__review-image" src="" alt="">
      {{-- <div class="div__image-header">
        <div class="div__image-close">
          <button class="button__image-close"></button>
        </div>
      </div> --}}
      {{-- <div class="div__show-image">
        <img id="img__review-image" src="" alt="">
      </div> --}}
    {{-- </div> --}}
  </div>  
@endsection

@section('script')
  <script src="{{ asset('js/detail.js') }}"></script>
@endsection