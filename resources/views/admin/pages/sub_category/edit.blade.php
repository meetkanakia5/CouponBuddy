@extends('admin.layout.master', ['sidebar_category' => 1, 'sidebar_sub_category' => 1])

@section('page-title')
    CB | Sub Categories
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
                            <li class="breadcrumb-item active"><a href="{{ route('admin.sub-categories.index') }}">Sub Categories</a></li>
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
                                <center> <h3 class="card-title">Edit Sub Category</h3> </center>
                            </div>

                            <form role="form" method="post" action="{{ route('admin.sub-categories.update', $sub_category->id) }}">
                                @csrf
                                @method('put')
                                
                                <div class="col-md-12">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="category" class="col-sm-2 col-form-label">Category<span style="color:red;">*</span></label>

                                            <div class="col-sm-10">
                                                <select class="form-control" id="category_id" name="category_id" data-placeholder="Select Category" required>
                                                    <option value="">Select Category</option>
                                                    @foreach($categories as $key => $category)
                                                        <option value="{{ $category->id }}" id="{{ $category->id }}" {{ ($category->id == $sub_category->category_id) ? 'selected':'' }}>{{ $category->category }}</option>
                                                    @endforeach
                                                </select>

                                                @if($errors->has('category_id'))
                                                    <label for="" id="error_label">{{ $errors->first('category_id') }}</label>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="sub_category" class="col-sm-2 col-form-label">Sub Category<span style="color:red;">*</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="sub_category"  placeholder="Enter Sub Category" name="sub_category" value="{{ $sub_category->sub_category }}" required="">

                                                @if($errors->has('sub_category'))
                                                    <label for="" id="error_label">{{ $errors->first('sub_category') }}</label>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <center> 
                                        <a href="{{ route('admin.sub-categories.index') }}" class="btn btn-primary" style="color:white; width: 75px;">Back</a>
                                        <button type="submit" class="btn btn-primary">Submit</button> 
                                    </center>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection