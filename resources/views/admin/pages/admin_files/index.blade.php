@extends('admin.layout.master', ['sidebar_admins' => 1])

@section('page-title')
    CB | Admins
@endsection

@section('page-content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid d-flex justify-content-between">
                <div class="mx-auto">
                    <h1 class="m-0 text-dark text-center text-bold">Admins</h1>
                </div>
                <div>
                    <a href="{{ route('admin.admins.create') }}" class="pull-right btn btn-primary">Create</a>
                </div>
                {{-- <div class="row mb-2">

                    <div class="col-sm-6">
                    </div><!-- /.col -->

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active"></li>
                        </ol>
                    </div><!-- /.col -->
                    
                </div><!-- /.row --> --}}
            </div><!-- /.container-fluid -->
        </div>

        <!-- /.content-header -->

        <!-- Main content -->

        <section class="content">
            <div class="row">
                <div class="col-12">  
                    <div class="card">
                        
                        {{-- <div class="card-header">
                            <h3 class="pull-left card-title"></h3> 
                        </div> --}}

                        <div class="card-body">
                            @if( session()->has('created') )
                                <div class="row">
                                    <strong class="alert alert-success">{{ session('created') }}</strong>
                                </div>
                            @endif


                            @if( session()->has('updated') )
                                <div class="row col-12">
                                    <strong class="alert alert-success">{{ session('updated') }}</strong>
                                </div>
                            @endif

                            @if( session()->has('deleted') )
                                <div class="row col-12">
                                    <strong class="alert alert-danger">{{ session('deleted') }}</strong>
                                </div>
                            @endif

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($admins as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->first_name }}  {{ $data->last_name}}</td>
                                            <td>{{ $data->email }}</td>
                                            <td style="text-align: center;">
                                                <a href="{{ route('admin.admins.edit', $data->id) }}" class="edit_a_tag" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> &nbsp;

                                                {{-- <a href="{{ route('admin.admins.destroy', $data->id) }}" class="tooltips confirm del_a_tag" confirm-text="Are You Sure?" data-placement="top" title="Delete" data-toggle="tooltip"><i class="fa fa-trash-o" aria-hidden="true" style="color: red;"></i></a>  --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div> 
@endsection