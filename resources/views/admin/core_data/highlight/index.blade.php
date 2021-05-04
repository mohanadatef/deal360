@extends('includes.admin.master_admin')
@section('title')
    High Light Index
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
                        <h1>High Light</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">High Light</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <form method="get" action="">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                                data-target="#modal-create">
                                            Create
                                        </button>
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Controller</th>
                                        </tr>
                                        </thead>
                                        <tbody id="body">
                                        @forelse($datas as $data)
                                            <tr id="data-{{$data->id}}">
                                                <td id="title-{{$data->id}}"
                                                    data-order="{{$data->order}}">{{$data->title ? $data->title->value : ""}}</td>
                                                <td>
                                                    <input onfocus="Change_Status({{$data->id}})" type="checkbox"
                                                           name="status" @if($data->status) checked
                                                           @endif id="status-{{$data->id}}"
                                                           data-bootstrap-switch data-off-color="danger"
                                                           data-on-color="success">
                                                </td>
                                                <td>
                                                    <button type="button"
                                                            class="btn btn-outline-primary btn-block btn-sm"
                                                            onclick="ShowItem({{$data->id}})">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </button>
                                                    <button id="openModael{{$data->id}}" type="button" class="d-none"
                                                            data-toggle="modal"
                                                            data-target="#modal-edit">
                                                    </button>
                                                    <button type="button"
                                                            class="btn btn-outline-danger btn-block btn-sm"
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
                                            <th>Status</th>
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
            </form>
        </section>
        <!-- /.content -->
    </div>
    <div class="modal fade" id="modal-create">
        <div class="modal-dialog">
            <div class="modal-content bg-success">
                <div class="modal-header">
                    <h4 class="modal-title">Create New High Light</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="create" method="post" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="card-body">
                            @foreach(language() as $lang)
                                <div
                                    class="form-group{{ $errors->has('title['.$lang->code.']') ? ' is-invalid' : "" }}">
                                    <label for="title">Title {{$lang->code}}</label>
                                    <input type="text" name="title[{{$lang->code}}]" class="form-control"
                                           id="title[{{$lang->code}}]"
                                           value="{{Request::old('title['.$lang->code.']')}}"
                                           placeholder="Enter title {{$lang->code}}">
                                </div>
                            @endforeach
                            <div class="form-group{{ $errors->has('order') ? ' is-invalid' : "" }}">
                                <label for="order">Order</label>
                                <input type="text" name="order" class="form-control" id="order"
                                       value="{{Request::old('order')}}" placeholder="Enter Order">
                            </div>
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-light">Create</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content bg-info">
                <div class="modal-header">
                    <h4 class="modal-title">Edit High Light</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="edit" action="" method="post" name="edit" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="card-body">
                            @foreach(language() as $lang)
                                <div
                                    class="form-group{{ $errors->has('title['.$lang->code.']') ? ' is-invalid' : "" }}">
                                    <label for="title">Title {{$lang->code}}</label>
                                    <input type="text" name="title[{{$lang->code}}]" class="form-control"
                                           id="title-{{$lang->code}}"
                                           value="" placeholder="Enter title {{$lang->code}}">
                                </div>
                            @endforeach
                            <div class="form-group{{ $errors->has('order') ? ' is-invalid' : "" }}">
                                <label for="order">Order</label>
                                <input type="text" name="order" class="form-control" id="order"
                                       value="" placeholder="Enter Order">
                            </div>
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-light">Update</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('script_style')
    @include('includes.admin.script_DataTables')
    <script>
        //crate data
        function CreateItem(res) {
            $('#body').append(`<tr id="${res.id}"><td id="title-${res.id}" data-order="${res.order}">${res.title}</td>
                            <td><input onfocus="Change_Status(${res.id})" type="checkbox" name="status" id="status-${res.id}"
                                checked data-bootstrap-switch data-off-color="danger" data-on-color="success"></td>
                                <td><button type="button" class="btn btn-outline-primary btn-block btn-sm"
                                onclick="ShowItem(${res.id})"><i class="fa fa-edit"></i> Edit</button>
                                <button id="openModael${res.id}" type="button" class="d-none" data-toggle="modal"
                                data-target="#modal-edit"></button>
                                <button type="button" class="btn btn-outline-danger btn-block btn-sm"
                                onclick="SelectItem(${res.id})" data-toggle="modal"
                                data-target="#modal-delete"><i></i> Delete</button></td></tr>`);
        }
        //show item
        function ShowData(res) {
            for (let i in res.translation) {
                $(`#edit #title-${res.translation[i].language.code}`).val(res.translation[i].value);
            }
            $('#edit #order').val(res.order);
        }
        //edit data
        function UpdateItem(res) {
            document.getElementById('title-' + res.id).innerHTML = res.title;
            $(`#title-${res.id}`).attr('data-order', res.order);
        }
    </script>
@endsection
