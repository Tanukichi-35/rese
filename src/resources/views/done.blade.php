@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/message.css') }}" />
@endsection

@section('content')
<div class="div__main">
  <div class="div__inner">
    <h2 class="h2__message">ご予約ありがとうございます</h2>
    <button class="button__back" onclick="goBackPage()">戻る</button>
  </div>
</div>
@endsection
