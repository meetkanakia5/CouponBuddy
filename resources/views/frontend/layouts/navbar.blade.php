<nav class="navbar navbar-expand-lg bg-dark" style="background-color: #f0f2f5">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand text-white" href="{{ route('homepage') }}">    
            <img src="{{ asset('dist/img/favicon.ico') }}" height=30 width=30 alt="">
            Coupon Buddy
        </a>

        <div class="d-flex justify-content-end">

                @if('{{ \Auth::id() }}')

                    <?php
                        $cartCount = App\Models\Cart::where('user_id', Auth::id())->where('is_sent', 0)->count();
                    ?>
                    <form class="d-flex">
                        <a class="btn btn-outline-warning" href="{{ route('checkout') }}">
                            <i class="bi-cart-fill me-1"></i>
                            <span class="badge bg-light text-dark ms-1 rounded-pill cartCount">{{ $cartCount }}</span>
                        </a>
                    </form>
                @else
                    <form class="d-flex">
                        <button class="btn btn-outline-warning" type="button">
                            <i class="bi-cart-fill me-1"></i>
                            <span class="badge bg- text-white ms-1 rounded-pill">0</span>
                        </button>
                    </form>
                @endif
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            @if(\Auth::user())
                <form class="ml-auto" method="post" action="{{ route('logout') }}">
                    <button class="btn btn-outline-warning" href="">
                        Logout, 
                        <i class="bi bi-file-person"></i>
                        {{ \Auth::user()->first_name }}
                    </button>
                </form>
            @else
                <form class="mr-auto">
                    <a class="btn btn-outline-warning" href="{{ route('login') }}">
                        <i class="bi bi-file-person"></i>
                        Login
                    </a>
                </form>
            @endif

            
            
        </div>
        {{-- </div> --}}
    </div>
</nav>