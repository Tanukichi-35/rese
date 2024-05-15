// csvファイル選択
function csvFileSelect(inputElement) {
  // ファイルを取得
  var file = inputElement.files[0];

  // FileReaderを生成
  var fr = new FileReader();

  // 読み込み完了時の処理を追加
  fr.onload = function() {
    // インポート処理を実行
    $('#form__load').submit();
  };

  // ファイルの読み込み
  fr.readAsDataURL(file);
}

// 画像ファイル選択
function imgFileSelect(inputElement) {
  let index = inputElement.dataset.index;

  // ファイルを取得
  var file = inputElement.files[0];

  // FileReaderを生成
  var fr = new FileReader();

  // 読み込み完了時の処理を追加
  fr.onload = function() {
    // 読み込んだ画像をセット
    inputElement.previousElementSibling.src = fr.result;
    // バリデーションに引っかからないよう文字列を入れておく
    $(`#input__imageURL-${index}`).val('imageUpload');
  };

  // ファイルの読み込み
  fr.readAsDataURL(file);
}

// チェックボックス切り替え
function clickCheck(inputElement) {
  let index = inputElement.dataset.index;
  let isDisabled = !inputElement.checked;
  $(`#input__name-${index}`).prop("disabled", isDisabled)
  $(`#select__area-${index}`).prop("disabled", isDisabled)
  $(`#select__genre-${index}`).prop("disabled", isDisabled)
  $(`#textarea__description-${index}`).prop("disabled", isDisabled)
  $(`#input__imageURL-${index}`).prop("disabled", isDisabled)
  $(`#input__file-${index}`).prop("disabled", isDisabled)
  if (isDisabled) {
    $(`#label__file-${index}`).css('cursor', 'not-allowed')
    $(`#label__file-${index}`).css('color', 'gray')
  }
  else {
    $(`#label__file-${index}`).css('cursor', 'pointer')
    $(`#label__file-${index}`).css('color', 'black')
  }
}
