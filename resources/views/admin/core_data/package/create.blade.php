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
                            <li class="breadcrumb-item active">{{trans('lang.Package')}}</li>
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
                                {{trans('lang.Create')}}
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            @include('errors.error')
                            <form id="create" method="post" action="{{route('package.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
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
                                                   value="{{Request::old('order')}}"
                                                   placeholder="{{trans('lang.Enter_Order')}}">
                                        </div>
                                        <div class="form-group{{ $errors->has('count_listing') ? ' is-invalid' : "" }}">
                                            <label for="order">{{trans('lang.Listing')}}</label>
                                            <input type="text" name="count_listing" class="form-control"
                                                   id="count_listing"
                                                   value="{{Request::old('count_listing')}}"
                                                   placeholder="{{trans('lang.Enter_Listing')}}">
                                        </div>
                                        <div class="form-group{{ $errors->has('type_date') ? ' is-invalid' : "" }}">
                                            <label>{{trans('lang.Type')}}</label>
                                            <select class="form-control" id="type_date" name="type_date"
                                                    style="width: 100%;">
                                                <option selected>{{trans('lang.Select')}}</option>
                                                <option value="d">{{trans('lang.day')}}</option>
                                                <option value="w">{{trans('lang.week')}}</option>
                                                <option value="m">{{trans('lang.month')}}</option>
                                                <option value="y">{{trans('lang.year')}}</option>
                                            </select>
                                        </div>
                                        <div class="form-group{{ $errors->has('count_date') ? ' is-invalid' : "" }}">
                                            <label for="order">{{trans('lang.Count')}}</label>
                                            <input type="text" name="count_date" class="form-control" id="count_date"
                                                   value="{{Request::old('count_date')}}"
                                                   placeholder="{{trans('lang.Enter_Count')}}">
                                        </div>
                                        <div
                                            class="form-group{{ $errors->has('count_featured') ? ' is-invalid' : "" }}">
                                            <label for="order">{{trans('lang.Featured')}}</label>
                                            <input type="text" name="count_featured" class="form-control"
                                                   id="count_featured"
                                                   value="{{Request::old('count_featured')}}"
                                                   placeholder="{{trans('lang.Enter_Featured')}}">
                                        </div>
                                        <div
                                            class="form-group{{ $errors->has('image_included') ? ' is-invalid' : "" }}">
                                            <label for="order">{{trans('lang.Image')}}</label>
                                            <input type="text" name="image_included" class="form-control"
                                                   id="image_included"
                                                   value="{{Request::old('image_included')}}"
                                                   placeholder="{{trans('lang.Enter_Image')}}">
                                        </div>
                                        <div class="form-group{{ $errors->has('price') ? ' is-invalid' : "" }}">
                                            <label for="order">{{trans('lang.Price')}}</label>
                                            <input type="text" name="price" class="form-control" id="price"
                                                   value="{{Request::old('price')}}"
                                                   placeholder="{{trans('lang.Enter_Price')}}">
                                        </div>
                                            <div class="form-group{{ $errors->has('role') ? ' has-error' : "" }}">
                                                <label>{{trans('lang.Role')}}</label>
                                                <select class="duallistbox" multiple="multiple" name="role[]">
                                                    @foreach($role as $ro)
                                                        <option  value="{{$ro->id}}">{{$ro->title->value}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group{{ $errors->has('currency_id') ? ' is-invalid' : "" }}">
                                                <label>{{trans('lang.Currency')}}</label>
                                                <select class="form-control select2" id="currency" name="currency_id"
                                                        style="width: 100%;">
                                                    @foreach($currency as $cr)
                                                        <option value="{{$cr->id}}"
                                                                id="option-currency-{{$cr->id}}">{{$cr->title ? $cr->title->value : ""}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                    </div>
                                    <!-- /.card-body -->

                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-outline-light"
                                            data-dismiss="modal">{{trans('lang.Close')}}</button>
                                    <button type="submit"
                                            class="btn btn-outline-light">{{trans('lang.Create')}}</button>
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
    {!! JsValidator::formRequest('App\Http\Requests\Admin\CoreData\Package\CreateRequest','#create') !!}
@endsection
