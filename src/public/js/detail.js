// 画面ロード時
window.onload = function () {
  // 日付が空の場合、今日の日付を入力
  if (!$("#input__date").val()) {
    $date = new Date();
    $year = $date.getFullYear();
    $month = ( '00' + ($date.getMonth() + 1) ).slice( -2 );
    $day = ( '00' + $date.getDate() ).slice( -2 );
    $("#input__date").val($year+"-"+$month+"-"+$day);
  }

  // テーブルに値を入力
  inputDate();
  inputTime();
  inputNumber();
}

// 日付変更時
$("#input__date").on('change', function () {
  inputDate();
});

// 時間変更時
$("#select__time").on('change', function () {
  inputTime();
});

// 人数変更時
$("#select__number").on('change', function () {
  inputNumber();
});

// テーブルに日付を入力
function inputDate() {
  $date = $("#input__date").val();
  $("#table__date").text($date);
}

// テーブルに時間を入力
function inputTime() {
  $time = $("#select__time option:selected").text();
  $("#table__time").text($time);
}

// テーブルに人数を入力
function inputNumber() {
  $number = $("#select__number option:selected").text();
  $("#table__number").text($number);
}

// 口コミボタンで口コミページを開く
$(".button__review").on('click', function () {
  $(".div__review").fadeIn();
});

// xボタンで口コミページを閉じる
$(".button__review-close").on('click', function () {
  $('.div__review').fadeOut();
});

// 評価レートの切り替え
function clickStar($rate) {
  let i = 0;
  Array.from($(".img__star")).forEach(star => {
    if (i < $rate) {
      star.src = '../img/star_on.svg';
    }
    else {
      star.src = '../img/star_off.svg';
    }
    i++;
  });
  $(".input__rate").val($rate)
}

// 口コミの削除を確認
function confirmDeleteReview() {
  const select = confirm("口コミを削除しますか？");
  return select;
}

// 画像クリックで画像ページを開く
$(".img_review").on('click', function (e) {
  $(".div__image-modal").fadeIn();
  $("#img__review-image").attr("src", e.currentTarget.src);
});

// xボタンで画像ページを閉じる
$("#img__review-image").on('click', function () {
  $('.div__image-modal').fadeOut();
});