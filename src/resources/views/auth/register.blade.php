@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/register.css') }}" />
@endsection

@section('content')
<div class="div__main">
  <h2 class="h2__register">Registration</h2>
  <form action="/register" method="POST" class="form__register">
    @csrf
    <div class="div__input">
      <div class="div__input-name">
        <img src="{{ asset('img/person.png')}}" alt="name" class="img__name">
        <input type="text" name="name" class="input__name" placeholder="Username" value="{{ old('name') }}" >
      </div>
      <div class="div__input-email">
        <img src="{{ asset('img/email.png')}}" alt="email" class="img__email">
        <input type="text" name="email" class="input__mail" placeholder="Email" value="{{ old('email') }}" >
      </div>
      <div class="div__input-password">
        <img src="{{ asset('img/password.png')}}" alt="password" class="img__password">
        <input type="password" name="password" class="input__password" placeholder="Password">
      </div>
      <button class="button__register">登録</button>
    </div>
  </form>
</div>
@endsection