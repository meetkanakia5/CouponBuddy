@extends('frontend.master_files.homepage_master')

@section('title')
    Coupons Buddy
@endsection

@section('content')
    @foreach($coupons as $key => $coupon)
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="h3 text-center">
                {{ $coupon->title }}
            </div>
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <img class="img-fluid" src="{{ asset($coupon->image) }}" alt="..." />
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col mt-3 h5">
                            Description:
                            <div class="font-weight-light">
                                {{ $coupon->description }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 mt-3 h5">
                            Valid At:
                            <div class="font-weight-light">
                                *All Nearby {{ $coupon->establishment->name }} branches.
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 mt-3 h5">
                            Expiry Date:
                            <div class="font-weight-light">
                                {{ $coupon->expiry_date }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-3 h5">
                            Address:
                            <div class="font-weight-light">
                                <a href="#" data-toggle="modal" data-target="#viewAddress"> view address </a>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3 h5">
                            Discount Price:
                            <div class="font-weight-light">
                                ${{ $coupon->price }} 
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="viewAddress" tabindex="-1" role="dialog" aria-labelledby="viewAddress" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">Address</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body h6">
                                <ol >
                                    @foreach($coupon->directions as $key => $direction)
                                        @if($direction->distance)
                                        <li class="mb-2">{{ $direction->address }} -  <span class="text-danger"> ({{round($direction->distance, 1)}} km away) </span></li>
                                        @else
                                            <li class="mb-2">{{ $direction->address }} </li>
                                        @endif
                                    @endforeach
                                </ol>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="">
                
                {{-- If user have this coupon then hide add to cart btn --}}
                <?php
                    $hasCoupon = App\Models\Cart::where('user_id', \Auth::id())->where('coupon_id', $coupon->id)->first();
                ?>

                <a class="btn btn-lg btn-danger mt-4" href="{{ route('homepage') }}">Back</a>
                @if(!$hasCoupon)
                    <button class="btn btn-lg mt-4 text-white btn-dark" id="btn-{{ $coupon->id }}" onclick="addCoupon({{ $coupon->id }})"> Add to Cart </button>
                @endif
            </div>

        </div>
            
    @endforeach  
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