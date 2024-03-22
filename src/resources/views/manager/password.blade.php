@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/password.css') }}" />
@endsection

@section('content')
<div class="div__main">
  <h2 class="h2__password">パスワードの変更</h2>
  <form action="/manager/password/edit" method="POST" class="form__password">
    @csrf
    <div class="div__input">
      <div class="div__oldPassword">
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
      <div class="div__password">
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
      <div class="div__confirmPassword">
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
    {{-- <div class="div__table">
      <table class="table__password">
        <tr>
          <th><label for="input__passwordOld">元のパスワード</label></th>
          <td>
            <input type="password" name="passwordOld" id="input__passwordOld">
          </td>
        </tr>
        <tr class="tr__error">
          <td>
          <ul>
            @error('passwordOld')
            <li class="li__error">
              {{$message}}
            </li>
            @enderror
          </ul>
          </td>
          <td></td>
        </tr>
        <tr>
          <th><label for="input__password">変更後のパスワード</label></th>
          <td>
            <input type="password" name="password" id="input__password">
          </td>
        </tr>
        <tr class="tr__error">
          <td>
          <ul>
            @error('password')
            <li class="li__error">
              {{$message}}
            </li>
            @enderror
          </ul>
          </td>
          <td></td>
        </tr>
        <tr>
          <th><label for="input__passwordConfirm">変更後のパスワード<br>（確認）</label></th>
          <td>
            <input type="password" name="passwordConfirm" id="input__passwordConfirm">
          </td>
        </tr>
        <tr class="tr__error">
          <td>
          <ul>
            @error('passwordConfirm')
            <li class="li__error">
              {{$message}}
            </li>
            @enderror
          </ul>
          </td>
          <td></td>
        </tr>
      </table>
    </div> --}}
    <div class="div__ok-cancel">
      <input type="text" name="id" value="{{$manager->id}}" hidden>
      <button>変更</button>
      <label onclick="goBackPage()">キャンセル</label>
    </div>
  </form>
</div>
@endsection