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

  <main>
    @yield('content')
  </main>

  {{-- modal-menu --}}
  <div class="div__modal">
    <div class="div__modal-contents">
      <div class="div__modal-close">
        <button class="button__modal-close"></button>
      </div>
      <nav class="nav__menu">
        <div class="div__menu">
          <form class="noraml-menu member-menu" action="/" method="GET" id="button__home">
            @csrf
            <button>ホーム</button>
          </form>
          <form class="noraml-menu" action="/register" method="GET" id="button__register">
            @csrf
            <button>会員登録</button>
          </form>
          <form class="noraml-menu" action="/login" method="GET" id="button__login">
            @csrf
            <button>ログイン</button>
          </form>
          <form class="member-menu" action="/logout" method="POST" id="button__logout">
            @csrf
            <button>ログアウト</button>
          </form>
          <form class="member-menu" action="/mypage" method="GET" id="button__mypage">
            @csrf
            <button>マイページ</button>
          </form>
        </div>
      </nav>
    </div>  
  </div>  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.4/i18n/jquery.ui.datepicker-ja.min.js"></script>
  <script src="{{ asset('js/main.js') }}"></script>
  @yield('script')
</body>

</html>