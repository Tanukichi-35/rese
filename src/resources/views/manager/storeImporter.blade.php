@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/listTable.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/stores.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/storeImpoter.css') }}" />
@endsection

@section('content')
<div class="div__main">
  <div class="div__header">
    <button class="button__back" onclick="goBackPage()">&lt;</button>
    <h3 class="h3__title">店舗データのインポート</h3>
  </div>
  @if(!isset($stores))
  <form id="form__load" action="/manager/store/load" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="csv" accept=".csv" id="input__file" onchange="csvFileSelect(this)" hidden/>
    <label class="label__file" for="input__file">CSVファイルの選択</label>
  </form>
  @else
  <form action="/manager/store/import" method="POST" class="form__import" enctype="multipart/form-data">
  @csrf
    <div class="div__table-content">
      <table class="table__list">
        <tr class="tr__header">
          <th class="th__checkbox">
          </th>
          <th class="th__name">店舗名</th>
          <th class="th__area">地域</th>
          <th class="th__genre">ジャンル</th>
          <th class="th__description">店舗詳細</th>
          <th class="th__image">画像</th>
        </tr>
        @foreach ($stores as $store)
        @php
            $index = $loop->index
        @endphp
        <tr class="tr__contents">
          <td class="th__checkbox">
            <input type="checkbox" name="valid[{{$index}}]" data-index="{{$index}}" onclick="clickCheck(this)" @if(old('valid.'.$index, 'on') == 'on')checked @endif>
          </td>
          <td>
            <input type="text" name="names[{{$index}}]" class="input__name" id="input__name-{{$index}}" value="{{old('names.'.$index, $store->name)}}">
          </td>
          <td>
            <select name="area_ids[{{$index}}]" class="select__area" id="select__area-{{$index}}">
              @foreach (Area::All() as $area)
              <option value="{{$area->id}}" @if(old('area_ids.'.$index, $store->area->id) == $area->id) selected @endif>{{$area->name}}</option>
              @endforeach
            </select>
          </td>
          <td>
            <select name="genre_ids[{{$index}}]" class="select__genre" id="select__genre-{{$index}}">
              @foreach (Genre::All() as $genre)
              <option value="{{$genre->id}}" @if(old('genre_ids.'.$index,$store->genre->id) == $genre->id) selected @endif>{{$genre->name}}</option>
              @endforeach
            </select>
          </td>
          <td>
            <textarea name="descriptions[{{$index}}]" class="textarea__description" id="textarea__description-{{$index}}" cols="30" rows="5">{{old('descriptions.'.$index, $store->description)}}</textarea>
          </td>
          <td>
            <div class="div__file">
              <input type="text" name="imageURLs[{{$index}}]" class="input__imageURL" id="input__imageURL-{{$index}}" @if(@file_get_contents($store->imageURL, NULL, NULL, 0, 1)) value="{{$store->imageURL}}" @endif hidden>
              <img src="{{asset($store->imageURL)}}" alt="画像が見つかりません">
              <input type="file" name="images[{{$index}}]" accept=".jpg,.jpeg,.png" id="input__file-{{$index}}"  data-index="{{$index}}" onchange="imgFileSelect(this)"/>
              <label for="input__file-{{$index}}" id="label__file-{{$index}}">選択</label>
            </div>
          </td>
        </tr>
        @endforeach
      </table>
      <div class="div__error">
        <ul>
          @error('names.*')
          <li class="li__error">
            {{$message}}
          </li>
          @enderror
          @error('area_ids.*')
          <li class="li__error">
            {{$message}}
          </li>
          @enderror
          @error('genre_ids.*')
          <li class="li__error">
            {{$message}}
          </li>
          @enderror
          @error('descriptions.*')
          <li class="li__error">
            {{$message}}
          </li>
          @enderror
          @error('imageURLs.*')
          <li class="li__error">
            {{$message}}
          </li>
          @enderror
          @error('images.*')
          <li class="li__error">
            {{$message}}
          </li>
          @enderror
        </ul>
      </div>
      <input type="number" name="dataCount" id="" value="{{$stores->count()}}" hidden>
      <button class="button__import">選択されたデータをインポート</button>
    </div>
  </form>
  @endif
</div>

@endsection

@section('script')
  <script src="{{ asset('js/import.js') }}"></script>
@endsection