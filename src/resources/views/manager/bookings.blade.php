@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/listTable.css') }}" />
@endsection

@section('content')
<div class="div__main">
  <div class="div__header">
    <button class="button__back" onclick="goBackPage()">&lt;</button>
    <h2 class="h2__title">{{$store->name}}</h2>
  </div>
  <h2 class="h2__title">予約情報</h2>
  <div class="div__table-content">
    {{ $bookings->links() }}
    <table class="table__list">
      <tr class="tr__header">
        <th class="th__date">日付</th>
        <th class="th__time">時間</th>
        <th class="th__user">ユーザー名</th>
        <th class="th__number">人数</th>
        <th class="th__number">料金</th>
        <th class="th__number">清算</th>
        <th class="th__number">来店</th>
      </tr>
      @foreach ($bookings as $booking)
      <tr class="tr__contents">
        <td>{{$booking->date}}</td>
        <td>{{$booking->time}}</td>
        <td>{{$booking->user->name}}</td>
        <td>{{$booking->number}}</td>
        <td>{{'¥'.number_format($booking->payment)}}</td>
        <td>{{$booking->isCheckout()?'済':'未'}}</td>
        <td>{{$booking->isVisited()?'済':'未'}}</td>
      </tr>
      @endforeach
    </table>
  </div>
</div>
@endsection