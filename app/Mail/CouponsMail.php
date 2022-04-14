<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Auth;
use App\Models\Cart;


class CouponsMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // set is_sent flag to 1
        $data['cartData'] = Cart::where('user_id', Auth::id())->where('is_sent', 0)->get();
        foreach($data['cartData'] as $key => $cartData) {
            $cartData->is_sent = 1;
            $cartData->save();
        }
        return $this->view('frontend.pages.coupon_mail', $data);
    }
}
