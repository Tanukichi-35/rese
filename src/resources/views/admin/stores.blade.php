@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/stores.css') }}" />
@endsection

@section('content')
<div class="div__main">
  <h2 class="h2__title">登録店舗一覧</h2>
  <div class="div__table-content">
    <div class="div__button">
      <a class="a__register" href="/admin/store/register">新規登録</a>
      {{-- <button class="a__create">新規登録</button> --}}
      <form action="/admin/store/batchDelete" method="POST" id="form__batch-delete">
        @csrf
        @method('DELETE')
        <button class="button__delete">一括削除</button>
      </form>
    </div>
    {{ $stores->links() }}
    <table class="table__stores">
      <tr class="tr__header">
        <th class="th__checkbox">
        </th>
        <th class="th__name">店舗名</th>
        <th class="th__manager">店舗代表者</th>
        <th class="th__area">地域</th>
        <th class="th__category">ジャンル</th>
        <th class="th__function"></th>
      </tr>
      @foreach ($stores as $store)
      <tr class="tr__contents">
        <td class="th__checkbox">
          <input type="checkbox" name="{{$store->id}}" form="form__batch-delete">
        </td>
        <td>{{$store->name}}</td>
        <td>{{$store->manager->name}}</td>
        <td>{{$store->area->name}}</td>
        <td>{{$store->category->name}}</td>
        <td class="td__button">
          <a class="a__edit" href="/admin/store/edit/{{$store->id}}">編集</a>
          {{-- <button type="button" class="button__edit">編集</button> --}}
          {{-- modal-edit-page --}}
          {{-- <div class="div__modal div__modal-edit">
            <div class="div__overlay"></div>
            <div class="div__modal-page-contents">
              <div class="div__modal-page-header">
                <h2 class="h2__modal-edit-header">店舗情報の更新</h2>
                <div class="div__modal-page-close">
                  <button class="button__modal-close button__modal-page-close"></button>
                </div>
              </div>
              <form action="/admin/store/edit" method="POST" class="form__edit">
                @csrf
                <div class="div__table">
                  <table class="table__modal">
                    <tr>
                      <th><label for="input__name">店舗名</label></th>
                      <td></td>
                      <td>
                        <input type="text" name="name" id="input__name" value="{{$store->name}}">
                      </td>
                    </tr>
                    <tr>
                      <th>店舗代表者</th>
                      <td><label for="input__manager-name">（氏名）</label></td>
                      <td>
                        <input type="text" name="manager_name" id="input__manager-name" value="{{$store->manager->name}}">
                      </td>
                    </tr>
                    <tr>
                      <th></th>
                      <td><label for="input__email">（メールアドレス）</label></td>
                      <td>
                        <input type="text" name="email" id="input__email" value="{{$store->manager->email}}">
                      </td>
                    </tr>
                    <tr>
                      <th><label for="select__area">地域</label></th>
                      <td></td>
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
                      <td></td>
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
                      <td></td>
                      <td>
                        <textarea name="description" class="textarea__description" cols="30" rows="5">{{$store->description}}</textarea>
                      </td>
                    </tr>
                    <tr>
                    <th><label for="input__image">店舗画像</label></th>
                      <td></td>
                      <td>
                        <div class="div__file">
                          <img src="{{asset($store->imageURL)}}" alt="">
                          <input type="file" name="image" accept=".jpg,.jpeg,.png,.svg" id="input__file-edit" onchange="OnFileSelect(this)"/>
                          <label for="input__file-edit">読込</label>
                        </div>
                      </td>
                    </tr>
                  </table>
                </div>
                <div class="div__submit">
                  <input type="text" name="id" value="{{$store->id}}" hidden>
                  <button class="button__restore">更新</button>
                </div>
              </form>
            </div>
          </div> --}}
          <div class="div__delete">
            <form action="/admin/store/delete" method="POST" class="form__delete">
              @csrf
              @method('DELETE')
              <input type="text" name="id" value="{{$store->id}}" hidden>
              <button class="button__delete">削除</button>
            </form>
          </div>
        </td>
      </tr>
      @endforeach
    </table>
    {{-- modal-create-page --}}
    {{-- <div class="div__modal div__modal-create">
      <div class="div__overlay"></div>
      <div class="div__modal-page-contents">
        <div class="div__modal-page-header">
          <h2 class="h2__modal-create-header">店舗登録</h2>
          <div class="div__modal-page-close">
            <button class="button__modal-close button__modal-page-close"></button>
          </div>
        </div>
        <form action="/admin/store/create" method="POST" class="form__create" enctype="multipart/form-data">
          @csrf
          <div class="div__table">
            <table class="table__modal">
              <tr>
                <th><label for="input__store-name">店舗名</label></th>
                <td></td>
                <td>
                  <input type="text" name="name" id="input__store-name" value="店舗-1">
                </td>
              </tr>
              <tr>
                <th>店舗代表者</th>
                <td><label for="input__manager-name">（氏名）</label></td>
                <td>
                  <input type="text" name="manager_name" id="input__manager-name">
                </td>
              </tr>
              <tr>
                <th></th>
                <td><label for="input__email">（メールアドレス）</label></td>
                <td>
                  <input type="text" name="email" id="input__email">
                </td>
              </tr>
              <tr>
                <th></th>
                <td><label for="input__password">（パスワード）</label></td>
                <td>
                  <input type="password" name="password" id="input__password">
                </td>
              </tr>
              <tr>
                <th><label for="select__area">地域</label></th>
                <td></td>
                <td>
                  <select name="area_id" class="select__area" id="select__area">
                    @foreach (Area::All() as $area)
                    <option value="{{$area->id}}">{{$area->name}}</option>
                    @endforeach
                  </select>
                </td>
              </tr>
              <tr>
                <th><label for="select__category">ジャンル</label></th>
                <td></td>
                <td>
                  <select name="category_id" class="select__category" id="select__category">
                    @foreach (Category::All() as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                  </select>
                </td>
              </tr>
              <tr>
                <th><label for="input__description">詳細</label></th>
                <td></td>
                <td>
                  <textarea name="description" class="textarea__description" cols="30" rows="5">お店の売りを入力してください。</textarea>
                </td>
              </tr>
              <tr>
                <th><label for="input__image">店舗画像</label></th>
                <td></td>
                <td>
                  <div class="div__file">
                    <img src="" alt="画像が選択されていません">
                    <input type="file" name="image"  accept=".jpg,.jpeg,.png,.svg" id="input__file-register" onchange="OnFileSelect(this)"/>
                    <label for="input__file-register">読込</label>
                  </div>
                </td>
              </tr>
            </table>
          </div>
          <div class="div__submit">
            <button class="button__register">登録</button>
          </div>
        </form>
      </div>
    </div> --}}
  </div>
</div>

@endsection

{{-- @section('script')
  <script src="{{ asset('js/stores.js') }}"></script>
@endsection --}}