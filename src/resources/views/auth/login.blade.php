@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/loginForm.css') }}" />
@endsection

@section('content')
<div class="div__main shadow">
  <h2 class="h2__title">Login</h2>
  <form action="/login" method="POST" class="form__login">
    @csrf
    <div class="div__input-form">
      <div class="div__input">
        <img src="{{ asset('img/email.png')}}" alt="email" class="img__email">
        <input type="text" name="email" class="input__mail" placeholder="Email" value="{{ old('email') }}" >
      </div>
      <div class="div__error">
        <ul>
          @error('email')
          <li class="li__error">
            {{$message}}
          </li>
          @enderror
        </ul>
      </div>
      <div class="div__input">
        <img src="{{ asset('img/password.png')}}" alt="password" class="img__password">
        <input type="password" name="password" class="input__password" placeholder="password">
      </div>
      <div class="div__error">
        <ul>
          @error('password')
          <li class="li__error">
            {{$message}}
          </li>
          @enderror
        </ul>
      </div>
      <button class="button__submit">ログイン</button>
    </div>
  </form>
</div>
@endsection