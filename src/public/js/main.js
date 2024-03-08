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