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
                @permission('acl-list')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            {{trans('lang.Acl')}}
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
                        @permission('user-list')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    {{trans('lang.User')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @permission('user-index')
                                <li class="nav-item">
                                    <a href="{{route('user.index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('user-create')
                                <li class="nav-item">
                                    <a href="{{route('user.create')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Create')}}</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('user-index-delete')
                                <li class="nav-item">
                                    <a href="{{route('user.delete_index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Delete')}} {{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                @endpermission
                            </ul>
                        </li>
                        @endpermission
                        @permission('agency-list')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    {{trans('lang.Agency')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @permission('agency-index')
                                <li class="nav-item">
                                    <a href="{{route('agency.index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('agency-create')
                                <li class="nav-item">
                                    <a href="{{route('agency.create')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Create')}}</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('agency-index-delete')
                                <li class="nav-item">
                                    <a href="{{route('agency.delete_index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Delete')}} {{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                @endpermission
                            </ul>
                        </li>
                        @endpermission
                        @permission('developer-list')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    {{trans('lang.Developer')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @permission('developer-index')
                                <li class="nav-item">
                                    <a href="{{route('developer.index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('developer-create')
                                <li class="nav-item">
                                    <a href="{{route('developer.create')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Create')}}</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('developer-index-delete')
                                <li class="nav-item">
                                    <a href="{{route('developer.delete_index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Delete')}} {{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                @endpermission
                            </ul>
                        </li>
                        @endpermission
                        @permission('role-list')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    {{trans('lang.Role')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @permission('role-index')
                                <li class="nav-item">
                                    <a href="{{route('role.index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('role-create')
                                <li class="nav-item">
                                    <a href="{{route('role.create')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Create')}}</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('role-index-delete')
                                <li class="nav-item">
                                    <a href="{{route('role.delete_index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Delete')}} {{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                @endpermission
                            </ul>
                        </li>
                        @endpermission
                        @permission('permission-list')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    {{trans('lang.Permission')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @permission('permission-index')
                                <li class="nav-item">
                                    <a href="{{route('permission.index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('permission-index-delete')
                                <li class="nav-item">
                                    <a href="{{route('permission.delete_index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Delete')}} {{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                @endpermission
                            </ul>
                        </li>
                        @endpermission
                    </ul>
                </li>
                @endpermission
                @permission('core-data-list')
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
                        @permission('language-list')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    {{trans('lang.Language')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @permission('language-index')
                                <li class="nav-item">
                                    <a href="{{route('language.index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('language-index-delete')
                                <li class="nav-item">
                                    <a href="{{route('language.delete_index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Delete')}} {{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                @endpermission
                            </ul>
                        </li>
                        @endpermission
                        @permission('status-list')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    {{trans('lang.Status')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @permission('status-index')
                                <li class="nav-item">
                                    <a href="{{route('status.index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('status-index-delete')
                                <li class="nav-item">
                                    <a href="{{route('status.delete_index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Delete')}} {{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                @endpermission
                            </ul>
                        </li>
                        @endpermission
                        @permission('type-list')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    {{trans('lang.Type')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @permission('type-index')
                                <li class="nav-item">
                                    <a href="{{route('type.index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('type-index-delete')
                                <li class="nav-item">
                                    <a href="{{route('type.delete_index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Delete')}} {{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                @endpermission
                            </ul>
                        </li>
                        @endpermission
                        @permission('category-list')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    {{trans('lang.Category')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @permission('category-index')
                                <li class="nav-item">
                                    <a href="{{route('category.index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('category-index-delete')
                                <li class="nav-item">
                                    <a href="{{route('category.delete_index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Delete')}} {{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                @endpermission
                            </ul>
                        </li>
                        @endpermission
                        @permission('country-list')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    {{trans('lang.Country')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @permission('country-index')
                                <li class="nav-item">
                                    <a href="{{route('country.index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('country-index-delete')
                                <li class="nav-item">
                                    <a href="{{route('country.delete_index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Delete')}} {{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                @endpermission
                            </ul>
                        </li>
                        @endpermission
                        @permission('city-list')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    {{trans('lang.City')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @permission('city-index')
                                <li class="nav-item">
                                    <a href="{{route('city.index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('city-index-delete')
                                <li class="nav-item">
                                    <a href="{{route('city.delete_index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Delete')}} {{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                @endpermission
                            </ul>
                        </li>
                        @endpermission
                        @permission('rejoin-list')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    {{trans('lang.Rejoin')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @permission('rejoin-index')
                                <li class="nav-item">
                                    <a href="{{route('rejoin.index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('rejoin-index-delete')
                                <li class="nav-item">
                                    <a href="{{route('rejoin.delete_index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Delete')}} {{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                @endpermission
                            </ul>
                        </li>
                        @endpermission
                        @permission('currency-list')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    {{trans('lang.Currency')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @permission('currency-index')
                                <li class="nav-item">
                                    <a href="{{route('currency.index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('currency-index-delete')
                                <li class="nav-item">
                                    <a href="{{route('currency.delete_index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Delete')}} {{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                @endpermission
                            </ul>
                        </li>
                        @endpermission
                        @permission('amenity-list')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    {{trans('lang.Amenity')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @permission('amenity-index')
                                <li class="nav-item">
                                    <a href="{{route('amenity.index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('amenity-index-delete')
                                <li class="nav-item">
                                    <a href="{{route('amenity.delete_index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Delete')}} {{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                @endpermission
                            </ul>
                        </li>
                        @endpermission
                        @permission('package-list')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    {{trans('lang.Package')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @permission('package-index')
                                <li class="nav-item">
                                    <a href="{{route('package.index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('package-index-delete')
                                <li class="nav-item">
                                    <a href="{{route('package.delete_index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Delete')}} {{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                @endpermission
                            </ul>
                        </li>
                        @endpermission
                        @permission('highlight-list')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    {{trans('lang.HighLight')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @permission('highlight-index')
                                <li class="nav-item">
                                    <a href="{{route('highlight.index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('highlight-index-delete')
                                <li class="nav-item">
                                    <a href="{{route('highlight.delete_index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Delete')}} {{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                @endpermission
                            </ul>
                        </li>
                        @endpermission
                    </ul>
                </li>
                @endpermission
                @permission('setting-list')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            {{trans('lang.Setting')}}
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
                        @permission('meta-list')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    {{trans('lang.Meta')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @permission('meta-index')
                                <li class="nav-item">
                                    <a href="{{route('meta.index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('meta-index-delete')
                                <li class="nav-item">
                                    <a href="{{route('meta.delete_index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Delete')}} {{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                @endpermission
                            </ul>
                        </li>
                        @endpermission
                        @permission('fq-list')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    {{trans('lang.FQ')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @permission('fq-index')
                                <li class="nav-item">
                                    <a href="{{route('fq.index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('meta-index-delete')
                                <li class="nav-item">
                                    <a href="{{route('fq.delete_index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{trans('lang.Delete')}} {{trans('lang.Index')}}</p>
                                    </a>
                                </li>
                                @endpermission
                            </ul>
                        </li>
                        @endpermission
                    </ul>
                </li>
                @endpermission
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
@yield('main-sidebar')
