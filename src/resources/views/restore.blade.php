@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/message.css') }}" />
@endsection

@section('content')
<div class="div__main">
  <div class="div__inner">
    <h2 class="h2__message">ご予約を変更しました</h2>
    <a href="/mypage" class="a__back">戻る</a>
  </div>
</div>
@endsection
