 <!-- Navbar -->
<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
    </ul>  

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account Menu -->
                <li class="nav-item dropdown user user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <span class="hidden-xs">Welcome, {{ \Auth::user()->first_name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <!-- User image -->
                    <li class="user-header bg-primary">
                        <img src="{{ asset('dist/img/favicon.ico') }}" class="img-circle elevation-2" alt="User Image">
                        <p>
                            {{ \Auth::user()->email }}
                        </p>
                    </li>

                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="">
                            <form action="{{ route('logout.admin') }}" method="get" class="text-center">
                                @csrf
                                <center> <input type="submit" class="btn btn-primary btn-flat" name="submit" value="Log Out"> </center>
                             </form>
                        </div>
                    </li>
                    </ul>
                </li>
            </ul>
        </div>
    </ul>
</nav>
<!-- /.navbar -->