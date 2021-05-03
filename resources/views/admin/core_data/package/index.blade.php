@extends('includes.admin.master_admin')
@section('title')
    Package Index
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
                        <h1>Package</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Package</li>
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
                                            <th>Listing</th>
                                            <th>Type</th>
                                            <th>Count</th>
                                            <th>Status</th>
                                            <th>Controller</th>
                                        </tr>
                                        </thead>
                                        <tbody id="body">
                                        @forelse($datas as $data)
                                            <tr id="data-{{$data->id}}">
                                                <td id="title-{{$data->id}}"
                                                    data-order="{{$data->order}}">{{$data->title->value}}</td>
                                                <td id="count-listing-{{$data->id}}">{{$data->count_listing}}</td>
                                                <td id="type-date-{{$data->id}}">{{$data->type_date}}</td>
                                                <td id="count-date-{{$data->id}}">{{$data->count_date}}</td>
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
                                                            onclick="deleteData({{$data->id}})" data-toggle="modal"
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
                                            <th>Listing</th>
                                            <th>Type</th>
                                            <th>Count</th>
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
                    <h4 class="modal-title">Create New Package</h4>
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
                            <div class="form-group{{ $errors->has('count_listing') ? ' is-invalid' : "" }}">
                                <label for="order">Listing</label>
                                <input type="text" name="count_listing" class="form-control" id="count_listing"
                                       value="{{Request::old('count_listing')}}" placeholder="Enter Listing">
                            </div>
                            <div class="form-group{{ $errors->has('type_date') ? ' is-invalid' : "" }}">
                                <label>Type</label>
                                <select class="form-control" id="type_date" name="type_date"
                                        style="width: 100%;">
                                    <option selected>Select</option>
                                    <option value="d">Day</option>
                                    <option value="m">Manth</option>
                                    <option value="y">Year</option>
                                </select>
                            </div>
                            <div class="form-group{{ $errors->has('count_date') ? ' is-invalid' : "" }}">
                                <label for="order">Count</label>
                                <input type="text" name="count_date" class="form-control" id="count_date"
                                       value="{{Request::old('count_date')}}" placeholder="Enter Count">
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
                    <h4 class="modal-title">Edit Package</h4>
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
                            <div class="form-group{{ $errors->has('count_listing') ? ' is-invalid' : "" }}">
                                <label for="order">Listing</label>
                                <input type="text" name="count_listing" class="form-control" id="count_listing"
                                       value="" placeholder="Enter Listing">
                            </div>
                            <div class="form-group{{ $errors->has('type_date') ? ' is-invalid' : "" }}">
                                <label>Type</label>
                                <select class="form-control" id="type_date" name="type_date"
                                        style="width: 100%;">
                                    <option  value="d">Day</option>
                                    <option  value="m">Manth</option>
                                    <option  value="y">Year</option>
                                </select>
                            </div>
                            <div class="form-group{{ $errors->has('count_date') ? ' is-invalid' : "" }}">
                                <label for="order">Count</label>
                                <input type="text" name="count_date" class="form-control" id="count_date"
                                       value="" placeholder="Enter Count">
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
    <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
            <div class="modal-content bg-warning">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Package</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you Need To Delete This Package</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
                    <button type="submit" id="delete" onclick="DeleteItem()" class="btn btn-outline-dark">Delete
                    </button>
                </div>
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
                                <td id="count-listing-${res.id}">${res.count_listing}</td>
                                <td id="type-date-${res.id}">${res.type_date}</td>
                                <td id="count-date-${res.id}">${res.count_date}</td>
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
            $('#edit #count_listing').val(res.count_listing);
            $('#edit #count_date').val(res.count_date);
            $(`#edit #type_date`).val(res.type_date);
        }
        //edit data
        function UpdateItem(res) {
            document.getElementById('title-' + res.id).innerHTML = res.title;
            document.getElementById('count_listing-' + res.id).innerHTML = res.count_listing;
            document.getElementById('type_date-' + res.id).innerHTML = res.type_date;
            document.getElementById('count_date-' + res.id).innerHTML = res.count_date;
            $(`#title-${res.id}`).attr('data-order', res.order);
        }
    </script>
@endsection
