<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\Booking;
 
class StripeController extends Controller
{
    public function charge(Request $request)
    {
        $booking = Booking::getBooking($request->uuid);
        Stripe::setApiKey(env('STRIPE_SECRET'));        //シークレットキー

        $charge = Charge::create(array(
            'amount' => $booking->payment,
            'currency' => 'jpy',
            'source'=> $request->stripeToken,
        ));

        $booking->update([
            'status' => $booking->status + 1
        ]);

        return redirect()->route('done');
    }
}
