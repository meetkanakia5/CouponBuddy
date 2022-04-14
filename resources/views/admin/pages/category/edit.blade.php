@extends('admin.layout.master', ['sidebar_category' => 1, 'sidebar_main_category' => 1])

@section('page-title')
    CB | Categories
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

                            <li class="breadcrumb-item active"><a href="{{ route('admin.categories.index') }}">Categories</a></li>

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
                            <center> <h3 class="card-title">Edit Category</h3> </center>
                        </div>

                        <form role="form" method="post" action="{{ route('admin.categories.update', $category->id) }}">

                            @csrf
                            @method('put')
                            
                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class="form-group row">

                                        <label for="category" class="col-sm-2 col-form-label">Category<span style="color:red;">*</span></label>

                                        <div class="col-sm-10">

                                            <input type="text" class="form-control" id="category"  placeholder="Enter Category" name="category" value="{{ $category->category }}" required="">

                                            @if($errors->has('category'))
                                                <label for="" id="error_label">{{ $errors->first('category') }}</label>
                                            @endif
                                        </div>
                                        
                                    </div>
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