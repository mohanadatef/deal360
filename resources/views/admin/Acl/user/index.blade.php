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
                        <h1>{{trans('lang.User')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans('lang.Home')}}</a></li>
                            <li class="breadcrumb-item active">{{trans('lang.User')}}</li>
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
                                        <a href="{{  route('user.create') }}"
                                           class="btn btn-success"> {{trans('lang.Create')}}</a>
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>{{trans('lang.Full_Name')}}</th>
                                            <th>{{trans('lang.User_Name')}}</th>
                                            <th>{{trans('lang.Email')}}</th>
                                            <th>{{trans('lang.Role')}}</th>
                                            <th>{{trans('lang.Country')}}</th>
                                            <th>{{trans('lang.Image')}}</th>
                                            <th>{{trans('lang.Status')}}</th>
                                            <th>{{trans('lang.Controller')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody id="body">
                                        @forelse($datas as $data)
                                            <tr id="data-{{$data->id}}">
                                                <td id="full-name-{{$data->id}}"
                                                    data-order="{{$data->order}}">{{$data->fullname}}</td>
                                                <td id="user-name-{{$data->id}}">{{$data->username}}</td>
                                                <td id="email-{{$data->id}}">{{$data->email}}</td>
                                                <td id="role-{{$data->id}}">{{$data->role->title ? $data->role->title->value : ""}}</td>
                                                <td id="country-{{$data->id}}">{{$data->country->title ? $data->country->title->value : ""}}</td>
                                                <td id="image-{{$data->id}}"><img src="{{ getImag($data->image,'user') }}"
                                                                                  id="image-{{$data->id}}" style="width:100px;height: 100px"></td>
                                                <td>
                                                    <input onfocus="changeStatus({{$data->id}})" type="checkbox"
                                                           name="status" @if($data->status) checked
                                                           @endif id="status-{{$data->id}}"
                                                           data-bootstrap-switch data-off-color="danger"
                                                           data-on-color="success">
                                                </td>
                                                <td>
                                                    <a href="{{  route('user.edit',$data->id) }}"
                                                       class="btn btn-outline-primary btn-block btn-sm"><i class="fa fa-edit"></i>{{trans('lang.Edit')}}</a>
                                                    <button type="button"
                                                            class="btn btn-outline-danger btn-block btn-sm"
                                                            onclick="selectItem({{$data->id}})" data-toggle="modal"
                                                            data-target="#modal-delete"><i></i> {{trans('lang.Delete')}}
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>{{trans('lang.Full_Name')}}</th>
                                            <th>{{trans('lang.User_Name')}}</th>
                                            <th>{{trans('lang.Email')}}</th>
                                            <th>{{trans('lang.Role')}}</th>
                                            <th>{{trans('lang.Country')}}</th>
                                            <th>{{trans('lang.Image')}}</th>
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
@endsection
@section('script_style')
    @include('includes.admin.dataTables.script_DataTables')
@endsection
