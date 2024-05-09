// ソート処理
function sort() {
  $("#form__search").attr('action','/sort');
  $("#form__search").submit();
}

// フィルター処理
function search() {
  $("#form__search").attr('action','/search');
  $("#form__search").submit();
}