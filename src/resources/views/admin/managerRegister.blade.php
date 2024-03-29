@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/inputForm.css') }}" />
@endsection

@section('content')
<div class="div__main">

  {{-- 登録フォーム --}}
  <div class="div__input-form">
    <div class="div__header">
      <button class="button__back" onclick="goBackPage()">&lt;</button>
      <h3 class="h3__input-form">店舗代表者登録</h3>
    </div>
    <form action="/admin/manager/register" method="POST" class="form__input-form" enctype="multipart/form-data">
      @csrf
      <table class="table__input-form">
        <tr>
          <th><label for="input__name">氏名</label></th>
          <td>
            <input type="text" name="name" id="input__name">
            <div class="div__error">
              <ul>
                @error('name')
                <li class="li__error">
                  {{$message}}
                </li>
                @enderror
              </ul>
            </div>
          </td>
        </tr>
        <tr>
          <th><label for="input__email">メールアドレス</label></th>
          <td>
            <input type="text" name="email" id="input__email">
            <div class="div__error">
              <ul>
                @error('email')
                <li class="li__error">
                  {{$message}}
                </li>
                @enderror
              </ul>
            </div>
          </td>
        </tr>
        <tr>
          <th><label for="input__password">パスワード</label></th>
          <td>
            <input type="password" name="password" id="input__password">
            <div class="div__error">
              <ul>
                @error('password')
                <li class="li__error">
                  {{$message}}
                </li>
                @enderror
              </ul>
            </div>
          </td>
        </tr>
      </table>
      <div class="div__submit">
        <button class="button__submit">登録</button>
      </div>
    </form>
  </div>
</div>

@endsection

@section('script')
  <script src="{{ asset('js/inputForm.js') }}"></script>
@endsection