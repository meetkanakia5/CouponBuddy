@extends('admin.layout.master', ['sidebar_establishments' => 1])

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

                            <form role="form" method="post" action="{{ route('admin.establishments.update', $establishment->id) }}">
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
                                                        <option value="{{ $category->id }}" id="{{ $category->id }}" {{ ($category->id == $establishment->category_id) ? 'selected':'' }}>{{ $category->category }}</option>
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
                                                    @foreach($sub_categories as $key => $sub_category)
                                                        <option value="{{ $sub_category->id }}" id="{{ $sub_category->id }}" {{ ($sub_category->id == $establishment->sub_category_id) ? 'selected':'' }}>{{ $sub_category->sub_category }}</option>
                                                    @endforeach
                                                </select>
        
                                                @if($errors->has('sub_category_id'))
                                                    <label for="" id="error_label">{{ $errors->first('sub_category_id') }}</label>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="name" class="col-sm-2 col-form-label">Establishment Name<span style="color:red;">*</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="establishment_name"  placeholder="Enter Establishment Name" name="establishment_name" value="{{ $establishment->name }}" required="">

                                                @if($errors->has('establishment_name'))
                                                    <label for="" id="error_label">{{ $errors->first('establishment_name') }}</label>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-2 col-form-label">Email<span style="color:red;">*</span></label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="email"  placeholder="Enter Email" name="email" value="{{ $establishment->email }}" required="">

                                                @if($errors->has('email'))
                                                    <label for="" id="error_label">{{ $errors->first('email') }}</label>
                                                @endif
                                            </div>
                                            
                                        </div>

                                        <div class="form-group row">
                                            <label for="phone" class="col-sm-2 col-form-label">Phone<span style="color:red;">*</span></label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control" id="phone"  placeholder="Enter Phone" name="phone" value="{{ $establishment->phone }}" required="">

                                                @if($errors->has('phone'))
                                                    <label for="" id="error_label">{{ $errors->first('phone') }}</label>
                                                @endif
                                            </div>
                                        </div>
                                        <input id="addressCount" value="{{ count($establishment_directions) }}" hidden/>
                                        @foreach($establishment_directions as $key => $establishment_direction)
                                        <div id='addressSection_{{ $key }}'>
                                            <div class="form-group row">
                                                <label for="address" class="col-sm-2 col-form-label">Address<span style="color:red;">*</span></label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="address_{{ $key }}" row=4 name="address[{{ $key }}]" placeholder="Enter Address" value="{{ $establishment_direction->address }}" required="">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="pincode" class="col-sm-2 col-form-label">Postal Code<span style="color:red;">*</span></label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="pincode_{{ $key }}" placeholder="Enter Postal Code" name="pincode[{{ $key }}]" value="{{ $establishment_direction->pincode }}" required="" readonly>

                                                    @if($errors->has('pincode'))
                                                        <label for="" id="error_label">{{ $errors->first('pincode') }}</label>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="direction" class="col-sm-2 col-form-label">Direction<span style="color:red;">*</span></label>

                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="direction_{{ $key }}" placeholder="Enter Direction" name="direction[{{ $key }}]" value="{{ $establishment_direction->direction }}" required="" readonly>
                                                    @if($errors->has('direction'))
                                                        <label for="" id="error_label">{{ $errors->first('direction') }}</label>
                                                    @endif
                                                </div>
                                            </div>

                                            <input type="hidden" id="latitude_{{ $key }}" name="latitude[{{ $key }}]" value="{{ $establishment_direction->latitude }}">
                                            <input type="hidden" id="longitude_{{ $key }}" name="longitude[{{ $key }}]" value="{{ $establishment_direction->longitude }}">
                                        </div>
                                        @endforeach
                                        <div class="d-flex justify-content-end mb-3" id="addAddress">
                                            <a class="btn btn-small btn-danger mx-1 text-white" id="remove" hidden>Remove Previous</a>
                                            <a class="btn btn-small btn-info text-white" id="add" >Add another address</a>
                                        </div>

                                        
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <center> 
                                        <a href="{{ route('admin.establishments.index') }}" class="btn btn-primary" style="color:white; width: 75px;">Back</a>
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
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANlbVsy06mEx8KrK4xj1vDaNhe4NJUJ8k&libraries=places&callback=initMap"></script>
    <script src="{{ asset('js/autoCompleteAddress.js') }}" defer></script>
    <script>
        var addressIndex = document.querySelector('#addressCount').value;
        $(document).ready(function(){
            if(addressIndex > 1){
                $('#remove').removeAttr('hidden');
            }
            autocompleteAddress('#address', '#postalCode', '#direction', '#latitude', '#longitude');
            $('#add').on('click',function(){
                let addAddressNodes = ` 
                    <div id='addressSection_${addressIndex}'>
                    <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label">Address<span style="color:red;">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="address_${addressIndex}" row=4 name="address[${addressIndex}]" placeholder="Enter Address" value="{{ old('address') }}">

                            @if($errors->has('address'))
                                <label for="" id="error_label">{{ $errors->first('address') }}</label>
                            @endif
                        </div>
                        
                    </div>

                    <div class="form-group row">
                        <label for="pincode" class="col-sm-2 col-form-label">Postal Code<span style="color:red;">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="postalCode_${addressIndex}" placeholder="Enter Postal Code" name="pincode[${addressIndex}]" value="{{ old('pincode') }}" required="" readonly>

                            @if($errors->has('pincode'))
                                <label for="" id="error_label">{{ $errors->first('pincode') }}</label>
                            @endif
                        </div>
                        
                    </div>


                    <div class="form-group row">
                        <label for="direction" class="col-sm-2 col-form-label">Direction<span style="color:red;">*</span></label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="direction_${addressIndex}" placeholder="Enter Direction" name="direction[${addressIndex}]" value="{{ old('direction') }}" required="" readonly>
                            @if($errors->has('direction'))
                                <label for="" id="error_label">{{ $errors->first('direction') }}</label>
                            @endif
                        </div>
                    </div>
                    <input type="hidden" id="latitude_${addressIndex}" name="latitude[${addressIndex}]" value="">
                    <input type="hidden" id="longitude_${addressIndex}" name="longitude[${addressIndex}]" value="">
                    </div>
                    `;                    
                const add = document.getElementById("addAddress");
                add.insertAdjacentHTML('beforebegin',addAddressNodes);
                autocompleteAddress(`#address_${addressIndex}`, `#postalCode_${addressIndex}`, `#direction_${addressIndex}`,`#latitude_${addressIndex}`, `#longitude_${addressIndex}`);
                addressIndex++;
                if(addressIndex > 1){
                    $('#remove').removeAttr('hidden');
                }
                
            });
            $('#remove').on('click', function(){
                elementID = addressIndex - 1;
                addressSection =  document.querySelector(`#addressSection_${elementID}`);
                addressSection.remove();
                addressIndex--;
                if(addressIndex <= 1){
                    document.querySelector("#remove").hidden = true;
                }
            });
        });

        $('#category_id').change(function() {
            var id = $('#category_id').val();
            $.ajax({
                url:"{{ route('admin.get-sub-categories') }}",
                type:"post",
                data:{'_token' : "{{ csrf_token() }}", 'category_id':id},
                success(data) {
                    $('#sub_category_id').empty();
                    if(data.sub_categories.length != 0) {
                        $.each(data.sub_categories, function(key, value) {
                            $('#sub_category_id').append('<option value='+value.id+'>'+value.sub_category+'</option>');
                        }); 
                    } else {
                        $('#sub_category_id').append('<option value=""> No Data </option>');
                    }
                }
            });
        });
        
        function removeDirection(direction) {
            
            $.ajax({
                url:"{{ route('admin.delete-directon') }}",
                type:"post",
                data:{'_token':"{{ csrf_token() }}", 'direction':direction, 'establishment_id':"{{ $establishment->id }}"},
                success(data) {
                    if(data.message == 'successful') {
                        location.reload();
                    } else {
                        alert('Direction Not Deleted');
                    }
                }
            });
        }

    </script>
@endsection