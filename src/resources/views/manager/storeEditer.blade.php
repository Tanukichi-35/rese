@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/info.css') }}" />
@endsection

@section('content')
<div class="div__main">

  {{-- 編集フォーム --}}
  <div class="div__input-form">
    <div class="div__header">
      <a class="a__back" href="/manager/stores">&lt;</a>
      <h3 class="h3__input-form">店舗情報</h3>
    </div>
    <form action="/manager/store/edit" method="POST" class="form__input-form" enctype="multipart/form-data">
      @csrf
      <table class="table__input-form">
        <tr>
          <th><label for="input__name">店舗名</label></th>
          <td>
            <input type="text" name="name" id="input__name" value="{{$store->name}}">
          </td>
        </tr>
        <tr>
          <th><label for="select__area">地域</label></th>
          <td>
            <select name="area_id" class="select__area" id="select__area">
              @foreach (Area::All() as $area)
              <option value="{{$area->id}}" @if($store->area->id == $area->id) selected @endif>{{$area->name}}</option>
              @endforeach
            </select>
          </td>
        </tr>
        <tr>
          <th><label for="select__category">ジャンル</label></th>
          <td>
            <select name="category_id" class="select__category" id="select__category">
              @foreach (Category::All() as $category)
              <option value="{{$category->id}}" @if($store->category->id == $category->id) selected @endif>{{$category->name}}</option>
              @endforeach
            </select>
          </td>
        </tr>
        <tr>
          <th><label for="input__description">詳細</label></th>
          <td>
            <textarea name="description" class="textarea__description" cols="30" rows="5">{{$store->description}}</textarea>
          </td>
        </tr>
        <tr>
          <th><label for="input__image">店舗画像</label></th>
          <td>
            <div class="div__file">
              <img src="{{asset($store->imageURL)}}" alt="画像が選択されていません">
              <input type="file" name="image"  accept=".jpg,.jpeg,.png,.svg" id="input__file" onchange="OnFileSelect(this)"/>
              <label for="input__file">読込</label>
            </div>
          </td>
        </tr>
      </table>
      <div class="div__submit">
        <input type="text" name="id" value="{{$store->id}}" hidden>
        <button class="button__submit">更新</button>
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
  <script src="{{ asset('js/storeInfo.js') }}"></script>
@endsection