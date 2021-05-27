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
                            <form id="edit" action="{{route('package.update',$data->id)}}" method="post" name="edit" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
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
                                        <div class="form-group{{ $errors->has('count_listing') ? ' is-invalid' : "" }}">
                                            <label for="order">{{trans('lang.Listing')}}</label>
                                            <input type="text" name="count_listing" class="form-control" id="count_listing"
                                                   value="{{$data->count_listing}}" placeholder="{{trans('lang.Enter_Listing')}}">
                                        </div>
                                        <div class="form-group{{ $errors->has('type_date') ? ' is-invalid' : "" }}">
                                            <label>{{trans('lang.Type')}}</label>
                                            <select class="form-control" id="type_date" name="type_date"
                                                    style="width: 100%;">
                                                <option @if($data->type_date == "d") selected @endif value="d">{{trans('lang.day')}}</option>
                                                <option @if($data->type_date == "m") selected @endif value="m">{{trans('lang.month')}}</option>
                                                <option @if($data->type_date == "y") selected @endif value="y">{{trans('lang.year')}}</option>
                                            </select>
                                        </div>
                                        <div class="form-group{{ $errors->has('count_date') ? ' is-invalid' : "" }}">
                                            <label for="order">{{trans('lang.Count')}}</label>
                                            <input type="text" name="count_date" class="form-control" id="count_date"
                                                   value="{{$data->count_date}}" placeholder="{{trans('lang.Enter_Count')}}">
                                        </div>
                                            <div
                                                class="form-group{{ $errors->has('count_featured') ? ' is-invalid' : "" }}">
                                                <label for="order">{{trans('lang.Featured')}}</label>
                                                <input type="text" name="count_featured" class="form-control"
                                                       id="count_featured"
                                                       value="{{$data->count_featured}}"
                                                       placeholder="{{trans('lang.Enter_Featured')}}">
                                            </div>
                                            <div
                                                class="form-group{{ $errors->has('image_included') ? ' is-invalid' : "" }}">
                                                <label for="order">{{trans('lang.Image')}}</label>
                                                <input type="text" name="image_included" class="form-control"
                                                       id="image_included"
                                                       value="{{$data->image_included}}"
                                                       placeholder="{{trans('lang.Enter_Image')}}">
                                            </div>
                                            <div class="form-group{{ $errors->has('price') ? ' is-invalid' : "" }}">
                                                <label for="order">{{trans('lang.Price')}}</label>
                                                <input type="text" name="price" class="form-control" id="price"
                                                       value="{{$data->price)}}"
                                                       placeholder="{{trans('lang.Enter_Price')}}">
                                            </div>
                                            <div class="form-group{{ $errors->has('role') ? ' has-error' : "" }}">
                                                <label>{{trans('lang.Role')}}</label>
                                                <select class="duallistbox" multiple="multiple" name="role[]">
                                                    @foreach($role as $key => $ro)
                                                        <option @foreach($package_role as  $pr) @if($pr->role_id ==$ro->id) selected   @endif @endforeach value="{{$ro->id}}">{{$ro->title->value}}</option>
                                                    @endforeach
                                                </select>
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
