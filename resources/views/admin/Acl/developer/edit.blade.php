@extends('includes.admin.master_admin')
@section('title')
    {{trans('lang.Update')}}
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
                        <h1>{{trans('lang.Developer')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                        href="{{route('admin.dashboard')}}">{{trans('lang.Home')}}</a></li>
                            <li class="breadcrumb-item active">{{trans('lang.Developer')}}</li>
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
                            <form action="{{route('developer.update',$data->id)}}" method="post" id="edit"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group{{ $errors->has('fullname') ? ' is-invalid' : "" }}">
                                        <label for="fullname">{{trans('lang.Full_Name')}}</label>
                                        <input type="text" name="fullname" class="form-control" id="fullname"
                                               value="{{$data->user->fullname}}"
                                               placeholder="{{trans('lang.Enter_Full_Name')}}">
                                    </div>
                                    <div class="form-group{{ $errors->has('username') ? ' is-invalid' : "" }}">
                                        <label for="username">{{trans('lang.User_Name')}}</label>
                                        <input type="text" name="username" class="form-control" id="username"
                                               value="{{$data->user->username}}" disabled
                                               placeholder="{{trans('lang.Enter_User_Name')}}">
                                    </div>
                                    <div class="form-group{{ $errors->has('email') ? ' is-invalid' : "" }}">
                                        <label for="email">{{trans('lang.Email')}}</label>
                                        <input type="email" name="email" class="form-control" id="email"
                                               value="{{$data->user->email}}"
                                               placeholder="{{trans('lang.Enter_Email')}}">
                                    </div>
                                    <div class="form-group{{ $errors->has('phone') ? ' is-invalid' : "" }}">
                                        <label for="phone">{{trans('lang.Phone')}}</label>
                                        <input type="text" name="phone" class="form-control" id="phone"
                                               value="{{$data->user->phone}}"
                                               placeholder="{{trans('lang.Enter_Phone')}}">
                                    </div>
                                    <div class="form-group{{ $errors->has('country') ? ' is-invalid' : "" }}">
                                        <label>{{trans('lang.Country')}}</label>
                                        <select class="form-control select2" id="country" name="country_id"
                                                style="width: 100%;">
                                            @foreach($country as $my)
                                                <option value="{{$my->id}}"
                                                        @if($data->user->country_id == $my->id) selected
                                                        @endif   id="option-country-{{$my->id}}">{{$my->title ? $my->title->value : ""}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @foreach($language as $lang)
                                        <div
                                                class="form-group{{ $errors->has('address['.$lang->code.']') ? ' is-invalid' : "" }}">
                                            <label for="title">{{trans('lang.Address')}} {{$lang->title}}</label>
                                            <input type="text" name="address[{{$lang->code}}]" class="form-control"
                                                   id="address[{{$lang->code}}]"
                                                   @php($address=$data->translation->where('key','address')->where('language_id', $lang->id)->first())
                                                   @if($address)
                                                   value="{{$address->value}}"
                                                   @endif
                                                   placeholder="{{trans('lang.Enter_Address')}} {{$lang->title}}">
                                        </div>
                                    @endforeach
                                    <img src="{{ getImag($data->user->image,'user') }}"
                                         id="image-{{$data->id}}" style="width:100px;height: 100px">
                                    <div class="form-group{{ $errors->has('image') ? ' has-error' : "" }}">
                                        <label>{{trans('lang.Image')}}</label>
                                        <input type="file" value="{{Request::old('image')}}" name="image"/>
                                        <label for="image">jpg, png, gif</label>
                                    </div>
                                    @foreach($language as $lang)
                                        <div
                                                class="form-group{{ $errors->has('about_me['.$lang->code.']') ? ' is-invalid' : "" }}">
                                            <label for="about_me">{{trans('lang.About_Me')}} {{$lang->title}}</label>
                                            <textarea type="text" name="about_me[{{$lang->code}}]" class="form-control"
                                                      id="about_me[{{$lang->code}}]"
                                                      placeholder="{{trans('lang.Enter_About_Me')}} {{$lang->title}}">@php($about_me=$data->translation->where('key','about_me')->where('language_id', $lang->id)->first())
                                                @if($about_me)
                                                    {{$about_me->value}}
                                                @endif</textarea>
                                        </div>
                                    @endforeach
                                    <div class="form-group{{ $errors->has('facebook') ? ' is-invalid' : "" }}">
                                        <label for="facebook">{{trans('lang.Facebook')}}</label>
                                        <input type="text" name="facebook" class="form-control" id="facebook"
                                               value="{{$data->user->facebook}}"
                                               placeholder="{{trans('lang.Enter_Facebook')}}">
                                    </div>
                                    <div class="form-group{{ $errors->has('website') ? ' is-invalid' : "" }}">
                                        <label for="website">{{trans('lang.Website')}}</label>
                                        <input type="text" name="website" class="form-control" id="website"
                                               value="{{$data->user->website}}"
                                               placeholder="{{trans('lang.Enter_Website')}}">
                                    </div>
                                    <div class="form-group{{ $errors->has('youtube') ? ' is-invalid' : "" }}">
                                        <label for="youtube">{{trans('lang.Youtube')}}</label>
                                        <input type="text" name="youtube" class="form-control" id="youtube"
                                               value="{{$data->user->youtube}}"
                                               placeholder="{{trans('lang.Enter_Youtube')}}">
                                    </div>
                                    <div class="form-group{{ $errors->has('twitter') ? ' is-invalid' : "" }}">
                                        <label for="twitter">{{trans('lang.Twitter')}}</label>
                                        <input type="text" name="twitter" class="form-control" id="twitter"
                                               value="{{$data->user->twitter}}"
                                               placeholder="{{trans('lang.Enter_Twitter')}}">
                                    </div>
                                    <div class="form-group{{ $errors->has('instagram') ? ' is-invalid' : "" }}">
                                        <label for="instagram">{{trans('lang.Instagram')}}</label>
                                        <input type="text" name="instagram" class="form-control" id="instagram"
                                               value="{{$data->user->instagram}}"
                                               placeholder="{{trans('lang.Enter_Instagram')}}">
                                    </div>
                                    <!-- /.form-group -->
                                    <!-- /.col -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">{{trans('lang.Update')}}</button>
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
    {!! JsValidator::formRequest('App\Http\Requests\Admin\Acl\User\EditRequest','#edit') !!}
@endsection
