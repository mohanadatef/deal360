@extends('includes.admin.master_admin')
@section('title')
   {{trans('lang.Create')}}
@endsection
@section('head_style')
    @include('includes.admin.dataTables.head_DataTables')
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="{{asset('public/AdminLTE/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Role</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans('lang.Home')}}</a></li>
                            <li class="breadcrumb-item active">{{trans('lang.Role')}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <div class="card-header">
                                Create
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            @include('errors.error')
                            <form action="{{route('role.store')}}" method="post" id="create">
                                @csrf
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
                                        <div class="form-group{{ $errors->has('code') ? ' is-invalid' : "" }}">
                                            <label for="code">{{trans('lang.Code')}}</label>
                                            <input type="text" name="code" class="form-control" id="code"
                                                   value="{{Request::old('code')}}" placeholder="{{trans('lang.Enter_Code')}}">
                                        </div>
                                        <div class="form-group{{ $errors->has('type_access') ? ' is-invalid' : "" }}">
                                            <label>{{trans('lang.Type')}}</label>
                                            <select class="form-control" id="type_access" name="type_access"
                                                    style="width: 100%;">
                                                <option selected>{{trans('lang.Select')}}</option>
                                                <option value="d">{{trans('lang.All')}}</option>
                                                <option value="m">{{trans('lang.Deal360')}}</option>
                                                <option value="y">{{trans('lang.Crm')}}</option>
                                            </select>
                                        </div>
                                        <div class="form-group{{ $errors->has('permission') ? ' has-error' : "" }}">
                                            <label>Permission</label>
                                            <select class="duallistbox" multiple="multiple" name="permission[]">
                                                @foreach($permission as $pe)
                                                <option  value="{{$pe->id}}">{{$pe->title->value}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    <!-- /.col -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">

                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script_style')
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{asset('public/AdminLTE/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
    <script>
        //Bootstrap Duallistbox
        $('.duallistbox').bootstrapDualListbox();
    </script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\Acl\Role\CreateRequest','#create') !!}
@endsection
