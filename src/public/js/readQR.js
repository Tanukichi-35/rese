var video = document.createElement("video");
var canvasElement = document.getElementById("canvas__video");
var canvas = canvasElement.getContext("2d");
var error = document.getElementById("div__error");
var message = document.getElementById("p__message");
var form = document.getElementById("div__check-form");
var input = document.getElementById("input__QR-data");
var store = document.getElementById("td__store");
var user = document.getElementById("td__user");
var time = document.getElementById("td__time");
var date = document.getElementById("td__date");
var number = document.getElementById("td__number");

// 背面カメラを利用し画像を取得
navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } }).then(function(stream) {
  video.srcObject = stream;
  video.setAttribute("playsinline", true);
  video.play();
  requestAnimationFrame(tick);
});

function tick() {
  if (video.readyState === video.HAVE_ENOUGH_DATA) {
    canvasElement.hidden = false;

    canvasElement.height = video.videoHeight;
    canvasElement.width = video.videoWidth;
    canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
    var imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
    var code = jsQR(imageData.data, imageData.width, imageData.height, {
      inversionAttempts: "dontInvert",
    });

    if (code) {
      drawLine(code.location.topLeftCorner, code.location.topRightCorner, "#FF3B58");
      drawLine(code.location.topRightCorner, code.location.bottomRightCorner, "#FF3B58");
      drawLine(code.location.bottomRightCorner, code.location.bottomLeftCorner, "#FF3B58");
      drawLine(code.location.bottomLeftCorner, code.location.topLeftCorner, "#FF3B58");
      getData(code.data);
      return;
    }
  }
  requestAnimationFrame(tick);
}

// 線の描画
function drawLine(begin, end, color) {
  canvas.beginPath();
  canvas.moveTo(begin.x, begin.y);
  canvas.lineTo(end.x, end.y);
  canvas.lineWidth = 4;
  canvas.strokeStyle = color;
  canvas.stroke();
}

// データの取得
function getData(uuid){
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
  });

  $.ajax({
    url: "/manager/getQRData",
    type: "POST",
    data: {
      "uuid" : uuid
    },
  }).done(function (res) {
    if (res == 'failure'){
      error.style.display = 'flex';
      message.innerHTML = "データの読み込みに失敗しました。<br>QRコードを確認してください。";
    }
    else if (res == 'mismatch'){
      error.style.display = 'flex';
      message.innerHTML = "異なる店舗の予約情報です。<br>QRコードを確認してください。";
    }
    else if (res == 'done'){
      error.style.display = 'flex';
      message.innerHTML = "処理済みのQRコードです。";
    }
    else {
      store.innerText = res.store;
      user.innerText = res.user;
      date.innerText = res.date;
      time.innerText = res.time;
      number.innerText = res.number;
      input.value = uuid;
      form.hidden = false;
    }
  }).fail(function(XMLHttpRequest, textStatus, errorThrown){
    console.log(XMLHttpRequest.status);
    console.log(textStatus);
    console.log(errorThrown);
  });
}

// 再読み込み
function reload() {
  error.style.display = 'none';
  form.hidden = true;
  store.innerText = "";
  user.innerText = "";
  date.innerText = "";
  time.innerText = "";
  number.innerText = "";
  input.innerText = "";
  tick();
}