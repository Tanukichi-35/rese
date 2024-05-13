@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/review.css') }}" />
@endsection

@section('content')
  {{-- 店舗 --}}
  <div class="div__store">
    <div class="div__store-inner">
      <div class="div__back">
        <button class="button__back" onclick="goBackPage()">&lt;</button>
      </div>
      <h2 class="h2__title">体験を評価してください</h2>
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
              <img class="img__favorite" data-user_id={{Auth::user()->id}} data-store_id={{$store->id}} src="{{$store->checkFavorite()?asset('img/heart_on.svg'):asset('img/heart_off.svg')}}">
            @else
              <img class="img__favorite" data-user_id="0" data-store_id={{$store->id}} src="{{$store->checkFavorite()?asset('img/heart_on.svg'):asset('img/heart_off.svg')}}">
            @endif
          </form>
        </div>
      </div>
    </div>
  </div>

  {{-- 口コミ投稿フォーム --}}
  <div class="div__review">
    <form action="/detail/{{$store->id}}/review" method="POST" id="form__review" enctype="multipart/form-data">
      @csrf
      @isset($review)
      <input type="text" name="id" value="{{$review->id}}" hidden/>
      @endisset
      <div class="div__review-inner">
        <div class="div__rate">
          <h3 class="h3__rate">体験を評価してください</h3>
          @if(isset($review))
          <input type="number" class="input__rate" name="rate" value="{{old('rate', $review->rate)}}" hidden>
          @else
          <input type="number" class="input__rate" name="rate" value="{{old('rate', 1)}}" hidden>
          @endisset
          <p id="p__url" hidden>{{asset('img')}}</p>
          <img class="img__star" src="{{asset('img/star_on.svg')}}" alt="" onclick="clickStar(1)">
          @for ($i = 2; $i <= 5; $i++)
            <img class="img__star" src="{{asset('img/star_off.svg')}}" alt="" onclick="clickStar({{$i}})">
          @endfor
        </div>
        <div class="div__error">
          <ul>
            @error('rate')
            <li class="li__error">
              {{$message}}
            </li>
            @enderror
          </ul>
        </div>
        <div class="div__comment">
          <h3 class="h3__comment">口コミを投稿</h3>
          <textarea name="comment" class="textarea__comment" id="textarea__comment" cols="30" rows="8" placeholder="カジュアルな夜のお出かけにお勧めのスポット">@if(isset($review)) {{old('comment', $review->comment)}} @else {{old('comment')}} @endif</textarea>
          <div class="div__comment-upper">
            <small id="small__text-count">0</small>
            <small>/ 400 (最高文字数)</small>
          </div>
        </div>
        <div class="div__error">
          <ul>
            @error('comment')
            <li class="li__error">
              {{$message}}
            </li>
            @enderror
          </ul>
        </div>
        <div class="div__image">
          <h3 class="h3__image">画像の追加</h3>
          <div class="div__file">
            <div id="div__image"></div>
            <input type="file" name="images[]" accept=".jpg,.jpeg,.svg" id="input__file" multiple value="{{old('images[]')}}"/>
            <div class="div__image-message">
              <span>クリックして写真を追加</span>
              <span>またはドラッグアンドドロップ</span>
            </div>
          </div>
          <button type="button" class="button__clear" onclick="imageClear()">クリア</button>
        </div>
      </div>
    </form>
  </div>
  @isset($review)
  <div class="div__review-submit" id="div__review-edit" onclick="editReview({{$review->id}})">更新</div>
  @else
  <div class="div__review-submit" id="div__review-submit" onclick="submitReview({{$store->id}})">口コミを投稿</div>
  @endisset
@endsection

@section('script')
  <script src="{{ asset('js/review.js') }}"></script>
  <script src="{{ asset('js/favorite.js') }}"></script>
@endsection