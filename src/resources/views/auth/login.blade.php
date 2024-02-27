@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
@endsection

@section('content')
<div class="div__main">
  <h2 class="h2__login">ログイン</h2>
  <form action="/login" method="POST" class="form__login">
    @csrf
    <div class="div__input">
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
    </div>
    <button class="button__login">ログイン</button>
  </form>
  <div class="div__register">
    <p class="p__register">アカウントをお持ちでない方はこちらから</p>
    <a href="/register" class="a__register">会員登録</a>
  </div>
</div>
@endsection