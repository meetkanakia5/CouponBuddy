@extends('frontend.master_files.checkout_master')

@section('title')
    Coupons Buddy
@endsection

@section('content')
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
           
                @foreach($cartData as $key => $data)
                    <?php
                        $coupon = App\Models\Coupon::findOrfail($data->coupon_id);
                    ?> 
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
                                    ${{ $coupon->price }}
                                </div>
                            </div>
                            
                            <!-- Product actions-->
                            <div class = "card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <form method="post" action="{{ route('delete-coupon') }}">
                                        @csrf
                                        <input type="hidden" value="{{ $data->id }}" name="cart_id" />
                                        <button type="submit" class="btn btn-outline-dark mt-auto"> Delete</i> </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <?php
            $cartCount = App\Models\Cart::where('user_id', Auth::id())->where('is_sent', 0)->count();
        ?>

        @if('{{ \Auth::id() }}' && $cartCount > 0)
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <form method="get" action="{{ route('get-checkout') }}">
                            <button class="btn btn-outline-dark mt-auto"> Checkout </button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div class="container-fluid">
                <div class="row">
                    <div class="col d-flex align-items-center justify-content-center">
                        <div class="h5 text-muted">
                            Your Cart Is Empty!
                        </div>
                    </div>
                </div>
            </div>
        @endif
    


    </section>
@endsection

@section('js-extra')
    <script>

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