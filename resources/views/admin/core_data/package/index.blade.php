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
                                        @permission('package-create')
                                        <a href="{{  route('package.create') }}"
                                           class="btn btn-success"> {{trans('lang.Create')}}</a>
                                        @endpermission
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
                                             @permission('package-status')
                                            <th>{{trans('lang.Status')}}</th>
                                            @endpermission
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
                                                @permission('package-status')
                                                <td>
                                                    <input onfocus="changeStatus({{$data->id}})" type="checkbox"
                                                           name="status" @if($data->status) checked
                                                           @endif id="status-{{$data->id}}"
                                                           data-bootstrap-switch data-off-color="danger"
                                                           data-on-color="success">
                                                </td>
                                                @endpermission
                                                <td>
                                                    @permission('package-edit')
                                                    <a href="{{  route('package.edit',$data->id) }}"
                                                       class="btn btn-outline-primary btn-block btn-sm"><i class="fa fa-edit"></i>{{trans('lang.Edit')}}</a>
                                                    @endpermission
                                                    @permission('package-delete')
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
                                            <th>{{trans('lang.Listing')}}</th>
                                            <th>{{trans('lang.Type')}}</th>
                                            <th>{{trans('lang.Count')}}</th>
                                             @permission('package-status')
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
@endsection
@section('script_style')
    @include('includes.admin.dataTables.script_DataTables')
@endsection
