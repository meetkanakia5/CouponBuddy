@extends('admin.layout.master', ['sidebar_users' => 1])

@section('page-title')
    CB | Users
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
                            <li class="breadcrumb-item active"><a href="{{ route('admin.users.index') }}">Users</a></li>
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
                            <center> <h3 class="card-title">Add User</h3> </center>
                        </div>

                        <form role="form" method="post" action="{{ route('admin.users.store') }}">
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
                                        <label for="lastname" class="col-sm-2 col-form-label">Email<span style="color:red;">*</span></label>

                                        <div class="col-sm-10">

                                            <input type="email" class="form-control" id="email"  placeholder="Enter Email" name="email" value="{{ old('email') }}" required="">

                                            @if($errors->has('email'))
                                                <label for="" id="error_label">{{ $errors->first('email') }}</label>
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
                                        <label for="address" class="col-sm-2 col-form-label">Address<span style="color:red;">*</span></label>
    
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="address" placeholder="Enter Address" name="address" value="{{ old('address') }}" required>
                                            @if($errors->has('address'))
                                            <label for="" id="error_label">{{ $errors->first('address') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="zipcode" class="col-sm-2 col-form-label">Postal Code<span style="color:red;">*</span></label>
    
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="zip_code" placeholder="Enter Postal Code" name="zipcode" value="{{ old('zipcode') }}" required readonly>
                                            @if($errors->has('zipcode'))
                                            <label for="" id="error_label">{{ $errors->first('zipcode') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="direction" class="col-sm-2 col-form-label">Direction<span style="color:red;">*</span></label>
    
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="direction" placeholder="Enter Direction" name="direction" value="{{ old('direction') }}" required readonly>
                                            @if($errors->has('direction'))
                                            <label for="" id="error_label">{{ $errors->first('direction') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <input type="hidden" name="latitude" id="latitude" value="">
                                    <input type="hidden" name="longitude" id="longitude" value="">
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
            <script src="{{ asset('js/autoCompleteAddress.js') }}" defer></script>
            <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANlbVsy06mEx8KrK4xj1vDaNhe4NJUJ8k&libraries=places&callback=initMap"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script>
                $(document).ready(function(){
                    autocompleteAddress("#address","#zip_code","#direction","#latitude","#longitude");
                });    
            </script>
      </section>
@endsection