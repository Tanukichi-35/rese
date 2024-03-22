@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/users.css') }}" />
@endsection

@section('content')
<div class="div__main">
  <h2 class="h2__title">登録ユーザー一覧</h2>
  <div class="div__table-content">
    {{-- <div class="div__button">
      <button class="button__create">新規登録</button>
      <form action="/admin/user/batchDelete" method="POST" id="form__batch-delete">
        @csrf
        @method('DELETE')
        <button class="button__delete">一括削除</button>
      </form>
    </div> --}}
    {{ $users->links() }}
    <table class="table__users">
      <tr class="tr__header">
        {{-- <th class="th__checkbox">
        </th> --}}
        <th class="th__name">ユーザー名</th>
        <th class="th__email">メールアドレス</th>
        <th class="th__created-at">登録日</th>
        {{-- <th class="th__function"></th> --}}
      </tr>
      @foreach ($users as $user)
      <tr class="tr__contents">
        {{-- <td class="th__checkbox">
          <input type="checkbox" name="{{$user->id}}" form="form__batch-delete">
        </td> --}}
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->created_at->format('Y/m/d')}}</td>
        {{-- <td class="td__button">
          <button type="button" class="button__edit">編集</button>
          <!-- modal-edit-page -->
          <div class="div__modal div__modal-edit">
            <div class="div__overlay"></div>
            <div class="div__modal-page-contents">
              <div class="div__modal-page-header">
                <h2 class="h2__modal-edit-header">ユーザー情報の更新</h2>
                <div class="div__modal-page-close">
                  <button class="button__modal-close button__modal-page-close"></button>
                </div>
              </div>
              <form action="/admin/user/edit" method="POST" class="form__edit">
                @csrf
                <table class="table__modal">
                  <tr>
                    <th><label for="input__name">お名前</label></th>
                    <td>
                      <input type="text" name="name" id="input__name" value="{{$user->name}}">
                    </td>
                  </tr>
                  <tr>
                    <th><label for="input__email">メールアドレス</label></th>
                    <td>
                      <input type="text" name="email" id="input__email" value="{{$user->email}}">
                    </td>
                  </tr>
                  <tr>
                    <th></th>
                    <td>
                      <input type="text" name="id" value="{{$user->id}}" hidden>
                      <button class="button__restore">更新</button>
                    </td>
                  </tr>
                </table>
              </form>
            </div>
          </div>
          <div class="div__delete">
            <form action="/admin/user/delete" method="POST" class="form__delete">
              @csrf
              @method('DELETE')
              <input type="text" name="id" value="{{$user->id}}" hidden>
              <button class="button__delete">削除</button>
            </form>
          </div>
        </td> --}}
      </tr>
      @endforeach
    </table>
    {{-- modal-create-page --}}
    {{-- <div class="div__modal div__modal-create">
      <div class="div__overlay"></div>
      <div class="div__modal-page-contents">
        <div class="div__modal-page-header">
          <h2 class="h2__modal-create-header">ユーザー登録</h2>
          <div class="div__modal-page-close">
            <button class="button__modal-close button__modal-page-close"></button>
          </div>
        </div>
        <form action="/admin/user/create" method="POST" class="form__create">
        @csrf
          <table class="table__modal">
            <tr>
              <th><label for="input__name">お名前</label></th>
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
            <tr>
              <th></th>
              <td>
                <button class="button__create">登録</button>
              </td>
            </tr>
          </table>
        </form>
      </div>  
    </div> --}}
  </div>
</div>

@endsection

@section('script')
  <script src="{{ asset('js/users.js') }}"></script>
@endsection