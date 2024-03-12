// メニュー項目の切り替え
function switchMenu($user_level) {

  const home = document.getElementById('menu-home');
  const register = document.getElementById('menu-register');
  const login = document.getElementById('menu-login');
  const logout = document.getElementById('menu-logout');
  const mypage = document.getElementById('menu-mypage');
  // const button__logout = document.getElementsByClassName('button__logout');
  // const select__category = document.getElementsByClassName('select__category');
  console.log($user_level)
  switch ($user_level) {
    case 0:   // 未ログイン
      home.style.display = 'block';
      register.style.display = 'block';
      login.style.display = 'block';
      break;
    case 1:   // 一般ユーザー
      home.style.display = 'block';
      logout.style.display = 'block';
      mypage.style.display = 'block';
      break;
    case 2:   // 店舗代表者
      logout.style.display = 'block';
      
      break;
    case 3:   // 管理者
      logout.style.display = 'block';
      
      break;
    default:
      break;
  }
}

// メニューボタンでモーダルウィンドウを開く
$(".button__menu").on('click', function () {
  $(".div__modal").fadeIn();
});

// xボタンでモーダルウィンドウを閉じる
$(".button__modal-close").on('click', function () {
  $('.div__modal').fadeOut();
});

// 戻るボタンでブラウザの履歴を1つ戻る
function goBackPage() {
  window.history.back();
}