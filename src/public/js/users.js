// 新規登録ボタンでユーザーの新規登録ページを開く
$(".button__create").on('click', function () {
  $(".div__modal-create").fadeIn();
});

// 編集ボタンでユーザー情報編集ページを開く
$(".button__edit").on('click', function () {
  $(this).next().fadeIn();
});