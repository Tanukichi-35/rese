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

function textCount() {
// $textArea.on('input', function (e) {
  $cnt = $textArea.val().length;
  $textCount.text($cnt);

  // 400文字を超えた場合、フォントを赤に変更する
  if ($cnt > 400)
    $textCount.css("color", "#c02600");
  else
    $textCount.css("color", "#000");
};


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

  // 画像のクリア
  let element = document.getElementById('div__image');
  while(element.firstChild){
    element.removeChild( element.firstChild);
  }

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
function submitReview (store_id) {
  $('#form__review').submit();
};

function editReview(review_id) {
  console.log(review_id);
  $('#form__review').attr('action', '/detail/' + review_id + '/edit');
  console.log($('#form__review'));
  $('#form__review').submit();
};

// 初期値入力
(function () {
  this.clickStar($(".input__rate").val());
  this.textCount();
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
  
  // クリアしたことを記録
  $('#input__clear').prop('checked', true);;
}