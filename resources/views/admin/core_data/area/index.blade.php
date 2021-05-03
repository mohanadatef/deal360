@extends('includes.admin.master_admin')
@section('title')
    Area Index
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
                        <h1>Area</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Area</li>
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
                                            <th>Country</th>
                                            <th>City</th>
                                            <th>Status</th>
                                            <th>Controller</th>
                                        </tr>
                                        </thead>
                                        <tbody id="body">
                                        @forelse($datas as $data)
                                            <tr id="data-{{$data->id}}">
                                                <td id="title-{{$data->id}}"
                                                    data-order="{{$data->order}}">{{$data->title->value}}</td>
                                                <td id="country-{{$data->id}}">{{$data->country->title->value}}</td>
                                                <td id="city-{{$data->id}}">{{$data->city->title->value}}</td>
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
                                            <th>Country</th>
                                            <th>City</th>
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
                    <h4 class="modal-title">Create New Area</h4>
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
                            <div class="form-group{{ $errors->has('country_id') ? ' is-invalid' : "" }}">
                                <label>Country</label>
                                <select class="form-control" id="country" name="country_id"
                                        style="width: 100%;">
                                    @foreach($country as $my)
                                        <option value="{{$my->id}}"
                                                id="option-country-{{$my->id}}">{{$my->title->value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group{{ $errors->has('city_id') ? ' is-invalid' : "" }}">
                                <label>Select</label>
                                <select class="form-control" id="city_id" name="city_id"
                                        style="width: 100%;">
                                    <option value="" selected>Select</option>
                                </select>
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
                    <h4 class="modal-title">Edit Area</h4>
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
                            <div class="form-group{{ $errors->has('country_id') ? ' is-invalid' : "" }}">
                                <label>Country</label>
                                <select class="form-control" id="country-id" name="country_id"
                                        style="width: 100%;">
                                    @foreach($country as $my)
                                        <option value="{{$my->id}}"
                                                id="option-country-{{$my->id}}">{{$my->title->value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group{{ $errors->has('city_id') ? ' is-invalid' : "" }}">
                                <label>Select</label>
                                <select class="form-control" id="city_id" name="city_id"
                                        style="width: 100%;">
                                </select>
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
                    <h4 class="modal-title">Delete</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you Need To Delete This , Area</p>
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
                            <td id="country-${res.id}">${res.country.title}</td><td id="city-${res.id}">${res.city.title}</td>
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
            $('#edit #country').val(res.country.title);
            var city = res.city_id;
            var country = res.country_id;
            GetCity(country,city);
            $("#edit #country-id").val(country);
        }
        //edit data
        function UpdateItem(res) {
            document.getElementById('title-' + res.id).innerHTML = res.title;
            document.getElementById('country-' + res.id).innerHTML = res.country.title;
            document.getElementById('city-' + res.id).innerHTML = res.city.title;
            $(`#title-${res.id}`).attr('data-order', res.order);
        }
        //city list for country
        $('#create #country').change(function () {
            url = '{{ route("city.list", ":country") }}';
            url = url.replace(':country', $(this).val());
            $.ajax({
                type: "GET",
                url: url,
                success: function (res) {
                    $("#create #city_id").empty();
                    $("#create #city_id").append('<option>select</option>');
                    for (let x in res) {
                        for (let i in res[x]) {
                            $("#create #city_id").append(`<option value="${res[x][i].id}">${res[x][i].title}</option>`);
                        }
                    }
                }, error: function (res) {
                    for (let err in res.responseJSON.errors) {
                        toastr.error(res.responseJSON.errors[err]);
                    }
                }
            });
        });
        //city list for country
        $('#edit #country-id').change(function () {
            GetCity($(this).val(),0);
        });
        function GetCity(country,city) {
            url = '{{ route("city.list", ":country") }}';
            url = url.replace(':country', country);
            $.ajax({
                type: "GET",
                url: url,
                success: function (res) {
                    $("#edit #city_id").empty();
                    $("#edit #city_id").append('<option value="0"   >select</option>');
                    for (let x in res) {
                        for (let i in res[x]) {
                            $("#edit #city_id").append(`<option value="${res[x][i].id}">${res[x][i].title}</option>`);
                        }
                    }
                    $("#edit #city_id").val(city);
                }, error: function (res) {
                    for (let err in res.responseJSON.errors) {
                        toastr.error(res.responseJSON.errors[err]);
                    }
                }
            });
        }
    </script>
@endsection
