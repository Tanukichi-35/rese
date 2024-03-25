<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Rese</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Noto+Sans+JP&display=swap" rel="stylesheet">   
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
  @yield('css')
</head>

<body>
  <div class="div__grid-container">
    <header class="header">
      <div class="header__inner">
        <button class="button__menu">
          <span class="header__menu-bar"></span>
          <span class="header__menu-bar"></span>
          <span class="header__menu-bar"></span>
        </button>
        <h2 class="header__logo">
          Rese
        </h2>
      </div>
    </header>

    {{-- <main> --}}
      @yield('content')
    {{-- </main> --}}
  </div>
  {{-- modal-menu --}}
  <div class="div__modal div__modal-menu">
    <div class="div__modal-menu-contents">
      <div class="div__modal-menu-close">
        <button class="button__modal-close button__modal-menu-close"></button>
      </div>
      <menu>
        <div class="div__menu">
          {{-- 管理者 --}}
          @if (Auth::guard('admins')->check())
            <form action="/admin/users" method="GET">
              @csrf
              <button>ユーザー一覧</button>
            </form>
            <form action="/admin/managers" method="GET">
              @csrf
              <button>店舗代表者一覧</button>
            </form>
            <form action="/admin/stores" method="GET">
              @csrf
              <button>店舗一覧</button>
            </form>
            <form action="/logout" method="POST">
              @csrf
              <button>ログアウト</button>
            </form>
          {{-- 店舗代表者 --}}
          @elseif (Auth::guard('managers')->check())
            <form action="/manager/info" method="GET">
              @csrf
              <button>店舗代表者情報</button>
            </form>
            <form action="/manager/stores" method="GET">
              @csrf
              <button>店舗一覧</button>
            </form>
            {{-- <form action="/manager/bookings" method="GET">
              @csrf
              <button>予約一覧</button>
            </form>
            <form action="/manager/reviews" method="GET">
              @csrf
              <button>レビュー一覧</button>
            </form> --}}
            <form action="/logout" method="POST">
              @csrf
              <button>ログアウト</button>
            </form>
          {{-- 登録ユーザー --}}
          @elseif (Auth::check())
            <form action="/" method="GET">
              @csrf
              <button>飲食店一覧</button>
            </form>
            <form action="/mypage" method="GET">
              @csrf
              <button>マイページ</button>
            </form>
            <form action="/logout" method="POST">
              @csrf
              <button>ログアウト</button>
            </form>
          {{-- ゲストユーザー --}}
          @else
            <form action="/" method="GET">
              @csrf
              <button>飲食店一覧</button>
            </form>
            <form action="/register" method="GET">
              @csrf
              <button>会員登録</button>
            </form>
            <form action="/login" method="GET">
              @csrf
              <button>ログイン</button>
            </form>
          @endif
        </div>
      </menu>
    </div>  
  </div>  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.4/i18n/jquery.ui.datepicker-ja.min.js"></script>
  <script src="{{ asset('js/main.js') }}"></script>
  @yield('script')
</body>

</html>