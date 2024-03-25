// パスワードの変更モーダルを表示
$(".label__open-password-modal").on('click', function () {
  $(this).next().fadeIn();
});

// モーダルを閉じる
function closeModal() {
  $('.div__modal').fadeOut();
}

// 入力パスワードの破棄
function discardInputPassword() {
  closeModal();
  $('#input__passwordPre').val('');
  $('#input__password').val('');
  $('#input__passwordConfirm').val('');
}

// 画像選択時に画像を読み込む
function OnFileSelect(inputElement){
  // ファイルを取得
  var file = inputElement.files[0];

  // FileReaderを生成
  var fr = new FileReader();

  // 読み込み完了時の処理を追加
  fr.onload = function() {
    // 読み込んだ画像をセット
    $('#'+inputElement.id).prev().attr('src', fr.result);
  };

  // ファイルの読み込み
  fr.readAsDataURL(file);
}