{{$booking->user->name}}様

いつも当店をご利用いただき、誠にありがとうございます。
本日のご予約の詳細についてお知らせいたします。

予約時間：{{substr($booking->time, 0, -3)}}
予約名：{{$booking->user->name}}
予約人数：{{$booking->number}}人

当日のご注意事項:
予約時間にお間違いが無いかご確認ください。
お時間に遅れる場合は、お手数ですがご連絡をお願いいたします。
予約をキャンセルされる場合は、お早めにご連絡ください。

本日も真心を込めたサービスでお待ちしております。
何かご質問やご要望がございましたら、お気軽にお知らせください。

今日も素敵なお食事のひとときをお過ごしください。
どうぞよろしくお願い申し上げます。

{{$booking->store->name}}