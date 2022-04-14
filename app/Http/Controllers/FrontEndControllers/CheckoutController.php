<?php

namespace App\Http\Controllers\FrontEndControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use App\Models\User;
use App\Models\Cart;

class CheckoutController extends Controller
{
    public function checkOut() {
        if(Auth::guard('web')->check()) {
            $data['cartData'] = Cart::where('user_id', Auth::id())->where('is_sent', 0)->get();
            return view('frontend.pages.checkout', $data);
        } else {
            return redirect('/');
        }
    }

    public function getCheckOut() {
        if(Auth::guard('web')->check()) {
            $data['userDetails'] = User::findOrFail(Auth::Id());

            $details = [
                'title' => 'Thank you for shopping',
                'body' => 'Your Coupons'
            ];
           
            \Mail::to($data['userDetails']->email)->send(new \App\Mail\CouponsMail($details));
            return view('frontend.pages.thank-you');
        } else {
            return redirect('/');
        }
    }
}
