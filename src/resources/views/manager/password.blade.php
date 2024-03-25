@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/inputForm.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/passwordForm.css') }}" />
@endsection

@section('content')
<div class="div__main shadow">
  <h2 class="h2__title">パスワードの変更</h2>
  <form action="/manager/password/edit" method="POST" class="form__password">
    @csrf
    <div class="div__input-form">
      <div class="div__input">
        <label class="label__oldPassword" for="input__oldPassword">元のパスワード</label>
        <input type="password" name="oldPassword" id="input__oldPassword" value="{{ old('oldPassword') }}">
      </div>
      <div class="div__error">
        <ul>
          @error('oldPassword')
          <li class="li__error">
            {{$message}}
          </li>
          @enderror
        </ul>
      </div>
      <div class="div__input">
        <label class="label__password" for="input__password">パスワード</label>
        <input type="password" name="password" id="input__password" value="{{ old('password') }}">
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
      <div class="div__input">
        <label class="label__confirmPassword" for="input__confirmPassword">パスワード（確認）</label>
        <input type="password" name="confirmPassword" id="input__confirmPassword" value="{{ old('confirmPassword') }}">
      </div>
      <div class="div__error">
        <ul>
          @error('confirmPassword')
          <li class="li__error">
            {{$message}}
          </li>
          @enderror
          @if (session('failure'))
          <li class="li__error">
            {{session('failure')}}
          </li>
          @endif
        </ul>
      </div>
    </div>
    <div class="div__ok-cancel">
      <input type="text" name="id" value="{{$manager->id}}" hidden>
      <button >変更</button>
      <label onclick="goBackPage()">キャンセル</label>
    </div>
  </form>
</div>
@endsection