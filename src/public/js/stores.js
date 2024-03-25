// 詳細ボタンで詳細ページを開く
$(".button__modal-detail").on('click', function () {
  $(this).next().fadeIn();
});

// xボタンで詳細ページを閉じる
$(".button__modal-close").on('click', function () {
  $('.div__modal-detail').fadeOut();
});