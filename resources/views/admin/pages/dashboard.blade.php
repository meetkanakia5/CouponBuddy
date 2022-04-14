@extends('admin.layout.master', ['sidebar_dashboard' => 1])



@section('page-title')

    Dashboard

@endsection



@section('css-extra')

@endsection



@section('page-content')



    <div class="content-wrapper">



        <!-- Content Header (Page header) -->

        <div class="content-header">



            <div class="container-fluid">

                <div class="row mb-2">

    

                    <div class="col">

                        <h1 class="m-0 text-dark text-center text-bold">Dashboard</h1>

                    </div>

                    

                    {{-- <div class="col-sm-6">

                        <ol class="breadcrumb float-sm-right"> --}}

                            {{--  <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Home</a></li>  --}}

                            {{-- <li class="breadcrumb-item active">Dashboard</li>

                        </ol>

                    </div> --}}

    

                </div>

            </div>





        </div>

        <!-- /.content-header -->



    </div>

  

@endsection





@section('js-extra')

@endsection