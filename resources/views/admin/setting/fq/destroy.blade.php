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
                        <h1>{{trans('lang.FQ')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans('lang.Home')}}</a></li>
                            <li class="breadcrumb-item active">{{trans('lang.FQ')}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                   {{trans('lang.Delete_Index_Message')}}
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                         <th>{{trans('lang.Question')}}</th>
                                         <th>{{trans('lang.Answer')}}</th>
                                         <th>{{trans('lang.Controller')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($datas as $data)
                                        <tr id="data-{{$data->id}}">
                                            <td id="question-{{$data->id}}">{{$data->question ? $data->question->value : ""}}</td>
                                            <td id="answer-{{$data->id}}">{{$data->answer ? $data->answer->value : ""}}</td>
                                            <td>
                                                @permission('fq-restore')
                                                <button type="button" class="btn btn-outline-primary btn-block btn-sm"
                                                        onclick="selectItem({{$data->id}})" data-toggle="modal"
                                                        data-target="#modal-restore">
                                                    <i class="fa fa-edit"></i> {{trans('lang.Restore')}}
                                                </button>
                                                @endpermission
                                                @permission('fq-remove')
                                                <button type="button" class="btn btn-outline-danger btn-block btn-sm"
                                                        onclick="selectItem({{$data->id}})" data-toggle="modal"
                                                        data-target="#modal-remove"><i></i> {{trans('lang.Delete')}}
                                                </button>
                                                @endpermission
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                         <th>{{trans('lang.Question')}}</th>
                                        <th>{{trans('lang.Answer')}}</th>
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
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script_style')
    @include('includes.admin.dataTables.script_DataTables')
@endsection
