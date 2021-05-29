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
                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.dashboard')}}">{{trans('lang.Home')}}</a></li>
                            <li class="breadcrumb-item active">{{trans('lang.FQ')}}</li>
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
                                        @permission('fq-create')
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
                                            <th>{{trans('lang.Question')}}</th>
                                            <th>{{trans('lang.Answer')}}</th>
                                            @permission('fq-status')
                                            <th>{{trans('lang.Status')}}</th>
                                            @endpermission
                                            <th>{{trans('lang.Controller')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody id="body">
                                        @forelse($datas as $data)
                                            <tr id="data-{{$data->id}}">
                                                <td id="question-{{$data->id}}"
                                                    data-order="{{$data->order}}">{{$data->question ? $data->question->value : ""}}</td>
                                                <td id="answer-{{$data->id}}">{{$data->answer ? $data->answer->value : ""}}</td>
                                                @permission('fq-status')
                                                <td>
                                                    <input onfocus="changeStatus({{$data->id}})" type="checkbox"
                                                           name="status" @if($data->status) checked
                                                           @endif id="status-{{$data->id}}"
                                                           data-bootstrap-switch data-off-color="danger"
                                                           data-on-color="success">
                                                </td>
                                                @endpermission
                                                <td>
                                                    @permission('fq-edit')
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
                                                    @permission('fq-delete')
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
                                            <th>{{trans('lang.Question')}}</th>
                                            <th>{{trans('lang.Answer')}}</th>
                                            @permission('fq-status')
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
    @permission('fq-create')
    <div class="modal fade" id="modal-create">
        <div class="modal-dialog">
            <div class="modal-content bg-success">
                <div class="modal-header">
                    <h4 class="modal-title">{{trans('lang.Create')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="create" method="post" action="">
                    @csrf
                    <div class="modal-body">
                        <div class="card-body">
                            @foreach($language as $lang)
                                <div
                                    class="form-group{{ $errors->has('question['.$lang->code.']') ? ' is-invalid' : "" }}">
                                    <label for="question">{{trans('lang.Question')}} {{$lang->title}}</label>
                                    <input type="text" name="question[{{$lang->code}}]" class="form-control"
                                           id="question[{{$lang->code}}]"
                                           value="{{Request::old('question['.$lang->code.']')}}"
                                           placeholder="{{trans('lang.Enter_Question')}} {{$lang->title}}">
                                </div>
                                <div
                                    class="form-group{{ $errors->has('answer['.$lang->code.']') ? ' is-invalid' : "" }}">
                                    <label for="answer">{{trans('lang.Answer')}} {{$lang->title}}</label>
                                    <input type="text" name="answer[{{$lang->code}}]" class="form-control"
                                           id="answer[{{$lang->code}}]"
                                           value="{{Request::old('answer['.$lang->code.']')}}"
                                           placeholder="{{trans('lang.Enter_Answer')}} {{$lang->title}}">
                                </div>
                            @endforeach
                            <div class="form-group{{ $errors->has('order') ? ' is-invalid' : "" }}">
                                <label for="order">{{trans('lang.Order')}}</label>
                                <input type="text" name="order" class="form-control" id="order"
                                       value="{{Request::old('order')}}" placeholder="{{trans('lang.Enter_Order')}}">
                            </div>
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light"
                                data-dismiss="modal">{{trans('lang.Close')}}</button>
                        <button type="submit" class="btn btn-outline-light">{{trans('lang.Create')}}</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @endpermission
    @permission('fq-edit')
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
                                    class="form-group{{ $errors->has('question['.$lang->code.']') ? ' is-invalid' : "" }}">
                                    <label for="question">{{trans('lang.Question')}} {{$lang->title}}</label>
                                    <input type="text" name="question[{{$lang->code}}]" class="form-control"
                                           id="question-{{$lang->code}}"
                                           value="" placeholder="{{trans('lang.Enter_Question')}} {{$lang->title}}">
                                </div>
                                <div
                                    class="form-group{{ $errors->has('answer['.$lang->code.']') ? ' is-invalid' : "" }}">
                                    <label for="answer">{{trans('lang.Answer')}} {{$lang->title}}</label>
                                    <input type="text" name="answer[{{$lang->code}}]" class="form-control"
                                           id="answer-{{$lang->code}}"
                                           value="" placeholder="{{trans('lang.Enter_Answer')}} {{$lang->title}}">
                                </div>
                            @endforeach
                            <div class="form-group{{ $errors->has('order') ? ' is-invalid' : "" }}">
                                <label for="order">{{trans('lang.Order')}}</label>
                                <input type="text" name="order" class="form-control" id="order"
                                       value="" placeholder="{{trans('lang.Enter_Order')}}">
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
    @permission('fq-edit')
    <script>
        //show item
        function showData(res) {
            for (let i in res.translation) {
                if (res.translation[i].key == 'question') {
                    $(`#edit #question-${res.translation[i].language.code}`).val(res.translation[i].value);
                }
                if (res.translation[i].key == 'answer') {
                    $(`#edit #answer-${res.translation[i].language.code}`).val(res.translation[i].value);
                }
            }
            $('#edit #order').val(res.order);
        }

        //edit data
        function updateItem(res) {
            document.getElementById('answer-' + res.id).innerHTML = res.answer;
            document.getElementById('question-' + res.id).innerHTML = res.question;
            $(`#question-${res.id}`).attr('data-order', res.order);
        }
    </script>
    @endpermission
@endsection
