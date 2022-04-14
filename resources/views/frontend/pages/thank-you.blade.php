@extends('frontend.master_files.checkout_master')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row">
              <div class="col text-center">
                    <p>Thank you for shopping with us.</p>
                    <form method="get" action="{{ route('homepage') }}">
                        <button class="btn btn-outline-dark mt-auto"> To Continue Shopping </button>
                    </form>
              </div>
            </div>
        </div>
    </section>
@endsection
