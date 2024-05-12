// 評価レートの切り替え
function clickStar($rate) {
  console.log($("#p__url").text());
  let i = 0;
  Array.from($(".img__star")).forEach(star => {
    if (i < $rate) {
      star.src = $("#p__url").text() + '/star_on.svg';
    }
    else {
      star.src = $("#p__url").text() + '/star_off.svg';
    }
    i++;
  });
  $(".input__rate").val($rate)
}

// テキストをカウントし表示
$textArea = $('#textarea__comment');
$textCount = $('#small__text-count');

$textArea.on('input', function (e) {
  $cnt = $textArea.val().length;
  $textCount.text($cnt);

  // 400文字を超えた場合、フォントを赤に変更する
  if ($cnt > 400)
    $textCount.css("color", "#c02600");
  else
    $textCount.css("color", "#000");
});


// ドラッグアンドドロップ処理
var $dropArea = $('#input__file');

$dropArea.on('dragover', function(e) {
  // 余計なイベントをキャンセルする
  e.stopPropagation();
  e.preventDefault();
  $(this).css('border', '3px #ccc dashed');
});
$dropArea.on('dragleave', function(e) {
  e.stopPropagation();
  e.preventDefault();
  $(this).css('border', 'none');
});

// 入力された画像を表示
$dropArea.on('change', function(e) {
  $(this).css('border', 'none');
  console.log(this.files[0]);

  let err = false;
  if (this.files) { // ファイル存在チェック
    Array.from(this.files).forEach(file => {
      if (!file.name.match('.(jpg|jpeg|png)')) { // 許可する拡張子以外の場合
        alert('拡張子が jpg, jpeg, png以外のファイルはアップロードできません。');
        err = true;
        return // 処理を中断
      }
    });
  }

  if (err)
    return false;

  // ファイル読込
  Array.from(this.files).forEach(file => {
    fileReader = new FileReader();
    fileReader.onload = function (event) {
      $('<img>').attr('src', event.target.result).appendTo('#div__image')
    };

    fileReader.readAsDataURL(file);
  });

});

// formの外から送信
$('#div__review-submit').on('click', function (e) {
  $('#form__review').submit();
});

// rate値入力
(function () {
  this.clickStar($(".input__rate").val());
})();

// 画像のクリア
function imageClear() {
  // 入力のクリア
  $('#input__file').val('');

  // 画像のクリア
  // let element = $('#div__file');
  let element = document.getElementById('div__image');
  while(element.firstChild){
    element.removeChild( element.firstChild);
  }
}
