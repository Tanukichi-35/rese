<style>
  table{
    th{
      padding-left: 25px;
      text-align: left;
    }
    td{
      padding-left: 30px;
    }
  }
  .div__caution{
    h4{
      margin-bottom: 3px;
    }
    p{
      margin-top: 0;
      padding-left: 1rem;
    }
  }
  p{
    white-space: pre-wrap;
  }
</style>

<h3>{{$booking->user->name}}様</h3>

<p>
いつも当店をご利用いただき、誠にありがとうございます。<br>
本日のご予約の詳細についてお知らせいたします。
</p>

<table>
  <tr>
    <th>予約店舗</th>
    <td>{{$booking->store->name}}</td>
  </tr>
  <tr>
    <th>予約時間</th>
    <td>{{substr($booking->time, 0, -3)}}</td>
  </tr>
  <tr>
    <th>予約名</th>
    <td>{{$booking->user->name}}</td>
  </tr>
  <tr>
    <th>予約人数</th>
    <td>{{$booking->number}}人</td>
  </tr>
</table>

<div class="div__caution">
  <h4>
  当日のご注意事項:
  </h4>
  <p>
  予約時間にお間違いが無いかご確認ください。<br>
  お時間に遅れる場合は、お手数ですがご連絡をお願いいたします。<br>
  予約をキャンセルされる場合は、お早めにご連絡ください。
  </p>
</div>

<p>
本日も真心を込めたサービスでお待ちしております。<br>
何かご質問やご要望がございましたら、お気軽にお知らせください。
</p>

<p>
今日も素敵なお食事のひとときをお過ごしください。<br>
どうぞよろしくお願い申し上げます。
</p>

<p>
{{$booking->store->name}}
</p>
