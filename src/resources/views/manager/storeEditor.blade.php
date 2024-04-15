@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/inputForm.css') }}" />
@endsection

@section('content')
<div class="div__main">
  {{-- 編集フォーム --}}
  <div class="div__input-form">
    <div class="div__header">
      <button class="button__back" onclick="goBackPage()">&lt;</button>
      <h3 class="h3__input-form">店舗情報</h3>
    </div>
    <form action="/manager/store/edit" method="POST" class="form__input-form" enctype="multipart/form-data">
      @csrf
      <table class="table__input-form">
        <tr>
          <th><label for="input__name">店舗名</label></th>
          <td>
            <input type="text" name="name" id="input__name" value="{{$store->name}}">
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
          <th><label for="select__area">地域</label></th>
          <td>
            <select name="area_id" class="select__area" id="select__area">
              @foreach (Area::All() as $area)
              <option value="{{$area->id}}" @if($store->area->id == $area->id) selected @endif>{{$area->name}}</option>
              @endforeach
            </select>
            <div class="div__error">
              <ul>
                @error('area')
                <li class="li__error">
                  {{$message}}
                </li>
                @enderror
              </ul>
            </div>
          </td>
        </tr>
        <tr>
          <th><label for="select__genre">ジャンル</label></th>
          <td>
            <select name="genre_id" class="select__genre" id="select__genre">
              @foreach (Genre::All() as $genre)
              <option value="{{$genre->id}}" @if($store->genre->id == $genre->id) selected @endif>{{$genre->name}}</option>
              @endforeach
            </select>
            <div class="div__error">
              <ul>
                @error('genre')
                <li class="li__error">
                  {{$message}}
                </li>
                @enderror
              </ul>
            </div>
          </td>
        </tr>
        <tr>
          <th><label for="input__description">詳細</label></th>
          <td>
            <textarea name="description" class="textarea__description" cols="30" rows="5">{{$store->description}}</textarea>
            <div class="div__error">
              <ul>
                @error('description')
                <li class="li__error">
                  {{$message}}
                </li>
                @enderror
              </ul>
            </div>
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
            <div class="div__error">
              <ul>
                @error('imageURL')
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
        <input type="text" name="id" value="{{$store->id}}" hidden>
        <button class="button__submit">更新</button>
      </div>
    </form>
  </div>
</div>
@endsection

@section('script')
  <script src="{{ asset('js/inputForm.js') }}"></script>
@endsection