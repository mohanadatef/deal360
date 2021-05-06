@extends('includes.admin.master_admin')
@section('title')
    {{trans('lang.Package')}} {{trans('lang.Index')}}
@endsection
@section('head_style')
    @include('includes.admin.dataTables.head_DataTables')
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{trans('lang.Package')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans('lang.Home')}}</a></li>
                            <li class="breadcrumb-item active">{{trans('lang.Package')}}</li>
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
                                            {{trans('lang.Create')}}
                                        </button>
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                             <th>{{trans('lang.Title')}}</th>
                                            <th>{{trans('lang.Listing')}}</th>
                                            <th>{{trans('lang.Type')}}</th>
                                            <th>{{trans('lang.Count')}}</th>
                                             <th>{{trans('lang.Status')}}</th>
                                             <th>{{trans('lang.Controller')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody id="body">
                                        @forelse($datas as $data)
                                            <tr id="data-{{$data->id}}">
                                                <td id="title-{{$data->id}}"
                                                    data-order="{{$data->order}}">{{$data->title ? $data->title->value : ""}}</td>
                                                <td id="count-listing-{{$data->id}}">{{$data->count_listing}}</td>
                                                <td id="type-date-{{$data->id}}">{{trans('lang.'.$data->type_date)}}</td>
                                                <td id="count-date-{{$data->id}}">{{$data->count_date}}</td>
                                                <td>
                                                    <input onfocus="changeStatus({{$data->id}})" type="checkbox"
                                                           name="status" @if($data->status) checked
                                                           @endif id="status-{{$data->id}}"
                                                           data-bootstrap-switch data-off-color="danger"
                                                           data-on-color="success">
                                                </td>
                                                <td>
                                                    <button type="button"
                                                            class="btn btn-outline-primary btn-block btn-sm"
                                                            onclick="showItem({{$data->id}})">
                                                        <i class="fa fa-edit"></i> {{trans('lang.Edit')}}
                                                    </button>
                                                    <button id="openModael{{$data->id}}" type="button" class="d-none"
                                                            data-toggle="modal"
                                                            data-target="#modal-edit">
                                                    </button>
                                                    <button type="button"
                                                            class="btn btn-outline-danger btn-block btn-sm"
                                                            onclick="deleteData({{$data->id}})" data-toggle="modal"
                                                            data-target="#modal-delete"><i></i> {{trans('lang.Delete')}}
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                             <th>{{trans('lang.Title')}}</th>
                                            <th>{{trans('lang.Listing')}}</th>
                                            <th>{{trans('lang.Type')}}</th>
                                            <th>{{trans('lang.Count')}}</th>
                                             <th>{{trans('lang.Status')}}</th>
                                             <th>{{trans('lang.Controller')}}</th>
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
                    <h4 class="modal-title">{{trans('lang.Create')}} {{trans('lang.Package')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="create" method="post" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="card-body">
                            @foreach($language as $lang)
                                <div
                                    class="form-group{{ $errors->has('title['.$lang->code.']') ? ' is-invalid' : "" }}">
                                    <label for="title">{{trans('lang.Title')}} {{$lang->title}}</label>
                                    <input type="text" name="title[{{$lang->code}}]" class="form-control"
                                           id="title[{{$lang->code}}]"
                                           value="{{Request::old('title['.$lang->code.']')}}"
                                           placeholder="{{trans('lang.Enter_Title')}} {{$lang->title}}">
                                </div>
                            @endforeach
                            <div class="form-group{{ $errors->has('order') ? ' is-invalid' : "" }}">
                                <label for="order">{{trans('lang.Order')}}</label>
                                <input type="text" name="order" class="form-control" id="order"
                                       value="{{Request::old('order')}}" placeholder="{{trans('lang.Enter_Order')}}">
                            </div>
                            <div class="form-group{{ $errors->has('count_listing') ? ' is-invalid' : "" }}">
                                <label for="order">{{trans('lang.Listing')}}</label>
                                <input type="text" name="count_listing" class="form-control" id="count_listing"
                                       value="{{Request::old('count_listing')}}" placeholder="{{trans('lang.Enter_Listing')}}">
                            </div>
                            <div class="form-group{{ $errors->has('type_date') ? ' is-invalid' : "" }}">
                                <label>{{trans('lang.Type')}}</label>
                                <select class="form-control" id="type_date" name="type_date"
                                        style="width: 100%;">
                                    <option selected>{{trans('lang.Select')}}</option>
                                    <option value="d">{{trans('lang.Day')}}</option>
                                    <option value="m">{{trans('lang.Month')}}</option>
                                    <option value="y">{{trans('lang.Year')}}</option>
                                </select>
                            </div>
                            <div class="form-group{{ $errors->has('count_date') ? ' is-invalid' : "" }}">
                                <label for="order">{{trans('lang.Count')}}</label>
                                <input type="text" name="count_date" class="form-control" id="count_date"
                                       value="{{Request::old('count_date')}}" placeholder="{{trans('lang.Enter_Count')}}">
                            </div>
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">{{trans('lang.Close')}}</button>
                        <button type="submit" class="btn btn-outline-light">{{trans('lang.Create')}}</button>
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
                    <h4 class="modal-title">{{trans('lang.Edit')}} {{trans('lang.Package')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="edit" action="" method="post" name="edit" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="card-body">
                            @foreach($language as $lang)
                                <div
                                    class="form-group{{ $errors->has('title['.$lang->code.']') ? ' is-invalid' : "" }}">
                                    <label for="title">{{trans('lang.Title')}} {{$lang->title}}</label>
                                    <input type="text" name="title[{{$lang->code}}]" class="form-control"
                                           id="title-{{$lang->code}}"
                                           value="" placeholder="{{trans('lang.Enter_Title')}} {{$lang->title}}">
                                </div>
                            @endforeach
                            <div class="form-group{{ $errors->has('order') ? ' is-invalid' : "" }}">
                                <label for="order">{{trans('lang.Order')}}</label>
                                <input type="text" name="order" class="form-control" id="order"
                                       value="" placeholder="{{trans('lang.Enter_Order')}}">
                            </div>
                            <div class="form-group{{ $errors->has('count_listing') ? ' is-invalid' : "" }}">
                                <label for="order">{{trans('lang.Listing')}}</label>
                                <input type="text" name="count_listing" class="form-control" id="count_listing"
                                       value="" placeholder="{{trans('lang.Enter_Listing')}}">
                            </div>
                            <div class="form-group{{ $errors->has('type_date') ? ' is-invalid' : "" }}">
                                <label>{{trans('lang.Type')}}</label>
                                <select class="form-control" id="type_date" name="type_date"
                                        style="width: 100%;">
                                    <option  value="d">{{trans('lang.Day')}}</option>
                                    <option  value="m">{{trans('lang.Month')}}</option>
                                    <option  value="y">{{trans('lang.Year')}}</option>
                                </select>
                            </div>
                            <div class="form-group{{ $errors->has('count_date') ? ' is-invalid' : "" }}">
                                <label for="order">{{trans('lang.Count')}}</label>
                                <input type="text" name="count_date" class="form-control" id="count_date"
                                       value="" placeholder="{{trans('lang.Enter_Count')}}">
                            </div>
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">{{trans('lang.Close')}}</button>
                        <button type="submit" class="btn btn-outline-light">{{trans('lang.Update')}}</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('script_style')
    @include('includes.admin.dataTables.script_DataTables')
    <script>
        //show item
        function showData(res) {
            for (let i in res.translation) {
                $(`#edit #title-${res.translation[i].language.code}`).val(res.translation[i].value);
            }
            $('#edit #order').val(res.order);
            $('#edit #count_listing').val(res.count_listing);
            $('#edit #count_date').val(res.count_date);
            $(`#edit #type_date`).val(res.type_date);
        }
        //edit data
        function updateItem(res) {
            document.getElementById('title-' + res.id).innerHTML = res.title;
            document.getElementById('count_listing-' + res.id).innerHTML = res.count_listing;
            document.getElementById('type_date-' + res.id).innerHTML = res.type_date;
            document.getElementById('count_date-' + res.id).innerHTML = res.count_date;
            $(`#title-${res.id}`).attr('data-order', res.order);
        }
    </script>
@endsection
