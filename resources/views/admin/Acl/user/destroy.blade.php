@extends('includes.admin.master_admin')
@section('title')
   {{trans('lang.Delete' )}}{{trans('lang.Index')}}
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
                                            @permission('user-restore')
                                            <button type="button" class="btn btn-outline-primary btn-block btn-sm"
                                                    onclick="selectItem({{$data->id}})" data-toggle="modal"
                                                    data-target="#modal-restore">
                                                <i class="fa fa-edit"></i> {{trans('lang.Restore')}}
                                            </button>
                                            @endpermission
                                            @permission('user-remove')
                                            <button type="button" class="btn btn-outline-danger btn-block btn-sm"
                                                    onclick="selectItem({{$data->id}})" data-toggle="modal"
                                                    data-target="#modal-remove"><i></i>{{trans('lang.Delete')}}
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
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script_style')
    @include('includes.admin.dataTables.script_DataTables')
@endsection
