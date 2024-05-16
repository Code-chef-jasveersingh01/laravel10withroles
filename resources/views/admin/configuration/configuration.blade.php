@extends('layouts.admin.layout')
@section('title')
    {{ __('main.configuration')}}
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/swiper/swiper.min.css') }}" rel="stylesheet" type="text/css" />
    <!--datatable css-->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <!--datatable responsive css-->
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href={{asset("assets/css/dropify.css")}}>
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') {{__('main.index')}} @endslot
@slot('title') {{__('main.configuration')}} @endslot
@slot('link') {{route('admin.indexConfiguration')}} @endslot
@endcomponent
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1">{{__("main.configuration")}}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="nav flex-column nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                          @can("View Admin Contact")
                            <a class="nav-link mb-2 active" id="admin-contact-tab" data-bs-toggle="pill" href="#admin-contact" role="tab" aria-controls="admin-contact" aria-selected="true">{{__('main.admin_contact')}}</a>
                          @endcan
                          @can("View Delete Limit")
                            <a class="nav-link mb-2" id="delete-limit-tab" data-bs-toggle="pill" href="#delete-limit" role="tab" aria-controls="delete-limit" aria-selected="true">{{__('main.delete_limit')}}</a>
                          @endcan
                        </div>
                    </div><!-- end col -->
                    <div class="col-md-9">
                        <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                          @can('View Admin Contact')
                          <div class="tab-pane fade show active" id="admin-contact" role="tabpanel" aria-labelledby="admin-contact-tab">
                              <div class="d-flex flex-column mb-2">
                              <div class="box-header with-border">
                                  <h4 class="box-title text-primary"><strong>{{ __('main.admin_contact') }}</strong></h4>
                                </div>
                                <div class="box-body">
                                  <form class="form" method="POST" action="{{ route('admin.adminContact') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row gx-3 mb-3">
                                      <div class="col-md-6">
                                        <label class="small mb-1" for="phone">{{__('main.phone')}}</label>
                                        <input type="number" class="form-control" name="phone" @if(isset($data['adminContact']->data->phone) && !empty($data['adminContact']->data->phone)) value='{{$data['adminContact']->data->phone}}' @endif />
                                      </div>
                                    </div>
                                    <div class="row gx-3 mb-3">
                                      <div class="col-md-6">
                                        <label class="small mb-1" for="email">{{__('main.email')}}</label>
                                        <input type="email" class="form-control" name="email" @if(isset($data['adminContact']->data->email) && !empty($data['adminContact']->data->email)) value='{{$data['adminContact']->data->email}}' @endif />
                                      </div>
                                    </div>
                                    @can('Edit Admin Contact')
                                      <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">
                                          <i class="ti-save-alt"></i>{{ __('main.save_changes') }}
                                        </button>
                                      </div>
                                    @endcan
                                  </form>
                                </div>
                              </div>
                          </div>
                          @endcan
                          @can("View Delete Limit")
                          <div class="tab-pane fade" id="delete-limit" role="tabpanel" aria-labelledby="delete-limit-tab">
                            <div class="d-flex flex-column mb-2">
                            <div class="box-header with-border">
                                <h4 class="box-title text-primary"><strong>{{ __('main.delete_limit') }}</strong></h4>
                              </div>
                              <div class="box-body">
                                <form class="form" id="deleteLimitForm" method="POST" action="{{ route('admin.deleteLimit') }}" enctype="multipart/form-data">
                                  @csrf
                                  <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                      <label class="small mb-1" for="delete_limit">{{__('main.delete_limit')}}</label>
                                      <input type="number" class="form-control" name="delete_limit" @if(isset($data['deleteLimit']->data->delete_limit) && !empty($data['deleteLimit']->data->delete_limit)) value='{{$data['deleteLimit']->data->delete_limit}}' @endif />
                                    </div>
                                  </div>
                                  @can('Edit Delete Limit')
                                    <div class="box-footer">
                                      <button type="submit" class="btn btn-primary" form="deleteLimitForm">
                                        <i class="ti-save-alt"></i>{{ __('main.save_changes') }}
                                      </button>
                                    </div>
                                  @endcan
                                </form>
                              </div>
                            </div>
                          </div>
                          @endcan
                        </div>
                    </div><!--  end col -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
