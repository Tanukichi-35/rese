@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
@endsection

@section('content')
<div class="div__main">
  <h2 class="h2__login">Login (店舗代表者)</h2>
  <form action="/manager/login" method="POST" class="form__login">
    @csrf
    <div class="div__input">
      <div class="div__input-email">
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
      <div class="div__input-password">
        <img src="{{ asset('img/password.png')}}" alt="password" class="img__password">
        <input type="password" name="password" class="input__password" placeholder="password">
      </div>
      <div class="div__error">
        <ul>
          @if (session('failure'))
          <li class="li__error">
            {{session('failure')}}
          </li>
          @endif
          @error('password')
          <li class="li__error">
            {{$message}}
          </li>
          @enderror
        </ul>
      </div>
      <button class="button__login">ログイン</button>
    </div>
  </form>
</div>
@endsection