// メニューボタンでモーダルウィンドウを開く
$(".button__menu").on('click', function () {
  $(".div__modal-menu").fadeIn();
});

// xボタンでモーダルウィンドウを閉じる
$(".button__modal-close").on('click', function () {
  $('.div__modal').fadeOut();
});

// 戻るボタンでブラウザの履歴を1つ戻る
function goBackPage() {
  window.history.back();
}

// フラッシュメッセージ
(function() {
    $(function(){
        $('#div__flash-message').fadeOut(2000);
    });
})();

// 決済に関する注意喚起
function alertMessageCheckout() {
  alert("決済後はシステム上での予約の変更ができません");
}