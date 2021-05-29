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
                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.dashboard')}}">{{trans('lang.Home')}}</a></li>
                            <li class="breadcrumb-item active">{{trans('lang.User')}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="card card-solid">
                <div class="card-body pb-0">
                    <div class="row d-flex align-items-stretch">
                        @forelse($datas as $data)
                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                                <div class="card bg-light">
                                    <div class="card-header text-muted border-bottom-0">
                                        {{$data->fullname}}
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="lead"><b>{{$data->username}}</b></h2>
                                                <p class="text-muted text-sm"><b>{{trans('lang.Role')}}
                                                        :</b> {{$data->role->title ? $data->role->title->value : ""}}
                                                </p>
                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                    <li class="small"><span class="fa-li"><i
                                                                class="fas fa-lg fa-address-book"></i></span> {{$data->email}}
                                                    </li>
                                                    <li class="small"><span class="fa-li"><i
                                                                class="fas fa-lg fa-phone"></i></span> {{$data->phone}}
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-5 text-center">
                                                <img src="{{ getImag($data->image,'user') }}" alt="user-avatar"
                                                     class="img-circle img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-right">
                                            @permission('user-status')
                                            <input onfocus="changeStatus({{$data->id}})" type="checkbox"
                                                   name="status" @if($data->status) checked
                                                   @endif id="status-{{$data->id}}"
                                                   data-bootstrap-switch data-off-color="danger"
                                                   data-on-color="success">
                                            @endpermission
                                            @permission('user-edit')
                                            <a href="{{  route('user.edit',$data->id) }}"
                                               class="btn btn-sm btn-primary">
                                                <i class="fas fa-user"></i> {{trans('lang.Edit')}}
                                            </a>
                                            @endpermission
                                            @permission('user-forgot-password')
                                            <button type="button"
                                                    class="btn btn-sm bg-danger"
                                                    onclick="selectItem({{$data->id}})" data-toggle="modal"
                                                    data-target="#modal-forgotpassword">
                                                <i></i> {{trans('lang.Change_Password')}}
                                            </button>
                                            @endpermission
                                            @permission('user-delete')
                                            <button class="btn btn-sm bg-danger" type="button"
                                                    onclick="selectItem({{$data->id}})" data-toggle="modal"
                                                    data-target="#modal-delete">
                                                <i class="fas fa-recycle"></i> {{trans('lang.Delete')}}
                                            </button>
                                            @endpermission
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
                <!-- /.card-body -->
                @if($paginator['total_pages'] > 1)
                <div class="card-footer">
                    <nav aria-label="Contacts Page Navigation">
                        <ul class="pagination justify-content-center m-0">
                            @for($i=1;$i<=$paginator['total_pages'];$i++)
                                @if ($i == 1)
                                    <li><a class="page-link"
                                           @if ($paginator['current_page'] == 1) style="pointer-events: none"
                                           @endif href="{{$paginator['url_page'].($paginator['current_page']-1)}}">Preive</a>
                                    </li>
                                @endif
                                <li @if($paginator['current_page'] == $i) class="page-item active"
                                    @else class="page-item" @endif><a class="page-link"
                                                                      href="{{$paginator['url_page'].$i}}">{{$i}}</a>
                                </li>
                                @if ($i == $paginator['total_pages'])
                                    <li><a class="page-link"
                                           @if ($paginator['current_page'] == $paginator['total_pages']) style="pointer-events: none"
                                           @endif href="{{$paginator['url_page'].($paginator['current_page']+1)}}">Next</a>
                                    </li>
                                @endif
                            @endfor
                        </ul>
                    </nav>
                </div>
                @endif
                <!-- /.card-footer -->
            </div>
        </section>
        <!-- /.content -->
    </div>
    @permission('user-forgot-password')
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
