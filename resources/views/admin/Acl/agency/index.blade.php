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
                        <h1>{{trans('lang.Agency')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.dashboard')}}">{{trans('lang.Home')}}</a></li>
                            <li class="breadcrumb-item active">{{trans('lang.Agency')}}</li>
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
                                        @permission('agency-create')
                                        <a href="{{  route('agency.create') }}"
                                           class="btn btn-success"> {{trans('lang.Create')}}</a>
                                        @endpermission
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
                                            <th>{{trans('lang.Country')}}</th>
                                            <th>{{trans('lang.Image')}}</th>
                                            @permission('agency-status')
                                            <th>{{trans('lang.Status')}}</th>
                                            @endpermission
                                            <th>{{trans('lang.Controller')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody id="body">
                                        @forelse($datas as $data)
                                            <tr id="data-{{$data->id}}">
                                                <td id="full-name-{{$data->id}}">{{$data->user->fullname}}</td>
                                                <td id="user-name-{{$data->id}}">{{$data->user->username}}</td>
                                                <td id="email-{{$data->id}}">{{$data->user->email}}</td>
                                                <td id="country-{{$data->id}}">{{$data->user->country->title ? $data->user->country->title->value : ""}}</td>
                                                <td id="image-{{$data->id}}"><img src="{{ getImag($data->user->image,'user') }}"
                                                                                  id="image-{{$data->id}}" style="width:100px;height: 100px"></td>
                                                @permission('agency-status')
                                                <td>
                                                    <input onfocus="changeStatus({{$data->user_id}})" type="checkbox"
                                                           name="status" @if($data->user->status) checked
                                                           @endif id="status-{{$data->id}}"
                                                           data-bootstrap-switch data-off-color="danger"
                                                           data-on-color="success">
                                                </td>
                                                @endpermission
                                                <td>
                                                    @permission('agency-edit')
                                                    <a href="{{  route('agency.edit',$data->id) }}"
                                                       class="btn btn-outline-primary btn-block btn-sm"><i class="fa fa-edit"></i>{{trans('lang.Edit')}}</a>
                                                    @endpermission
                                                    @permission('agency-forgot-password')
                                                    <button type="button"
                                                            class="btn btn-outline-danger btn-block btn-sm"
                                                            onclick="selectItem({{$data->id}})" data-toggle="modal"
                                                            data-target="#modal-forgotpassword"><i></i> {{trans('lang.Change_Password')}}
                                                    </button>
                                                    @endpermission
                                                    @permission('agency-delete')
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
                                            <th>{{trans('lang.Full_Name')}}</th>
                                            <th>{{trans('lang.User_Name')}}</th>
                                            <th>{{trans('lang.Email')}}</th>
                                            <th>{{trans('lang.Country')}}</th>
                                            <th>{{trans('lang.Image')}}</th>
                                            @permission('agency-status')
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
    @permission('agency-forgot-password')
    <div class="modal fade" id="modal-forgotpassword">
        <div class="modal-dialog">
            <div class="modal-content bg-success">
                <div class="modal-header">
                    <h4 class="modal-title">{{trans('lang.Change_Password')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="forgotpassword" method="post" action="">
                    @csrf
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="form-group{{ $errors->has('password') ? ' is-invalid' : "" }}">
                                <label for="password">{{trans('lang.Password')}}</label>
                                <input type="password" name="password" class="form-control" id="password"
                                       value="{{Request::old('password')}}"
                                       placeholder="{{trans('lang.Enter_Password')}}">
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' is-invalid' : "" }}">
                                <label for="password">{{trans('lang.Password_Confirmation')}}</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                       id="password_confirmation"
                                       value="{{Request::old('password_confirmation')}}"
                                       placeholder="{{trans('lang.Enter_Password_Confirmation')}}">
                            </div>
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light"
                                data-dismiss="modal">{{trans('lang.Close')}}</button>
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
@endsection
