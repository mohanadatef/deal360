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
                        <h1>{{trans('lang.Permission')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans('lang.Home')}}</a></li>
                            <li class="breadcrumb-item active">{{trans('lang.Permission')}}</li>
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
                                        @permission('permission-create')
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
                                            <th>{{trans('lang.Name')}}</th>
                                             <th>{{trans('lang.Controller')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody id="body">
                                        @forelse($datas as $data)
                                            <tr id="data-{{$data->id}}">
                                                <td id="title-{{$data->id}}"
                                                    data-order="{{$data->order}}">{{$data->title ? $data->title->value : ""}}</td>
                                                <td id="name-{{$data->id}}">{{$data->name}}</td>
                                                <td>
                                                    @permission('permission-edit')
                                                    <button type="button"
                                                            class="btn btn-outline-primary btn-block btn-sm"
                                                            onclick="showItem({{$data->id}})">
                                                        <i class="fa fa-edit"></i> {{trans('lang.Edit')}}
                                                    </button>
                                                    <button id="openModael{{$data->id}}" type="button" class="d-none"
                                                            data-toggle="modal"
                                                            data-target="#modal-edit">
                                                    </button>
                                                    @endpremission
                                                    @permission('permission-delete')
                                                    <button type="button"
                                                            class="btn btn-outline-danger btn-block btn-sm"
                                                            onclick="selectItem({{$data->id}})" data-toggle="modal"
                                                            data-target="#modal-delete"><i></i> {{trans('lang.Delete')}}
                                                    </button>
                                                    @endpremission
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                             <th>{{trans('lang.Title')}}</th>
                                            <th>{{trans('lang.Name')}}</th>
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
    @permission('permission-create')
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
                            <div class="form-group{{ $errors->has('name') ? ' is-invalid' : "" }}">
                                <label for="name">{{trans('lang.Name')}}</label>
                                <input type="text" name="name" class="form-control" id="name"
                                       value="{{Request::old('name')}}" placeholder="{{trans('lang.Enter_Name')}}">
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
    @permission('permission-edit')
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
                            @foreach($language as $lang)
                                <div
                                    class="form-group{{ $errors->has('title['.$lang->code.']') ? ' is-invalid' : "" }}">
                                    <label for="title">{{trans('lang.Title')}} {{$lang->title}}</label>
                                    <input type="text" name="title[{{$lang->code}}]" class="form-control"
                                           id="title-{{$lang->code}}"
                                           value="" placeholder="{{trans('lang.Enter_Title')}} {{$lang->title}}">
                                </div>
                            @endforeach
                            <div class="form-group{{ $errors->has('name') ? ' is-invalid' : "" }}">
                                <label for="name">{{trans('lang.Name')}}</label>
                                <input type="text" name="name" class="form-control" id="name"
                                       value="" placeholder="{{trans('lang.Enter_Name')}}">
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
    @permission('permission-edit')
    <script>
        //show item
        function showData(res) {
            for (let i in res.translation) {
                $(`#edit #title-${res.translation[i].language.code}`).val(res.translation[i].value);
            }
            $('#edit #name').val(res.name);
        }
        //edit data
        function updateItem(res) {
            document.getElementById('title-' + res.id).innerHTML = res.title;
            document.getElementById('name-' + res.id).innerHTML = res.name;
        }
        </script>
    @endpermission
@endsection
