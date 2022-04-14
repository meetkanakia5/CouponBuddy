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

                            <li class="breadcrumb-item active"><a href="{{ route('admin.admins.index') }}">Admin</a></li>

                            <li class="breadcrumb-item active">Add</li>

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
                            <center> <h3 class="card-title">Add Admin</h3> </center>
                        </div>

                        <form role="form" method="post" action="{{ route('admin.admins.store') }}">
                            @csrf
                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="firstname" class="col-sm-2 col-form-label">First Name<span style="color:red;">*</span></label>
    
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="firstname"  placeholder="Enter First Name" name="firstname" value="{{ old('firstname') }}" required="">
                                            @if($errors->has('firstname'))
                                            <label for="" id="error_label">{{ $errors->first('firstname') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lastname" class="col-sm-2 col-form-label">Last Name<span style="color:red;">*</span></label>
    
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="lastname"  placeholder="Enter Last Name" name="lastname" value="{{ old('lastname') }}" required="">
                                            @if($errors->has('lastname'))
                                            <label for="" id="error_label">{{ $errors->first('lastname') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">Email<span style="color:red;">*</span></label>
    
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control email" id="email"  placeholder="Enter Email Name" name="email" value="{{ old('email') }}" required="">
                                            @if($errors->has('email'))
                                            <label for="" id="error_label">{{ $errors->first('email') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="mobile" class="col-sm-2 col-form-label">Mobile Number<span style="color:red;">*</span></label>
    
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="mobile"  placeholder="Enter Mobile Number" name="mobile" value="{{ old('mobile') }}" required="">
                                            @if($errors->has('mobile'))
                                            <label for="" id="error_label">{{ $errors->first('mobile') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-2 col-form-label">Password<span style="color:red;">*</span></label>
    
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="password"  placeholder="Enter Password (Password must be a combination of Uppercase, Lowercase, Number and Symbols)" name="password" required="">
                                            @if($errors->has('password'))
                                            <label for="" id="error_label">{{ $errors->first('password') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    {{-- <div class="form-group row">
                                        <label for="confirm_password" class="col-sm-2 col-form-label">Confirm Password<span style="color:red;">*</span></label>
    
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="confirm_password"  placeholder="Enter Confirm Password" name="confirm_password" required="">
                                            @if($errors->has('confirm_password'))
                                            <label for="" id="error_label">{{ $errors->first('confirm_password') }}</label>
                                            @endif
                                        </div>
                                    </div> --}}
                                </div>
                            </div>

                            <div class="card-footer">
                                <center> 
                                    <a href="{{ route('admin.categories.index') }}" class="btn btn-primary" style="color:white; width: 75px;">Back</a>
                                    <button type="submit" class="btn btn-primary">Submit</button> 
                                </center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
      </section>
@endsection