@extends('frontend.master_files.coupon_mail_master')

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
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection