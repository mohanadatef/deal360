@extends('includes.admin.master_admin')
@section('title')
    {{trans('lang.Create')}}
@endsection
@section('head_style')
    @include('includes.admin.dataTables.head_DataTables')
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet"
          href="{{asset('public/AdminLTE/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
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
                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.dashboard')}}">{{trans('lang.Home')}}</a></li>
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
                                {{trans('lang.Update')}}
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            @include('errors.error')
                            <form action="{{route('role.update',$data->id)}}" method="post" id="edit">
                                @csrf
                                <div class="card-body">
                                    @foreach($language as $lang)
                                        <div
                                            class="form-group{{ $errors->has('title['.$lang->code.']') ? ' is-invalid' : "" }}">
                                            <label for="title">{{trans('lang.Title')}} {{$lang->title}}</label>
                                            <input type="text" name="title[{{$lang->code}}]" class="form-control"
                                                   id="title[{{$lang->code}}]"
                                                   @php($title=$data->translation->where('language_id', $lang->id)->first())
                                                   @if($title)
                                                   value="{{$title->value}}"
                                                   @endif
                                                   placeholder="{{trans('lang.Enter_Title')}} {{$lang->title}}">
                                        </div>
                                    @endforeach
                                    <div class="form-group{{ $errors->has('order') ? ' is-invalid' : "" }}">
                                        <label for="order">{{trans('lang.Order')}}</label>
                                        <input type="text" name="order" class="form-control" id="order"
                                               value="{{$data->order}}" placeholder="{{trans('lang.Enter_Order')}}">
                                    </div>
                                    <div class="form-group{{ $errors->has('code') ? ' is-invalid' : "" }}">
                                        <label for="code">{{trans('lang.Code')}}</label>
                                        <input type="text" name="code" class="form-control" id="code"
                                               value="{{$data->code}}" placeholder="{{trans('lang.Enter_Code')}}">
                                    </div>
                                    <div class="form-group{{ $errors->has('type_access') ? ' is-invalid' : "" }}">
                                        <label>{{trans('lang.Type')}}</label>
                                        <select class="form-control" id="type_access" name="type_access"
                                                style="width: 100%;">
                                            <option >{{trans('lang.Select')}}</option>
                                            <option @if($data->type_access == 'all')  selected @endif value="all">{{trans('lang.all')}}</option>
                                            <option @if($data->type_access == 'deal360')  selected @endif value="deal360">{{trans('lang.deal360')}}</option>
                                            <option @if($data->type_access == 'crm')  selected @endif value="crm">{{trans('lang.crm')}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group{{ $errors->has('permission') ? ' has-error' : "" }}">
                                        <label>{{trans('lang.Permission')}}</label>
                                        <select class="duallistbox" multiple="multiple" name="permission[]">
                                            @foreach($permission as $key => $pe)
                                                <option @foreach($data->role_permission as  $rp) @if($rp->id ==$pe->id) selected   @endif @endforeach value="{{$pe->id}}">{{$pe->title->value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                    <!-- /.col -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">{{trans('lang.Update')}}</button>
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
    <script
        src="{{asset('public/AdminLTE/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
    <script>
        //Bootstrap Duallistbox
        $('.duallistbox').bootstrapDualListbox();
    </script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\Acl\Role\EditRequest','#edit') !!}
@endsection
