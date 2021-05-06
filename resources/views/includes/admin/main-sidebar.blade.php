<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard')}}" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                       aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                {{--<li class="nav-header">Core Data</li>--}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                             {{trans('lang.Core_Data')}}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                       {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Level 2</p>
                            </a>
                        </li>--}}
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                   {{trans('lang.Language')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('language.index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('language.delete_index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Delete')}} {{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    {{trans('lang.Status')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                   <a href="{{route('status.index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('status.delete_index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Delete')}} {{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    {{trans('lang.Type')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('type.index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('type.delete_index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Delete')}} {{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    {{trans('lang.Category')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('category.index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('category.delete_index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Delete')}} {{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    {{trans('lang.Country')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('country.index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('country.delete_index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Delete')}} {{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    {{trans('lang.City')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('city.index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('city.delete_index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Delete')}} {{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                     {{trans('lang.Area')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('area.index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('area.delete_index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Delete')}} {{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                     {{trans('lang.Amenity')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('amenity.index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('amenity.delete_index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Delete')}} {{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    {{trans('lang.Package')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('package.index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('package.delete_index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Delete')}} {{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    {{trans('lang.HighLight')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('highlight.index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('highlight.delete_index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Delete')}} {{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
@yield('main-sidebar')
