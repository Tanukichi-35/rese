@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/bookings.css') }}" />
@endsection

@section('content')
<div class="div__main">
  <h2 class="h2__title">予約状況</h2>
  <div class="div__table-content">
    {{ $bookings->links() }}
    <table class="table__bookings">
      <tr class="tr__header">
        <th class="th__date">日付</th>
        <th class="th__time">時間</th>
        <th class="th__user">ユーザー名</th>
        <th class="th__number">人数</th>
      </tr>
      @foreach ($bookings as $booking)
      <tr class="tr__contents">
        <td>{{$booking->date}}</td>
        <td>{{$booking->time}}</td>
        <td>{{$booking->user->name}}</td>
        <td>{{$booking->number}}</td>
      </tr>
      @endforeach
    </table>
  </div>
</div>
@endsection