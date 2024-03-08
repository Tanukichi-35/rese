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
