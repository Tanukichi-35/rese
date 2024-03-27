@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/inputForm.css') }}" />
@endsection

@section('content')
<div class="div__main">

  {{-- 登録フォーム --}}
  <div class="div__input-form">
    <div class="div__header">
      <a class="a__back" href="/admin/managers">&lt;</a>
      <h3 class="h3__input-form">店舗代表者登録</h3>
    </div>
    <form action="/admin/manager/register" method="POST" class="form__input-form" enctype="multipart/form-data">
      @csrf
      <table class="table__input-form">
        <tr>
          <th><label for="input__name">氏名</label></th>
          <td>
            <input type="text" name="name" id="input__name">
          </td>
        </tr>
        <tr>
          <th><label for="input__email">メールアドレス</label></th>
          <td>
            <input type="text" name="email" id="input__email">
          </td>
        </tr>
        <tr>
          <th><label for="input__password">パスワード</label></th>
          <td>
            <input type="password" name="password" id="input__password">
          </td>
        </tr>
      </table>
      <div class="div__submit">
        <button class="button__submit">登録</button>
      </div>
    </form>
  </div>
</div>

@if(session('message'))
<script>
  let msg = "<?php echo session('message');?>";
  alert(msg);
</script>
@endisset

@endsection

@section('script')
  <script src="{{ asset('js/inputForm.js') }}"></script>
@endsection