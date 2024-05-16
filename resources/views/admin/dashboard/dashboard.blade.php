@extends('layouts.admin.layout')
@section('title')
    {{__('main.dashboard')}}
@endsection
@section('css')
<link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/swiper/swiper.min.css') }}" rel="stylesheet" type="text/css" />
<style>
    .bg-user{
        background: #FF9702 0% 0% no-repeat padding-box !important;
        opacity: 1;
    }
    .bg-product{
        background: #00D683 0% 0% no-repeat padding-box !important;
        opacity: 1;
    }
    .bg-package{
        background: #FF142B 0% 0% no-repeat padding-box !important;
        opacity: 1;
    }
    .bg-order{
        background: #38B7FE 0% 0% no-repeat padding-box !important;
        opacity: 1;
    }
    .bg-revenue{
        background: #4769CA 0% 0% no-repeat padding-box !important;
        opacity: 1;
    }
</style>
@endsection
@section('content')
@component('components.breadcrumb')
@slot('title') {{__('main.dashboard')}} @endslot
@endcomponent

  <div class="row">
      @if(Auth::user()->hasPermissionTo('View Dashboard'))
      <div class="col-xl-3 col-md-6">
          <!-- card -->
          <div class="card card-animate bg-user">
              <div class="card-body">
                  <div class="row d-flex align-items-center">
                      <div class="col-4">
                          <img src="{{asset('assets/images/total_users.svg')}}" alt="usericon" >
                      </div>
                      <div class="col-8">
                          <p class="text-uppercase fw-bold text-white text-truncate mb-0">{{__('main.number_of_admin')}}</p>
                          <h4 class="fs-22 fw-bold ff-secondary text-white mb-4"><span class="counter-value" data-target="{{isset($data['adminCount']) ? $data['adminCount'] : 0 }}">{{isset($data['adminCount']) ? $data['adminCount'] : 0 }}</span></h4>
                      </div>
                  </div>
              </div><!-- end card body -->
          </div><!-- end card -->
      </div>
      @endif
  </div>



@endsection
@section('script')
<!-- apexcharts -->
<script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/jsvectormap/jsvectormap.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/swiper/swiper.min.js')}}"></script>
<!-- dashboard init -->
<script src="{{ URL::asset('/assets/js/pages/dashboard-ecommerce.init.js') }}"></script>
@endsection
