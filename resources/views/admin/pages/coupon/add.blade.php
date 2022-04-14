@extends('admin.layout.master', ['sidebar_coupon' => 1])

@section('page-title')
    CB | Add Coupon
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

                            <li class="breadcrumb-item active"><a href="{{ route('admin.coupons.index') }}">Coupons</a></li>

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
                            <center> <h3 class="card-title">Add Coupon</h3> </center>
                        </div>

                        <form role="form" method="post" action="{{ route('admin.coupons.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12">

                                <div class="card-body">

                                    {{--  Category  --}}
                                    <div class="form-group row">
                                        <label for="category" class="col-sm-2 col-form-label">Category<span style="color:red;">*</span></label>

                                        <div class="col-sm-10">
                                            <select class="form-control" id="category_id" name="category_id" data-placeholder="Select Category" required>
                                                <option value="">Select Category</option>
                                                @foreach($categories as $key => $category)
                                                    <option value="{{ $category->id }}" id="{{ $category->id }}" {{ (old('category_id') == $category->id) ? 'selected':'' }}>{{ $category->category }}</option>
                                                @endforeach
                                            </select>

                                            @if($errors->has('category_id'))
                                                <label for="" id="error_label">{{ $errors->first('category_id') }}</label>
                                            @endif
                                        </div>
                                    </div>

                                    {{--  Sub Category  --}}
                                    <div class="form-group row">
                                        <label for="sub_category_id" class="col-sm-2 col-form-label">Sub Category<span style="color:red;">*</span></label>
    
                                        <div class="col-sm-10">
                                            <select class="form-control" id="sub_category_id" name="sub_category_id" data-placeholder="Select Sub Category" required>
                                                <option value="">Select Sub Category</option>
                                            </select>
    
                                            @if($errors->has('sub_category_id'))
                                                <label for="" id="error_label">{{ $errors->first('sub_category_id') }}</label>
                                            @endif
                                        </div>
                                    </div>

                                    {{--  Establishment  --}}
                                    <div class="form-group row">
                                        <label for="establishment_id" class="col-sm-2 col-form-label">Establishment<span style="color:red;">*</span></label>
    
                                        <div class="col-sm-10">
                                            <select class="form-control" id="establishment_id" name="establishment_id" data-placeholder="Select Sub Category" required>
                                                <option value="">Select Establishment</option>
                                            </select>
    
                                            @if($errors->has('establishment_id'))
                                                <label for="" id="error_label">{{ $errors->first('establishment_id') }}</label>
                                            @endif
                                        </div>
                                    </div>

                                    {{--  Title  --}}
                                    <div class="form-group row">
                                        <label for="title" class="col-sm-2 col-form-label">Title<span style="color:red;">*</span></label>
    
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="title"  placeholder="Enter Coupon Title" name="title" value="{{ old('title') }}" required="">
    
                                            @if($errors->has('title'))
                                                <label for="" id="error_label">{{ $errors->first('title') }}</label>
                                            @endif
                                        </div>
                                    </div>

                                    {{--  Price  --}}
                                    <div class="form-group row">
                                        <label for="price" class="col-sm-2 col-form-label">Coupon Discount Price<span style="color:red;">*</span></label>
    
                                        <div class="col-sm-10">
                                            <input type="number" step="0.01" class="form-control" id="price"  placeholder="Enter Coupon Discount price" name="price" value="{{ old('price') }}" required="">
    
                                            @if($errors->has('price'))
                                                <label for="" id="error_label">{{ $errors->first('price') }}</label>
                                            @endif
                                        </div>
                                    </div>

                                    {{--  Description  --}}
                                    <div class="form-group row">
                                        <label for="description" class="col-sm-2 col-form-label">Description</label>
    
                                        <div class="col-sm-10">
                                            <textarea id="description" class="form-control" name="description" row=5 col=5 required />  {{ old('description') }}</textarea>
    
                                            @if($errors->has('description'))
                                                <label for="" id="error_label">{{ $errors->first('description') }}</label>
                                            @endif
                                        </div>
                                    </div>

                                    {{--  Start Date  --}}
                                    <div class="form-group row">
                                        <label for="start_date" class="col-sm-2 col-form-label">Start Date<span style="color:red;">*</span></label>
    
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" id="start_date"  placeholder="Enter Expiry Date" name="start_date" value="{{ old('start_date') }}" required="">
    
                                            @if($errors->has('start_date'))
                                                <label for="" id="error_label">{{ $errors->first('start_date') }}</label>
                                            @endif
                                        </div>
                                    </div>

                                    {{--  Date Of Expiry  --}}
                                    <div class="form-group row">
                                        <label for="expiry_date" class="col-sm-2 col-form-label">Expiry Date<span style="color:red;">*</span></label>
    
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" id="expiry_date"  placeholder="Enter Expiry Date" name="expiry_date" value="{{ old('expiry_date') }}" required="">
    
                                            @if($errors->has('expiry_date'))
                                                <label for="" id="error_label">{{ $errors->first('expiry_date') }}</label>
                                            @endif
                                        </div>
                                    </div>

                                    {{--  Counts Of coupons  --}}
                                    <div class="form-group row">
                                        <label for="coupon_quantity" class="col-sm-2 col-form-label">Coupon Quantity<span style="color:red;">*</span></label>
    
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="coupon_quantity"  placeholder="Enter Coupon Quantity" name="coupon_quantity" value="{{ old('coupon_quantity') }}" required="">
                                        </div>
                                    </div>

                                    {{--  Show  --}}
                                    <div class="form-group row">
                                        <label for="is_show" class="control-label col-sm-2">Show</label>
                                        <div class="col-sm-10">
                                            <input type="checkbox" id="is_show" name="is_show" checked>

                                            @if($errors->has('is_show'))
                                                <label for="" id="error_label">{{ $errors->first('is_show') }}</label>
                                            @endif
                                        </div>
                                    </div>

                                    {{--  Coupon Position  --}}
                                    <div class="form-group row">
                                        <label for="position" class="col-sm-2 col-form-label">Coupon Position<span style="color:red;">*</span></label>
    
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="position"  placeholder="Enter Coupon Position" name="position" value="{{ old('position') }}" required="">
    
                                            @if($errors->has('position'))
                                                <label for="" id="error_label">{{ $errors->first('position') }}</label>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Coupon Image  --}}
                                    <div class="form-group row">
                                        <label for="image" class="control-label col-sm-2">Coupon Image(355 x 322 Px)<span style="color:red;"> *</span></label>
                                        <div class="col-sm-10">
                                            <input type="file" class="custom-file-input" name="image" id="image" accept="image/x-png,image/gif,image/jpeg" required/>
                                            <label class="custom-file-label " for="image">Choose file</label>
                                            @if($errors->has('image'))
                                                <label for="" id="error_label">{{ $errors->first('image') }}</label>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer">
                                <center> 
                                    <a href="{{ route('admin.coupons.index') }}" class="btn btn-primary" style="color:white; width: 75px;">Back</a>
                                    <button type="submit" class="btn btn-primary">Submit</button> 
                                </center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
      </section>
