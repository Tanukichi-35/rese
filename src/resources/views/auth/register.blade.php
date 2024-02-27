@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/register.css') }}" />
@endsection

@section('content')
<div class="div__main">
  <h2 class="h2__register">会員登録</h2>
  <form action="/register" method="POST" class="form__register">
    @csrf
    <div class="div__input">
      <input type="text" name="name" class="input__name" placeholder="名前" value="{{ old('name') }}" >
      <div class="form__error">
        <ul>
          @error('name')
          <li>
            {{$message}}
          </li>
          @enderror
        </ul>
      </div>
      <input type="text" name="email" class="input__mail" placeholder="メールアドレス" value="{{ old('email') }}" >
      <div class="form__error">
        <ul>
          @error('email')
          <li>
            {{$message}}
          </li>
          @enderror
        </ul>
      </div>
      <input type="password" name="password" class="input__password" placeholder="パスワード">
      <div class="form__error">
        <ul>
          @error('password')
          <li>
            {{$message}}
          </li>
          @enderror
        </ul>
      </div>
      <input type="password" name="password_confirmation" class="input__password_confirmation" placeholder="確認用パスワード">
      <div class="form__error">
        <ul>
          @error('password-confirm')
          <li>
            {{$message}}
          </li>
          @enderror
        </ul>
      </div>
    </div>
    <button class="button__register">会員登録</button>
  </form>
  <div class="div__login">
    <p class="p__login">アカウントをお持ちの方はこちらから</p>
    <a href="/login" class="a__login">ログイン</a>
  </div>
</div>
@endsection