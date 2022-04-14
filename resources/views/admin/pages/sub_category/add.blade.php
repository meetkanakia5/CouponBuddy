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
                                <center> <h3 class="card-title">Add Sub Category</h3> </center>
                            </div>

                            <form role="form" method="post" action="{{ route('admin.sub-categories.store') }}">
                                @csrf
                                <div class="col-md-12">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="category" class="col-sm-2 col-form-label">Category<span style="color:red;">*</span></label>

                                            <div class="col-sm-10">
                                                <select class="form-control" id="category_id" name="category_id" data-placeholder="Select Category" required>
                                                    <option value="">Select Category</option>
                                                    @foreach($categories as $key => $category)
                                                        <option value="{{ $category->id }}" id="{{ $category->id }}" {{ (old('category_id') == $category->id) ? 'selected':'' }}>{{ $category->category }}</option>
                                                    @endforeach
                                                </select>

                                                @if($errors->has('tabs'))
                                                    <label for="" id="error_label">{{ $errors->first('tabs') }}</label>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="sub_category" class="col-sm-2 col-form-label">Sub Category<span style="color:red;">*</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="sub_category"  placeholder="Enter Sub Category" name="sub_category" value="{{ old('sub_category') }}" required="">

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

@section('js-extra')
      <script>
            function showLatLon(sel) {

                var selectedDirections = $('#direction').val();
                if(selectedDirections != null){ 
                    for(var i=0; i<selectedDirections.length; i++) {
                        switch(selectedDirections[i]) {
                            case 'east':
                                $('.east-lat-lon').removeClass('hide');
                                $('.east-lat').prop('required',true);
                                $('.east-lon').prop('required',true);
                            break;

                            case 'west':
                                $('.west-lat-lon').removeClass('hide');
                                $('.west-lat').prop('required',true);
                                $('.west-lon').prop('required',true);
                            break;
                            
                            case 'north':
                                $('.north-lat-lon').removeClass('hide');
                                $('.north-lat').prop('required',true);
                                $('.north-lon').prop('required',true);
                            break
                            
                            case 'south':
                                $('.south-lat-lon').removeClass('hide');
                                $('.south-lat').prop('required',true);
                                $('.south-lon').prop('required',true);
                            break
                        }
                    }
                }

                // This should be checked all the time to know what is there in directions array and if any direction is not there then hide the lartitide longitude text boxes.
                
                // if one of the selectedDirection will be missing from allDirections that will give -1 and hence those textboxes will hidden

                var allDirections = ['east', 'west', 'north', 'south'];
                for(var j = 0; j<4; j++) {
                    if(jQuery.inArray(allDirections[j], selectedDirections) == -1) {
                        $('.'+allDirections[j]+'-lat-lon').addClass('hide');
                        $('.'+allDirections[j]+'-lat').prop('required',false);
                        $('.'+allDirections[j]+'-lon').prop('required',false);
                        $('.'+allDirections[j]+'-lat').val("");
                        $('.'+allDirections[j]+'-lon').val("");
                    }
                }
            }
      </script>
@endsection