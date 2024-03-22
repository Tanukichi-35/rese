// // 新規登録ボタンで店舗の新規登録ページを開く
// $(".button__create").on('click', function () {
//   $(".div__modal-create").fadeIn();
// });

// // 編集ボタンで店舗情報編集ページを開く
// $(".button__edit").on('click', function () {
//   $(this).next().fadeIn();
// });

// // 編集ボタンで店舗代表者情報編集ページを開く
// $(".button__manager").on('click', function () {
//   $(this).next().fadeIn();
// });

// // 画像選択時に画像を読み込む
// function OnFileSelect(inputElement)
// {
//   // ファイルを取得
//   var file = inputElement.files[0];

//   // FileReaderを生成
//   var fr = new FileReader();

//   // 読み込み完了時の処理を追加
//   fr.onload = function() {
//     // 読み込んだ画像をセット
//     $('#'+inputElement.id).prev().attr('src', fr.result);
//   };

//   // ファイルの読み込み
//   fr.readAsDataURL(file);
// }