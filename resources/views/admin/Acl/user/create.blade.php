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
                            <form action="{{route('user.store')}}" method="post" id="create">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group{{ $errors->has('fullname') ? ' is-invalid' : "" }}">
                                        <label for="fullname">{{trans('lang.Full_Name')}}</label>
                                        <input type="text" name="fullname" class="form-control" id="fullname"
                                               value="{{Request::old('fullname')}}"
                                               placeholder="{{trans('lang.Enter_Full_Name')}}">
                                    </div>
                                    <div class="form-group{{ $errors->has('username') ? ' is-invalid' : "" }}">
                                        <label for="username">{{trans('lang.User_Name')}}</label>
                                        <input type="text" name="username" class="form-control" id="username"
                                               value="{{Request::old('username')}}"
                                               placeholder="{{trans('lang.Enter_User_Name')}}">
                                    </div>
                                    <div class="form-group{{ $errors->has('email') ? ' is-invalid' : "" }}">
                                        <label for="email">{{trans('lang.Email')}}</label>
                                        <input type="email" name="email" class="form-control" id="email"
                                               value="{{Request::old('email')}}"
                                               placeholder="{{trans('lang.Enter_Email')}}">
                                    </div>
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
                                    <div class="form-group{{ $errors->has('phone') ? ' is-invalid' : "" }}">
                                        <label for="phone">{{trans('lang.Phone')}}</label>
                                        <input type="text" name="phone" class="form-control" id="phone"
                                               value="{{Request::old('phone')}}"
                                               placeholder="{{trans('lang.Enter_Phone')}}">
                                    </div>
                                    <div class="form-group{{ $errors->has('dob') ? ' is-invalid' : "" }}">
                                        <label>{{trans('lang.DOB')}} :</label>
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="text" name="dob" value="{{Request::old('dob')}}"
                                                   placeholder="{{trans('lang.Exampl').' '.\Carbon\Carbon::now()->format('d/m/y')}}"
                                                   class="form-control datetimepicker-input"
                                                   data-target="#reservationdate" data-toggle="datetimepicker"/>
                                            <div class="input-group-append" data-target="#reservationdate"
                                                 data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('gender') ? ' is-invalid' : "" }}">
                                        <label>{{trans('lang.Gender')}}</label>
                                        <select class="form-control" id="gender" name="gender"
                                                style="width: 100%;">
                                            <option value="0">{{trans('lang.Male')}}</option>
                                            <option value="1">{{trans('lang.Famel')}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group{{ $errors->has('country') ? ' is-invalid' : "" }}">
                                        <label>{{trans('lang.Country')}}</label>
                                        <select class="form-control select2" id="country" name="country"
                                                style="width: 100%;">
                                            @foreach($country as $my)
                                                <option value="{{$my->id}}"
                                                        id="option-country-{{$my->id}}">{{$my->title ? $my->title->value : ""}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group{{ $errors->has('role') ? ' is-invalid' : "" }}">
                                        <label>{{trans('lang.Role')}}</label>
                                        <select class="form-control select2" id="role" name="role"
                                                style="width: 100%;">
                                            @foreach($role as $ro)
                                                <option value="{{$ro->id}}"
                                                        id="option-role-{{$ro->id}}">{{$ro->title ? $ro->title->value : ""}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group{{ $errors->has('image') ? ' has-error' : "" }}">
                                        <label>{{trans('lang.Image')}}</label>
                                        <input type="file" value="{{Request::old('image')}}" name="image"/>
                                        <label for="image">jpg, png, gif</label>
                                    </div>
                                    <div class="form-group{{ $errors->has('facebook') ? ' is-invalid' : "" }}">
                                        <label for="facebook">{{trans('lang.Facebook')}}</label>
                                        <input type="text" name="facebook" class="form-control" id="facebook"
                                               value="{{Request::old('facebook')}}"
                                               placeholder="{{trans('lang.Enter_Facebook')}}">
                                    </div>
                                    <div class="form-group{{ $errors->has('website') ? ' is-invalid' : "" }}">
                                        <label for="website">{{trans('lang.Website')}}</label>
                                        <input type="text" name="website" class="form-control" id="website"
                                               value="{{Request::old('website')}}"
                                               placeholder="{{trans('lang.Enter_Website')}}">
                                    </div>
                                    <div class="form-group{{ $errors->has('youtube') ? ' is-invalid' : "" }}">
                                        <label for="youtube">{{trans('lang.Youtube')}}</label>
                                        <input type="text" name="youtube" class="form-control" id="youtube"
                                               value="{{Request::old('youtube')}}"
                                               placeholder="{{trans('lang.Enter_Youtube')}}">
                                    </div>
                                    <div class="form-group{{ $errors->has('twitter') ? ' is-invalid' : "" }}">
                                        <label for="twitter">{{trans('lang.Twitter')}}</label>
                                        <input type="text" name="twitter" class="form-control" id="twitter"
                                               value="{{Request::old('twitter')}}"
                                               placeholder="{{trans('lang.Enter_Twitter')}}">
                                    </div>
                                    <div class="form-group{{ $errors->has('instagram') ? ' is-invalid' : "" }}">
                                        <label for="instagram">{{trans('lang.Instagram')}}</label>
                                        <input type="text" name="instagram" class="form-control" id="instagram"
                                               value="{{Request::old('instagram')}}"
                                               placeholder="{{trans('lang.Enter_Instagram')}}">
                                    </div>
                                    <!-- /.form-group -->
                                    <!-- /.col -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">{{trans('lang.Create')}}</button>
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
   <script>
        //Date range picker
        $('#reservationdate').datetimepicker({
            format: 'DD/MM/YYYY'
        });
    </script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\Acl\User\CreateRequest','#create') !!}
@endsection
