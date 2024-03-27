<?php

namespace App\Console\Commands;

use App\Mail\RemindMail;
use App\Models\Booking;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use DateTime;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'リマインドメール送信';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        logger('test');
        $dateTime = new Datetime();
        $bookings = Booking::Where('date', '=', $dateTime->format('Y-m-d'))->get();
        // logger($bookings);

        foreach ($bookings as $booking) {
            $mail = new RemindMail($booking);
            Mail::send($mail);
        }
    }
}
