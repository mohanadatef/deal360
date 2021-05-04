@extends('includes.admin.master_admin')
@section('title')
    Language Delete Index
@endsection
@section('head_style')
    @include('includes.admin.head_DataTables')
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Language</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Language</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Language you Deleted At Before
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Code</th>
                                        <th>Image</th>
                                        <th>Controller</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($datas as $data)
                                        <tr id="data-{{$data->id}}">
                                            <td id="title-{{$data->id}}">{{$data->title}}</td>
                                            <td id="code-{{$data->id}}">{{$data->code}}</td>
                                            <td>
                                                <img src="{{ image_get($data->image,'language')}}" style="width:100px;height: 100px">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-outline-primary btn-block btn-sm"
                                                        onclick="SelectItem({{$data->id}})" data-toggle="modal"
                                                        data-target="#modal-restore">
                                                    <i class="fa fa-edit"></i> Restore
                                                </button>
                                                <button type="button" class="btn btn-outline-danger btn-block btn-sm"
                                                        onclick="SelectItem({{$data->id}})" data-toggle="modal"
                                                        data-target="#modal-delete"><i></i> Delete
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Title</th>
                                        <th>Code</th>
                                        <th>Image</th>
                                        <th>Controller</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script_style')
    @include('includes.admin.script_DataTables')
@endsection
