@extends('includes.admin.master_admin')
@section('title')
   {{trans('lang.Index')}}
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
                        <h1>{{trans('lang.Language')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans('lang.Home')}}</a></li>
                            <li class="breadcrumb-item active">{{trans('lang.Language')}}</li>
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
                                        @permission('language-create')
                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                                data-target="#modal-create">
                                            {{trans('lang.Create')}}
                                        </button>
                                        @endpermission
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                             <th>{{trans('lang.Title')}}</th>
                                            <th>{{trans('lang.Code')}}</th>
                                            <th>{{trans('lang.Image')}}</th>
                                             @permission('status-status')
                                            <th>{{trans('lang.Status')}}</th>
                                            @endpermission
                                             <th>{{trans('lang.Controller')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody id="body">
                                        @forelse($datas as $data)
                                            <tr id="data-{{$data->id}}">
                                                <td id="title-{{$data->id}}">{{$data->title}}</td>
                                                <td id="code-{{$data->id}}"
                                                    data-order="{{$data->order}}">{{$data->code}}</td>
                                                <td>
                                                    <img
                                                        src="{{ getImag($data->image,'language') }}"
                                                        id="image-{{$data->id}}" style="width:100px;height: 100px">
                                                </td>
                                                @permission('language-status')
                                                <td>
                                                    <input onfocus="changeStatus({{$data->id}})" type="checkbox"
                                                           name="status" @if($data->status) checked
                                                           @endif id="status-{{$data->id}}"
                                                           data-bootstrap-switch data-off-color="danger"
                                                           data-on-color="success">
                                                </td>
                                                @endpermission
                                                <td>
                                                    @permission('language-edit')
                                                    <button type="button"
                                                            class="btn btn-outline-primary btn-block btn-sm"
                                                            onclick="showItem({{$data->id}})">
                                                        <i class="fa fa-edit"></i> {{trans('lang.Edit')}}
                                                    </button>
                                                    <button id="openModael{{$data->id}}" type="button" class="d-none"
                                                            data-toggle="modal"
                                                            data-target="#modal-edit">
                                                    </button>
                                                    @endpermission
                                                    @permission('language-delete')
                                                    <button type="button"
                                                            class="btn btn-outline-danger btn-block btn-sm"
                                                            onclick="selectItem({{$data->id}})" data-toggle="modal"
                                                            data-target="#modal-delete"><i></i> {{trans('lang.Delete')}}
                                                    </button>
                                                    @endpermission
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                             <th>{{trans('lang.Title')}}</th>
                                            <th>{{trans('lang.Code')}}</th>
                                            <th>{{trans('lang.Image')}}</th>
                                             @permission('status-status')
                                            <th>{{trans('lang.Status')}}</th>
                                            @endpermission
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
    @permission('language-create')
    <div class="modal fade" id="modal-create">
        <div class="modal-dialog">
            <div class="modal-content bg-success">
                <div class="modal-header">
                    <h4 class="modal-title">{{trans('lang.Create')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="create" method="post" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="form-group{{ $errors->has('title') ? ' is-invalid' : "" }}">
                                <label for="title">{{trans('lang.Title')}}</label>
                                <input type="text" name="title" class="form-control" id="title"
                                       value="{{Request::old('title')}}" placeholder="{{trans('lang.Enter_Title')}}">
                            </div>
                            <div class="form-group{{ $errors->has('code') ? ' is-invalid' : "" }}">
                                <label for="code">{{trans('lang.Code')}}</label>
                                <input type="text" name="code" class="form-control" id="code"
                                       value="{{Request::old('code')}}" placeholder="{{trans('lang.Enter_Code')}}">
                            </div>
                            <div class="form-group{{ $errors->has('order') ? ' is-invalid' : "" }}">
                                <label for="order">{{trans('lang.Order')}}</label>
                                <input type="text" name="order" class="form-control" id="order"
                                       value="{{Request::old('order')}}" placeholder="{{trans('lang.Enter_Order')}}">
                            </div>
                            <div class="form-group{{ $errors->has('image') ? ' is-invalid' : "" }}">
                                <label>{{trans('lang.Image')}}</label>
                                <input id="file_input" type="file" value="{{Request::old('image')}}" name="image"/>
                                <label for="image">jpg, png, gif</label>
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
    @endpermission
    @permission('language-edit')
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content bg-info">
                <div class="modal-header">
                    <h4 class="modal-title">{{trans('lang.Edit')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="edit" action="" method="post" name="edit" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">
                        <div class="card-body">
                            <div class="form-group{{ $errors->has('title') ? ' is-invalid' : "" }}">
                                <label for="title">{{trans('lang.Title')}}</label>
                                <input type="text" name="title" class="form-control" id="title"
                                       value="" placeholder="{{trans('lang.Enter_Title')}}">
                            </div>
                            <div class="form-group{{ $errors->has('code') ? ' is-invalid' : "" }}">
                                <label for="code">{{trans('lang.Code')}}</label>
                                <input type="text" name="code" class="form-control" id="code"
                                       value="" placeholder="{{trans('lang.Enter_Code')}}">
                            </div>
                            <div class="form-group{{ $errors->has('order') ? ' is-invalid' : "" }}">
                                <label for="order">{{trans('lang.Order')}}</label>
                                <input type="text" name="order" class="form-control" id="order"
                                       value="" placeholder="{{trans('lang.Enter_Order')}}">
                            </div>
                            <div class="form-group{{ $errors->has('image') ? ' has-error' : "" }}">
                                <label>{{trans('lang.Image')}}</label>
                                <input type="file" value="" name="image"/>
                                <label for="image">jpg, png, gif</label>
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
    @endpermission
@endsection
@section('script_style')
    @include('includes.admin.dataTables.script_DataTables')
    @permission('language-edit')
    <script>
        //show item
        function showData(res) {
            $(`#edit #title`).val(res.title);
            $(`#edit #code`).val(res.code);
            $('#edit #order').val(res.order);
        }
        //edit data
        function updateItem(res) {
            document.getElementById('title-' + res.id).innerHTML = res.title;
            document.getElementById('code-' + res.id).innerHTML = res.code;
            $(`#code-${res.id}`).attr('data-order', res.order);
            $(`#image-${res.id}`).attr('src', res.image);
        }
    </script>
    @endpermission
@endsection
