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
      <h3 class="h3__input-form">店舗登録</h3>
    </div>
    <form action="/admin/store/register" method="POST" class="form__input-form" enctype="multipart/form-data">
      @csrf
      <table class="table__input-form">
        <tr>
          <th><label for="input__name">店舗名</label></th>
          <td>
            <input type="text" name="name" id="input__name" value="店舗-1">
          </td>
        </tr>
        <tr>
          <th>店舗代表者</th>
          <td></td>
        </tr>
        <tr>
          <td><label for="input__manager-name">（氏名）</label></td>
          <td>
            <input type="text" name="manager_name" id="input__manager-name">
          </td>
        </tr>
        <tr>
          <td><label for="input__email">（メールアドレス）</label></td>
          <td>
            <input type="text" name="email" id="input__email">
          </td>
        </tr>
        <tr>
          <td><label for="input__password">（パスワード）</label></td>
          <td>
            <input type="password" name="password" id="input__password">
          </td>
        </tr>
        <tr>
          <th><label for="select__area">地域</label></th>
          <td>
            <select name="area_id" class="select__area" id="select__area">
              @foreach (Area::All() as $area)
              <option value="{{$area->id}}">{{$area->name}}</option>
              @endforeach
            </select>
          </td>
        </tr>
        <tr>
          <th><label for="select__genre">ジャンル</label></th>
          <td>
            <select name="genre_id" class="select__genre" id="select__genre">
              @foreach (Genre::All() as $genre)
              <option value="{{$genre->id}}">{{$genre->name}}</option>
              @endforeach
            </select>
          </td>
        </tr>
        <tr>
          <th><label for="input__description">詳細</label></th>
          <td>
            <textarea name="description" class="textarea__description" cols="30" rows="5">お店の売りを入力してください。</textarea>
          </td>
        </tr>
        <tr>
          <th><label for="input__image">店舗画像</label></th>
          <td>
            <div class="div__file">
              <img src="" alt="画像が選択されていません">
              <input type="file" name="image" accept=".jpg,.jpeg,.png,.svg" id="input__file" onchange="OnFileSelect(this)"/>
              <label for="input__file">読込</label>
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