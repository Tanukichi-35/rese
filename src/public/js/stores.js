// 詳細ボタンで詳細ページを開く
$(".button__modal-detail").on('click', function () {
  $(this).next().fadeIn();
});

// xボタンで詳細ページを閉じる
$(".button__modal-close").on('click', function () {
  $('.div__modal-detail').fadeOut();
});

// 詳細ボタンで詳細ページを開く
$(".button__modal-detail").on('click', function () {
  $(this).next().fadeIn();
});

// xボタンで詳細ページを閉じる
$(".button__modal-close").on('click', function () {
  $('.div__modal-detail').fadeOut();
});

// // CSVインポートボタンでcsvファイルインポートページを開く
// $(".button__import").on('click', function () {
//   $(this).next().fadeIn();
// });

// // xボタンでcsvファイルインポートページを閉じる
// $(".button__import").on('click', function () {
//   $('.div__modal-detail').fadeOut();
// });

// csvファイルインポート
function OnFileSelect(inputElement) {
  console.log('file loaded', inputElement);
  // ファイルを取得
  var file = inputElement.files[0];

  // FileReaderを生成
  var fr = new FileReader();

  // 読み込み完了時の処理を追加
  fr.onload = function() {
    // インポート処理を実行
    $('#form__import').submit();
  };

  // ファイルの読み込み
  fr.readAsDataURL(file);
}