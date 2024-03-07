@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/verify.css') }}" />
@endsection

@section('content')
<div class="div__main">
  <h2 class="h2__verify">メール認証</h2>
  <form action="/email/verification-notification" method="POST" class="form__verify">
    <div class="div__input">
      @csrf
      <p class="p__verify">
        ご登録いただいたメールアドレスに認証メールを送付いたしました。<br>
        メールに記載されたリンクより会員登録を完了してください。
      </p>
      <button class="button__resend-mail">認証メールを再送</button>
    </div>
  </form>
</div>
@endsection