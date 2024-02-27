@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/verify.css') }}" />
@endsection

@section('content')
<div class="div__main">
  <h2 class="h2__verify">メール認証</h2>
  <p class="p__verify">
    ご登録いただいたメールアドレスに認証メールを送付いたしました。<br>
    メールに記載されたリンクより会員登録を完了してください。
  </p>
  <form action="/email/verification-notification" method="POST" class="form__verify">
    @csrf
    <button class="button__resend-mail">認証メールを再送</button>
  </form>
</div>
@endsection