@endsection

@section('js-extra')
    <script>
        $('#category_id').change(function() {
            var id = $('#category_id').val();
            $.ajax({
                url:"{{ route('admin.get-sub-categories') }}",
                type:"post",
                data:{'_token' : "{{ csrf_token() }}", 'category_id':id},
                success(data) {
                    if(data.sub_categories.length != 0) {
                        $('#sub_category_id').empty();
                        $('#sub_category_id').append('<option value=""> Select Sub Category </option>');
                        $.each(data.sub_categories, function(key, value) {
                            $('#sub_category_id').append('<option value='+value.id+'>'+value.sub_category+'</option>');
                        }); 
                    } else {
                        $('#sub_category_id').append('<option value=""> No Data </option>');
                    }
                }
            });
        });

        $('#sub_category_id').change(function() {
            var id = $('#sub_category_id').val();
            $.ajax({
                url:"{{ route('admin.get-establishments') }}",
                type:"post",
                data:{'_token' : "{{ csrf_token() }}", 'sub_category_id':id},
                success(data) {
                    if(data.establishments.length != 0) {
                        $('#establishment_id').empty();
                        $('#establishment_id').append('<option value=""> Select Establishment </option>');
                        $.each(data.establishments, function(key, value) {
                            $('#establishment_id').append('<option value='+value.id+'>'+value.name+'</option>');
                        }); 
                    } else {
                        $('#establishment_id').append('<option value=""> No Data </option>');
                    }
                }
            });
        });
    </script>
@endsection