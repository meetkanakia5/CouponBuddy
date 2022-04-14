<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('page-title')</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        @include('admin.layout.include-css')
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            
            <!-- Main Header -->
            @include('admin.layout.header')

            <!-- Left side column. contains the logo and sidebar -->
            @include('admin.layout.sidebar')
            
            <!-- Content Wrapper. Contains page content -->
            
                <!-- Main content -->
                <section class="content">
                    
                    <!--------------------------
                    | Your Page Content Here |
                    -------------------------->
                    @yield('page-content')                     
                
                </section>
                <!-- /.content -->
            
            <!-- Main Footer -->
            @include('admin.layout.footer')
        </div>
        <!-- ./wrapper -->    

        @include('admin.layout.include-js')

    </body>

</html>