<?php

namespace App\Http\Controllers\FrontEndControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use App\CartController;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\CouponCount;
use App\Models\Establishment;
use App\Models\EstablishmentDirection;
use Illuminate\Support\Facades\DB;
use stdClass;

class IndexController extends Controller
{
    public function index(Request $request) {

        if(Auth::guard('web')->check()) {
            $data['user'] = auth()->user();

            // Recommendation: get top 5 the coupons from logged in user
            $data['user_cart'] = Cart::select('coupon_id')
                                ->where('user_id', auth()->user()->id)
                                ->where('is_sent', 1)
                                ->orderBy('coupon_id', 'desc')
                                ->take(5)
                                ->get();
            
            $data['get_subCategories'] = Coupon::select('sub_category_id')
                                        ->whereIn('id', $data['user_cart'])
                                        ->where('start_date', '<=', date('Y-m-d'))
                                        ->where('expiry_date', '>', date('Y-m-d'))
                                        ->where('is_show', 'on')
                                        ->get();

            // get the coupons as per the subcategories, and do not show the coupons which is taken or purchased
            $data['recommended_coupons'] = Coupon::whereIn('sub_category_id', $data['get_subCategories'])
                                            ->where('start_date', '<=', date('Y-m-d'))
                                            ->where('expiry_date', '>', date('Y-m-d'))
                                            ->where('is_show', 'on')
                                            ->whereNotIn('id', $data['user_cart'])
                                            ->orderBy('id', 'desc')
                                            ->take(4)
                                            ->get();

            // taking all the recommended coupons id.
            $coupons_id = [];
            foreach($data['recommended_coupons'] as $recommended_coupons) {
                array_push($coupons_id, $recommended_coupons->id);
            }

            // Recommended coupons should not be shown in all the coupons.
            $data['all_coupons'] = Coupon::where('start_date', '<=', date('Y-m-d'))
                            ->where('expiry_date', '>', date('Y-m-d'))
                            ->where('is_show', 'on')
                            ->whereNotIn('id', $coupons_id)
                            ->orderBy('position')
                            ->get();

            // Near By Coupons
            $data['valid_coupons'] = Coupon::where('start_date', '<=', date('Y-m-d'))
                            ->where('expiry_date', '>', date('Y-m-d'))
                            ->where('is_show', 'on')
                            ->orderBy('position')
                            ->get();

            foreach($data['valid_coupons'] as $key => $coupon){
                $establishment_directions = DB::table('establishment_directions')
                                    ->join('establishments', 'establishments.id', '=', 'establishment_directions.establishment_id')
                                    ->join('coupons', 'coupons.establishment_id', '=', 'establishments.id')
                                    ->select('establishment_directions.address','establishment_directions.direction','establishment_directions.latitude','establishment_directions.longitude')
                                    ->where('coupons.id', '=', $coupon['id'])
                                    ->get();
                                    
                $data['valid_coupons'][$key]->direction = $establishment_directions;

            }

            $data['nearbyCoupons'] = $this->nearByCoupons($data['user'], $data['valid_coupons']);

        } else {
            $data['all_coupons'] = Coupon::where('start_date', '<=', date('Y-m-d'))
                            ->where('expiry_date', '>', date('Y-m-d'))
                            ->where('is_show', 'on')
                            ->orderBy('position')
                            ->get();
        }
        // dd($data['all_coupons']);
        return view('frontend.pages.index', $data);
    }

    public function nearByCoupons($user,$allCoupons){ 
        $nearbyCoupon = [];
        foreach($allCoupons as $key => $coupon){
            
                foreach($coupon->direction as $key => $direction){
                    $distance[$key] = $this->calculateDistance($user->latitude, $direction->latitude, $user->longitude, $direction->longitude);
                    $direction->distance = $distance[$key];
                }
                sort($distance);
                $dis = $distance[0];
        
            if($dis < 3.00){
                array_push($nearbyCoupon, $coupon->toArray());
            }
        }
        return $nearbyCoupon;
    }
    
    public static function calculateDistance($lat1, $lat2, $long1, $long2){
        $r = 6371;
        $l1 = $lat1 * pi()/180;
        $l2 = $lat2 * pi()/180;
        $lo1 = ($lat2 - $lat1) * pi()/180;
        $lo2 = ($long2 - $long1) * pi()/180;
        
        $a = sin($lo1/2) * sin($lo1/2) + cos($l1) * cos($l2) * sin($lo2/2) * sin($lo2/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        $distance = $r * $c;
        return $distance;  
    }

    public function showCoupon($id){
        $data['coupons'] = Coupon::where('id', $id)->get();
        foreach($data['coupons'] as $key => $coupon){
            $establishment_directions = DB::table('establishment_directions')
            ->join('establishments', 'establishments.id', '=', 'establishment_directions.establishment_id')
            ->join('coupons', 'coupons.establishment_id', '=', 'establishments.id')
            ->select('establishment_directions.address','establishment_directions.direction','establishment_directions.latitude','establishment_directions.longitude')
            ->where('coupons.id', '=', $id)
            ->get();
            $data['coupons'][$key]->directions = $establishment_directions;
            foreach($coupon->directions as $key => $direction){
                if(Auth::guard('web')->check()){
                    $user = auth()->user(); 
                    $distance = $this->calculateDistance($user->latitude, $direction->latitude, $user->longitude, $direction->longitude);
                    $coupon->directions[$key]->distance = $distance;
                }
                else{
                    $coupon->directions[$key]->distance = null;
                }
            }
            $coupon->establishment = Establishment::where('id',$coupon->establishment_id)->first();
        }
        return view('frontend.pages.viewCoupons', $data);
    }
    
    public function addToCart(Request $request) {
        
        // user not logged in/Guest User
        if(Auth::guard('web')->check()) {
            $fetchFirstCoupon = CouponCount::where('coupon_id', $request->couponId)->where('is_used', 0)->first();
            
            $userCart                  = new Cart;
            $userCart->user_id         = Auth::id();
            $userCart->coupon_id       = $fetchFirstCoupon->coupon_id;
            $userCart->coupon_count_id = $fetchFirstCoupon->id;
            $userCart->save();

            $fetchFirstCoupon->is_used = 1;
            $fetchFirstCoupon->save();

            $data['cartCount'] = Cart::where('user_id', Auth::id())->where('is_sent', 0)->count();
            $data['message'] = 'saved';
        } else {
            $data['message'] = 'notLoggedIn';
        }

        return response()->json($data);
    }

    public function deleteCoupon(Request $request) {
        $data['cartCount'] = Cart::findOrFail($request->cart_id);
        $data['cartCount']->delete();
        return redirect()->back();
    }
}
