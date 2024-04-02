@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/readQR.css') }}" />
@endsection

@section('content')
<div class="div__main">
  <h2>QRコード読み取り</h2>
  <canvas id="canvas__video" height="480" width="640"></canvas>
  <div id="div__error" hidden>
    <p id="p__message">
      データの読み込みに失敗しました。<br>
      読み込むQRコードを確認してください。
    </p>
    <div class="div__reload" onclick="reload()">リロード</div>
  </div>
  <div id="div__check-form" hidden>
    <form id="form__check-QR" action="/manager/qr" method="POST">
    @csrf
      <table>
        <tr>
          <th>店舗：</th>
          <td id="td__store"></td>
        </tr>
        <tr>
          <th>お客様：</th>
          <td id="td__user"></td>
        </tr>
        <tr>
          <th>日付：</th>
          <td id="td__date"></td>
        </tr>
        <tr>
          <th>時間：</th>
          <td id="td__time"></td>
        </tr>
        <tr>
          <th>人数：</th>
          <td id="td__number"></td>
        </tr>
      </table>
      <input id="input__QR-data" name="uuid" type="text" hidden>
      <div class="div__button">
        <div class="div__reload" onclick="reload()">リロード</div>
        <button>確認</button>
      </div>
    </form>
  </div>
</div>

@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.min.js"></script>
    <script src="{{ asset('js/readQR.js') }}"></script>
@endsection



