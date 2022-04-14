@extends('admin.layout.master', ['sidebar_admins' => 1])

@section('page-title')
    CB | Admins
@endsection



@section('page-content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                    </div><!-- /.col -->

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">

                            <li class="breadcrumb-item active"><a href="{{ route('admin.admins.index') }}">Admins</a></li>

                            <li class="breadcrumb-item active">Edit</li>

                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
      <!-- /.content-header -->

      <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <center> <h3 class="card-title">Edit Admin</h3> </center>
                        </div>

                        <form role="form" method="post" action="{{ route('admin.admins.update', $admin->id) }}">

                            @csrf
                            @method('put')
                            
                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="firstname" class="col-sm-2 col-form-label">First Name<span style="color:red;">*</span></label>
    
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="firstname"  placeholder="Enter First Name" name="firstname" value="{{ $admin->first_name }}" required="">
                                            @if($errors->has('firstname'))
                                            <label for="" id="error_label">{{ $errors->first('firstname') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lastname" class="col-sm-2 col-form-label">Last Name<span style="color:red;">*</span></label>
    
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="lastname"  placeholder="Enter Last Name" name="lastname" value="{{ $admin->last_name }}" required="">
                                            @if($errors->has('lastname'))
                                            <label for="" id="error_label">{{ $errors->first('lastname') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">Email<span style="color:red;">*</span></label>
    
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control email" id="email"  placeholder="Enter Email Name" name="email" value="{{ $admin->email }}" required="">
                                            @if($errors->has('email'))
                                            <label for="" id="error_label">{{ $errors->first('email') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="mobile" class="col-sm-2 col-form-label">Mobile Number<span style="color:red;">*</span></label>
    
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="mobile"  placeholder="Enter Mobile Number" name="mobile" value="{{ $admin->mobile }}" required="">
                                            @if($errors->has('mobile'))
                                            <label for="" id="error_label">{{ $errors->first('mobile') }}</label>
                                            @endif
                                        </div>
                                    </div>                                
                                </div>
                            </div>

                            <div class="card-footer">
                                <center> 
                                    <a href="{{ route('admin.admins.index') }}" class="btn btn-primary" style="color:white; width: 75px;">Back</a>
                                    <button type="submit" class="btn btn-primary">Submit</button> 
                                </center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
      </section>
@endsection