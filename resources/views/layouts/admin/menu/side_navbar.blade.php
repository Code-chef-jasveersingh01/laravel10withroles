<!-- ========== App Menu ========== -->
@php
  $role_name = Auth::user()->getRoleNames();
@endphp
@if ($role_name[0] == 'Super Admin')
@endif
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box" style="background: #38b7fe;">
        <!-- Dark Logo-->
        <a href="{{route('admin.dashboard')}}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/Logo333@3x.png') }}" alt="" height="60">
            </span>
            <span class="logo-lg h-100">
                <h3 class="sidebar-logo-text">{{config('app.name')}}</h3>
                {{-- <img src="{{ URL::asset('assets/images/designer_auth_logo1.png') }}" alt="" height="17"> --}}
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{route('admin.dashboard')}}" class="logo logo-light">
            <span class="logo-sm">
              <img src="{{ URL::asset('assets/images/Logo333@3x.png') }}" alt="" height="60">
                {{-- <img src="{{ URL::asset('assets/images/designer_logo.svg') }}" alt="" height="22"> --}}
            </span>
            <span class="logo-lg">
              <h3 class="sidebar-logo-text">{{config('app.name')}}</h3>
                {{-- <img src="{{ URL::asset('assets/images/designer_blue.svg') }}" alt="" height="17"> --}}
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('dashboard*')) ? 'menu-link active' : 'menu-link' }}" href="{{route('admin.dashboard')}}">
                        <i class="ri-dashboard-2-line"></i> <span>@lang('main.dashboard')</span>
                    </a>
                </li> <!-- end Dashboard Menu -->
                @if (Auth::user()->hasRole('Super Admin'))
                @canany(['View All Admin'.'View All Users','View All Roles','Create User'])
                  <li class="nav-item">
                      <a class="nav-link menu-link {{ (request()->is('users*')) ? 'active collaspe' : 'collapsed' }}" href="#users"  data-bs-toggle="collapse" role="button" aria-expanded="{{ (request()->is('users*')) ? 'true' : 'false' }}" aria-controls="users">
                          <i class="ri-account-circle-line"></i> <span>@lang('main.admin_management')</span>
                      </a>
                      <div class="menu-dropdown {{ (request()->is('users*')) ? 'collapse show' : 'collapse' }}" id="users">
                          <ul class="nav nav-sm flex-column">
                            @canany(['View All Admin', 'Create Admin','View Admin Details', 'Edit Admin', 'Delete Admin'])
                              <li class="nav-item">
                                  <a href="{{route('admin.adminList')}}" class="nav-link {{ (request()->is('users/admin*')) ? 'active' : '' }}">@lang('main.admin')</a>
                              </li>
                            @endcan
                            @can('View All Users')
                              <li class="nav-item">
                                  <a href="{{route('admin.usersList')}}" class="nav-link {{ (request()->is('users/user*')) ? 'active' : '' }}">@lang('main.users')</a>
                              </li>
                            @endcan
                            @can('View All Roles')
                              <li class="nav-item">
                                  <a href="{{route('admin.roleList')}}" class="nav-link {{ (request()->is('users/role*')) ? 'active' : '' }}">@lang('main.roles')</a>
                              </li>
                            @endcan
                          </ul>
                      </div>
                  </li>
                @endcanany

                @canany(['View All Users','Create User'])
                <li class="nav-item">
                    <a class="nav-link menu-link {{ (request()->is('customers*')) ? 'active collaspe' : 'collapsed' }}" href="#customers"  data-bs-toggle="collapse" role="button" aria-expanded="{{ (request()->is('customers*')) ? 'true' : 'false' }}" aria-controls="customers">
                        <i class="ri-account-circle-line"></i> <span>@lang('main.customer_management')</span>
                    </a>
                    <div class="menu-dropdown {{ (request()->is('customers*')) ? 'collapse show' : 'collapse' }}" id="customers">
                        <ul class="nav nav-sm flex-column">
                          @can('View All Users')
                            <li class="nav-item">
                                <a href="{{route('admin.customersList')}}" class="nav-link {{ (request()->is('customers/customer*')) ? 'active' : '' }}">@lang('main.customers')</a>
                            </li>
                          @endcan
                        </ul>
                    </div>
                </li>
              @endcanany


                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
