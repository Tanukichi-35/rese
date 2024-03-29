@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/message.css') }}" />
@endsection

@section('content')
<div class="div__main">
  <div class="div__inner">
    <h2 class="h2__message">会員登録ありがとうございます</h2>
    <a href="/" class="a__back">ホームに移動</a>
  </div>
</div>
@endsection
