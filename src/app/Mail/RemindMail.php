<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RemindMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * 予約インスタンス
     *
     * @var \App\Models\Booking
     */
    public $booking;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $booking = $this->booking;
        return $this->to($booking->user->email, $booking->user->name.'様')
                ->from('admin@ex.com', '管理者')
                ->subject('本日の予約をお知らせします')
                ->view('emails.remind', compact('booking'));
                // ->text('mail.registration_text',['applay_user_name'=>$name,
    }
}
