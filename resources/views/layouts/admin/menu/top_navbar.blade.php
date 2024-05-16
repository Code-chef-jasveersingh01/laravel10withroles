@php
$role_name = Auth::user()->getRoleNames();

$notification_data = [];
// dd($notification_data);
@endphp
<header id="page-topbar">
  <div class="layout-width">
    <div class="navbar-header">
      <div class="d-flex">
        <!-- LOGO -->
        <div class="navbar-brand-box horizontal-logo">
          <a href="index" class="logo logo-dark">
            <span class="logo-sm">
              <img src="{{ URL::asset('assets/images/Logo333@3x.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
              <img src="{{ URL::asset('assets/images/Logo333@3x.png') }}" alt="" height="17">
            </span>
          </a>
          <a href="index" class="logo logo-light">
            <span class="logo-sm">
              <img src="{{ URL::asset('assets/images/Logo333@3x.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
              <img src="{{ URL::asset('assets/images/Logo333@3x.png') }}" alt="" height="17">
            </span>
          </a>
        </div>

        <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
          id="topnav-hamburger-icon">
          <span class="hamburger-icon">
            <span></span>
            <span></span>
            <span></span>
          </span>
        </button>
      </div>

      <div class="d-flex align-items-center">

        <div class="ms-1 header-item d-none d-sm-flex">
          <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
            data-toggle="fullscreen">
            <i class='bx bx-fullscreen fs-22'></i>
          </button>
        </div>

        <div class="dropdown topbar-head-dropdown ms-1 header-item">
          <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
            id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class='bx bx-bell fs-22'></i>
            {{-- <span
              class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">{{App\Models\Chat::where('read_status',1)->count()}}<span
                class="visually-hidden">unread messages</span></span> --}}

            @if (count($notification_data) > 0)
            <span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">
              {{ count($notification_data) }}</span>
            @endif
            <span class="visually-hidden">unread messages</span></span>
          </button>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
            aria-labelledby="page-header-notifications-dropdown">

            <div class="dropdown-head bg-primary bg-pattern rounded-top">
              <div class="p-3">
                <div class="row align-items-center">
                  <div class="col">
                    <h6 class="m-0 fs-16 fw-semibold text-white"> Notifications </h6>
                  </div>
                  <div class="col-auto dropdown-tabs">
                    <span class="badge badge-soft-light fs-13">
                      @if (count($notification_data) > 0)
                      {{ count($notification_data) }}
                      @endif New</span>
                  </div>
                </div>
              </div>

              <div class="px-2 pt-2">
                <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true"
                  id="notificationItemsTab" role="tablist">
                  <li class="nav-item waves-effect waves-light">
                    <a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab" role="tab"
                      aria-selected="true">
                      All
                    </a>
                  </li>

                </ul>
              </div>

            </div>
            <div class="tab-content" id="notificationItemsTabContent">
              <div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel">
                <div data-simplebar style="max-height: 300px;" class="pe-2">
                  <div class="text-reset notification-item d-block dropdown-item position-relative">
                    @if(isset($notification_data) && count($notification_data) > 0)
                    @foreach ($notification_data as $notification)
                    <div class="text-reset notification-item d-block dropdown-item showNotificationDetails position-relative" data-notificationid="{{$notification['id']}}" data-notificationType="{{ str_replace("App\Notifications\\"," ", $notification['type']) }}" data-message="{{$notification['data']['message']}}" data-name="{{ isset($notification['data']['message']) ? $notification['data']['name'] : Reviewer }}">
                      <div class="d-flex">
                        <img src="{{$notification['data']['avatar']}}" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                        <div class="flex-1">
                          <a href="#!" class="stretched-link">
                            <h6 class="mt-0 mb-1 fs-13 fw-semibold">{{$notification['data']['name']}}</h6>
                          </a>
                          <div class="fs-13 text-muted">
                            <p class="mb-1">{{$notification['data']['title']}} 🔔.</p>
                          </div>
                          <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                            <span><i class="mdi mdi-clock-outline"></i> {{$notification['created_at']->diffForHumans()}}</span>
                          </p>
                        </div>
                      </div>
                    </div>
                    @endforeach
                    @endif
                  </div>
                  {{-- <div class="text-reset notification-item d-block dropdown-item position-relative">

                    @foreach
                    (App\Models\Chat::with('userdata')->where('read_status',1)->groupBy('user_id')->take(10)->get()->toarray()
                    as $doctor)
                    <div class="d-flex">
                      <div class="avatar-xs me-3">
                        <span class="avatar-title bg-soft-info text-info rounded-circle fs-16">
                          <i class="bx bx-badge-check"></i>
                        </span>
                      </div>
                      <div class="flex-1">
                        <a class="stretched-link">
                          <h6 class="mt-0 mb-2 lh-base">
                            {{ isset( $doctor['userdata']['name']) ? $doctor['userdata']['name'] : ''}}
                          </h6>
                        </a>
                        <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                          <span>
                            DR_ID {{isset($doctor['userdata']['DR_ID'])?$doctor['userdata']['DR_ID'] : '' }}
                          </span>
                        </p>
                      </div>
                    </div>
                    @endforeach
                  </div> --}}
                  {{-- <div class="my-3 text-center">
                    <button type="button" class="btn btn-soft-success waves-effect waves-light">View
                      All Notifications <i class="ri-arrow-right-line align-middle"></i></button>
                  </div> --}}
                </div>

              </div>


            </div>
          </div>
        </div>

        <div class="dropdown ms-sm-3 header-item topbar-user">
          <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <span class="d-flex align-items-center">
              <img class="rounded-circle header-profile-user"
                src='{{!empty(Auth::user()->profile_image)? Auth::user()->profile_image: asset("assets/images/users/user-dummy-img.jpg")}}' alt="Header Avatar">
              <span class="text-start ms-xl-2">
                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{Auth::user()->name}}</span>
                <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">{{$role_name[0]}}</span>
              </span>
            </span>
          </button>
          <div class="dropdown-menu dropdown-menu-end">
            <!-- item-->
            <h6 class="dropdown-header">{{__('main.welcome')}} {{Auth::user()->name}}</h6>
            <a class="dropdown-item" href="{{route('admin.profile')}}"><i
                class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                class="align-middle">{{__('main.profile')}}</span></a>
            <a class="dropdown-item" href="{{route('admin.changePassword')}}"><i
                class="mdi mdi-message-text-outline text-muted fs-16 align-middle me-1"></i> <span
                class="align-middle">{{__('main.change_password')}}</span></a>
            @if(Auth::user()->user_type === 2)
            <a class="dropdown-item" href="{{route('admin.storeProfile')}}"><i
                class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                class="align-middle">{{__('main.store_setting')}}</span></a>
            @endif
            <div class="dropdown-divider"></div>
            <a class="dropdown-item " href="javascript:void();"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                class="bx bx-power-off font-size-16 align-middle me-1"></i> <span
                key="t-logout">@lang('main.logout')</span></a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


</header>
