@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/inputForm.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/mailForm.css') }}" />
@endsection

@section('content')
<div class="div__main">

  {{-- メール送信フォーム --}}
  <div class="div__input-form">
    <div class="div__header">
      <h3 class="h3__input-form">お知らせメール</h3>
    </div>
    <form action="/admin/mail" method="POST" class="form__input-form" enctype="multipart/form-data">
      @csrf
      <table class="table__input-form">
        <tr>
          <th><label for="input__to">送信先</label></th>
          <td>
            <div class="div__checkbox" id="input__to">
              <label><input type="checkbox" name="toUsers">一般ユーザー</label>
              <label><input type="checkbox" name="toManagers">店舗代表者</label>
            </div>
          </td>
        </tr>
        <tr>
          <th><label for="input__subject">件名</label></th>
          <td>
            <input type="text" name="subject" id="input__subject">
          </td>
        </tr>
        <tr>
          <th><label for="input__text">本文</label></th>
          <td>
            <textarea name="text" class="textarea__text" id="input__text" cols="30" rows="20"></textarea>
          </td>
        </tr>
      </table>
      <div class="div__submit">
        <button class="button__submit">送信</button>
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