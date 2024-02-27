@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('link')
<ul>
  <li><a href="/">ホーム</a></li>
  <li><a href="/attendance">日付一覧</a></li>
  <li><a href="/user">ユーザー一覧</a></li>
  <li>
    <form action="/logout" method="POST">
      @csrf
      <button>ログアウト</button>
    </form>
  </li>
</ul>
@endsection

@section('content')
<div class="div__main">
  <h2 class="h2__atte">{{$user->getMessage()}}</h2>
  <form method="POST" class="form__atte">
    @csrf
    <div class="div__menu">
      <div class="div__menu-upper">
        <button formaction="/work-start" class="button__work-start" id="button__work-start">勤務開始</button>
        <button formaction="/work-end" class="button__work-end" id="button__work-end" disabled>勤務終了</button>
      </div>
      <div class="div__menu-lower">
        <button formaction="/break-start" class="button__break-start" id="button__break-start" disabled>休憩開始</button>
        <button formaction="/break-end" class="button__break-end" id="button__break-end" disabled>休憩終了</button>
      </div>
    </div>
    <div class="div__status">
      <label>ユーザーID：
        <input type="text" name="user_id" class="input__user" value={{$user->id}}>
      </label>
      <label>勤怠ID：
        <input type="text" name="attendance_id" class="input__attendance" value={{$user->getAttendanceID()}}>
      </label>
      <label>休憩ID：
        <input type="text" name="rest_id" class="input__rest" value={{$user->getRestID()}}>
      </label>
      <label>ステータス：
        <input type="text" name="status" class="input__status" id="input__status" value={{$user->getStatus()}}>
      </label>
    </div>
  </form>
</div>
@endsection