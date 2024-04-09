// 地域のセレクトボックスを切り替え
$("#select__search-area").on('change', function () {
  $("#form__search").submit();
});

// カテゴリーのセレクトボックスを切り替え
$("#select__search-genre").on('change', function () {
  $("#form__search").submit();
});

// 検索アイコンから検索を実行
$("#img__search").on('click', function () {
  $("#form__search").submit();
});

