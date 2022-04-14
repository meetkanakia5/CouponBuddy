@extends('frontend.master_files.homepage_master')

@section('title')
    Coupons Buddy
@endsection

@section('content')
<style>
    .disabled {
  pointer-events: all !important;
}
</style>
    <section class="py-5">
        <div class="container">
            <div class="row">
              <div class="col-xs-12">
                <nav>
                    @if(\Auth::guard('web')->check())
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active " role="tab" aria-selected="true" href="#1" data-toggle="tab">
                        <h4 class="text-success size">Near by coupons</h4>
                        </a>
                        <a class="nav-item nav-link " href="#2" role="tab" aria-selected="false" data-toggle="tab">
                        <h4 class="text-success size">Recommeded Coupons</h4>
                        </a>
                        <a class="nav-item nav-link " href="#3" role="tab" aria-selected="false" data-toggle="tab">
                        <h4 class="text-success size">All Coupons</h4>
                        </a>
                    </div>
                    @else
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active " role="tab" aria-selected="true" href="#1" data-toggle="tab">
                        <h4 class="text-success size">All Coupons</h4>
                        </a>
                    </div>
                    @endif
                </nav>
            </div>
            @if(\Auth::guard('web')->check())
            <div class="tab-content">
                <div class="tab-pane active" id="1">
                    <!-- Content here -->
                    @if(isset($nearbyCoupons) && \Auth::guard('web')->check() && count($nearbyCoupons) > 0)
                        <br>
                        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                            @foreach($nearbyCoupons as $key => $coupon)
                            
                                {{-- Check that coupons are not over --}}
                                <?php
                                    $couponCount = App\Models\CouponCount::where('coupon_id', $coupon['id'])->where('is_used', 0)->count();
                                ?>
                                
                                @if($couponCount > 0)
                                    <div class="col mb-5">
                                        <div class="card h-100">
                                            
                                            <!-- Product image-->
                                            <img class="card-img-top" src="{{ asset($coupon['image']) }}" alt="..." />
            
                                            <!-- Product details-->
                                            <div class="card-body p-4">
                                                <div class="text-center">
                                                    <!-- Product name-->
                                                    <h5 class="">{{ $coupon['title'] }}</h5>
                                                    <!-- Product price-->
                                                    {{-- ${{ $coupon['price'] }} --}}
                                                </div>
                                            </div>
                                            
                                            <!-- Product actions-->
                                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                                <div class="text-center">
                                                    
            
                                                    {{-- If user have this coupon then hide add to cart btn --}}
                                                    <?php
                                                        $hasCoupon = App\Models\Cart::where('user_id', \Auth::id())->where('coupon_id', $coupon['id'])->first();
                                                    ?>
            
                                                    <a href="{{route('show-coupon', $coupon['id'] )}}" class="btn text-white btn-warning mt-auto" id="view-btn"> View </a>
                                                    <span class="d-inline-block" @if($hasCoupon) data-toggle="tooltip" data-placement="bottom" title="Only one Coupon per Person." @endif >
                                                        <button class="btn text-white btn-dark mt-auto"  id="btn-{{ $coupon['id'] }}" onclick="addCoupon({{ $coupon['id'] }})" @if($hasCoupon) disabled style="pointer-events:none;" @endif  > Add to Cart </button>
                                                    </span>
                                                    
                                                    <br />
                                                    {{-- @if($hasCoupon)
                                                        <span style="color:red">Only One Coupon Per Person.</span>
                                                    @endif --}}
            
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div class="text-muted h5 d-flex justify-content-center">
                            <div style="margin-top: 15%">
                                No coupons near by your area yet.
                            </div>
                        </div>
                    @endif
                </div>
                <div class="tab-pane" id="2">
                    @if(isset($recommended_coupons) && \Auth::guard('web')->check() && count($recommended_coupons) > 0)
                        <br>
                        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                            @foreach($recommended_coupons as $key => $coupon)
                            
                                {{-- Check that coupons are not over --}}
                                <?php
                                    $couponCount = App\Models\CouponCount::where('coupon_id', $coupon->id)->where('is_used', 0)->count();
                                ?>
                                
                                @if($couponCount > 0)
                                    <div class="col mb-5">
                                        <div class="card h-100">
                                            
                                            <!-- Product image-->
                                            <img class="card-img-top" src="{{ asset($coupon->image) }}" alt="..." />
            
                                            <!-- Product details-->
                                            <div class="card-body p-4">
                                                <div class="text-center">
                                                    <!-- Product name-->
                                                    <h5 class="">{{ $coupon->title }}</h5>
                                                    <!-- Product price-->
                                                    {{-- ${{ $coupon->price }} --}}
                                                </div>
                                            </div>
                                            
                                            <!-- Product actions-->
                                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                                <div class="text-center">
                                                    
            
                                                    {{-- If user have this coupon then hide add to cart btn --}}
                                                    <?php
                                                        $hasCoupon = App\Models\Cart::where('user_id', \Auth::id())->where('coupon_id', $coupon->id)->first();
                                                    ?>
            
                                                    <a href="{{route('show-coupon', $coupon->id )}}" class="btn text-white btn-warning mt-auto" id="view-btn"> View </a>
                                                    <span class="d-inline-block" @if($hasCoupon) data-toggle="tooltip" data-placement="bottom" title="Only one Coupon per Person." @endif >
                                                        <button class="btn text-white btn-dark mt-auto"  id="btn-{{ $coupon['id'] }}" onclick="addCoupon({{ $coupon['id'] }})" @if($hasCoupon) disabled style="pointer-events:none;" @endif  > Add to Cart </button>
                                                    </span>
            
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div class="text-muted h5 d-flex justify-content-center">
                            <div style="margin-top: 15%">
                                No Recommeded Coupons yet.
                            </div>
                        </div>
                    @endif
                </div>
                <div class="tab-pane" id="3">
                    <br>
                    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                        @foreach($all_coupons as $key => $coupon)
                        
                            {{-- Check that coupons are not over --}}
                            <?php
                                $couponCount = App\Models\CouponCount::where('coupon_id', $coupon->id)->where('is_used', 0)->count();
                            ?>
                            
                            @if($couponCount > 0)
                                <div class="col mb-5">
                                    <div class="card h-100">
                                        
                                        <!-- Product image-->
                                        <img class="card-img-top" src="{{ asset($coupon->image) }}" alt="..." />

                                        <!-- Product details-->
                                        <div class="card-body p-4">
                                            <div class="text-center">
                                                <!-- Product name-->
                                                <h5 class="">{{ $coupon->title }}</h5>
                                                <!-- Product price-->
                                                {{-- ${{ $coupon->price }} --}}
                                            </div>
                                        </div>
                                        
                                        <!-- Product actions-->
                                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                            <div class="text-center">
                                                

                                                {{-- If user have this coupon then hide add to cart btn --}}
                                                <?php
                                                    $hasCoupon = App\Models\Cart::where('user_id', \Auth::id())->where('coupon_id', $coupon->id)->first();
                                                ?>

                                                <a href="{{route('show-coupon', $coupon->id )}}" class="btn text-white btn-warning mt-auto" id="view-btn"> View </a>
                                                <span class="d-inline-block" @if($hasCoupon) data-toggle="tooltip" data-placement="bottom" title="Only one Coupon per Person." @endif >
                                                    <button class="btn text-white btn-dark mt-auto"  id="btn-{{ $coupon['id'] }}" onclick="addCoupon({{ $coupon['id'] }})" @if($hasCoupon) disabled style="pointer-events:none;" @endif  > Add to Cart </button>
                                                </span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                </div>
              </div>
            </div>
            @else
            <div class="tab-content">
                <div class="tab-pane active" id="1">
                    <br>
                    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                        @foreach($all_coupons as $key => $coupon)
                        
                            {{-- Check that coupons are not over --}}
                            <?php
                                $couponCount = App\Models\CouponCount::where('coupon_id', $coupon->id)->where('is_used', 0)->count();
                            ?>
                            
                            @if($couponCount > 0)
                                <div class="col mb-5">
                                    <div class="card h-100">
                                        
                                        <!-- Product image-->
                                        <img class="card-img-top" src="{{ asset($coupon->image) }}" alt="..." />

                                        <!-- Product details-->
                                        <div class="card-body p-4">
                                            <div class="text-center">
                                                <!-- Product name-->
                                                <h5 class="">{{ $coupon->title }}</h5>
                                                <!-- Product price-->
                                                {{-- ${{ $coupon->price }} --}}
                                            </div>
                                        </div>
                                        
                                        <!-- Product actions-->
                                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                            <div class="text-center">
                                                

                                                {{-- If user have this coupon then hide add to cart btn --}}
                                                <?php
                                                    $hasCoupon = App\Models\Cart::where('user_id', \Auth::id())->where('coupon_id', $coupon->id)->first();
                                                ?>

                                                <a href="{{route('show-coupon', $coupon->id )}}" class="btn text-white btn-warning mt-auto" id="view-btn"> View </a>
                                                <span class="d-inline-block" @if($hasCoupon) data-toggle="tooltip" data-placement="bottom" title="Only one Coupon per Person." @endif >
                                                    <button class="btn text-white btn-dark mt-auto"  id="btn-{{ $coupon['id'] }}" onclick="addCoupon({{ $coupon['id'] }})" @if($hasCoupon) disabled style="pointer-events:none;" @endif  > Add to Cart </button>
                                                </span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
    
@endsection

@section('js-extra')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
        function addCoupon(couponId) {
            $.ajax({
                url:"{{ route('add-to-cart') }}",
                type:"post",
                data:{'couponId':couponId},
                success(data) {
                    $('#btn-'+couponId).hide();
                    if(data.message == 'notLoggedIn') {
                        window.location.href = "{{URL::to('/login')}}";
                    } else {
                        $('.cartCount').html(data.cartCount);
                    }
                }
            });
        }
    </script>
@endsection