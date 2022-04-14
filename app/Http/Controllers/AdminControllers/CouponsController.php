<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\FrontEndControllers\IndexController;
use Auth;
use File;
use Session;
use App\Models\Establishment;
use App\Models\CouponCount;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Coupon;
use Illuminate\Support\Facades\DB;

class CouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['coupons'] = Coupon::orderBy('id', 'desc')->get();
        return view('admin.pages.coupon.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = Category::orderBy('category')->get();
        return view('admin.pages.coupon.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateCoupon($request);
        $this->saveCoupon(new Coupon, $request);
        Session::flash('created', 'Data Successfully Created');
        return redirect()->route('admin.coupons.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['coupon'] = Coupon::where('id',$id)->first();
        $data['establishment'] = Establishment::where('id',$data['coupon']->establishment_id)->first();
        return view('frontend.pages.viewCoupons', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['categories']     = Category::orderBy('category')->get();
        $data['sub_categories'] = SubCategory::orderBy('id', 'desc')->get();
        $data['establishments']  = Establishment::orderBy('id', 'desc')->get();
        $data['coupon']         = Coupon::findOrFail($id);
        $data['couponsCount']   = CouponCount::where('coupon_id', $id)->where('is_used', 0)->count();  
        return view('admin.pages.coupon.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateCoupon($request);
        $this->saveCoupon(Coupon::findOrFail($id), $request);
        Session::flash('created', 'Data Successfully Updated');
        return redirect()->route('admin.coupons.index');
    }

    public function validateCoupon($data) {
        $data->validate([
            'category_id'      => 'required',
            'sub_category_id'  => 'required',
            'establishment_id' => 'required',
            'start_date'       => 'required',
            'expiry_date'      => 'required',
            'title'            => 'required | max:200',
            'price'            => 'required | max:200',
            'description'      => 'max:500',
            'image'            => 'mimes:jpeg,png,jpg | dimensions:width=355,height=322 | max:2000',
        ]);

        if(!$data->isMethod('put')) {
            $data->validate([
                'image' => 'required',
            ]);
        }
    }

    public function saveCoupon($coupon, $data) {
        $coupon->admin_id         = Auth::user()->id;
        $coupon->category_id      = $data->category_id;
        $coupon->sub_category_id  = $data->sub_category_id;
        $coupon->establishment_id = $data->establishment_id;
        $coupon->start_date       = $data->start_date;
        $coupon->expiry_date      = $data->expiry_date;
        $coupon->is_show          = $data->is_show;
        $coupon->position         = $data->position;
        $coupon->title            = $data->title;
        $coupon->price            = $data->price;
        $coupon->description      = $data->description;
        
        if ($data->hasFile('image'))  {  

            
			// Delete previous file
			if($data->isMethod('put')) {
                File::delete($data->image);
            } else {
                $coupon->image = img_upload($data->file('image'), config('constants.uploads.image'));
            }
        }
        
        $coupon->save();

        // Coupons Entry
        for($i = 0; $i<$data->coupon_quantity; $i++) {
            $couponCount                = new CouponCount;
            $couponCount->coupon_id     = $coupon->id;
            $couponCount->is_used       = 0;
            $couponCount->location_used = 0;
            $couponCount->date_used     = '1900-01-01';
            $couponCount->save();
        }

        return $coupon;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        File::delete($coupon->image);
        $coupon->delete();
        Session::flash('deleted', 'Data Successfully Deleted');
        return redirect()->route('admin.coupons.index');
    }
}
