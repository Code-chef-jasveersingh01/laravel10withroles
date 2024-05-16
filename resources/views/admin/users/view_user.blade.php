@extends('layouts.admin.layout')
@section('title')
    {{ __('main.view_user')}}
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') {{__('main.view')}} @endslot
@slot('title') {{__('main.users')}} @endslot
@slot('link') {{ route('admin.usersList')}} @endslot
@endcomponent
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex align-items-center">
                <h6 class="m-0 font-weight-bold text-primary flex-grow-1">{{__('main.user_details')}}</h6>
                @canany(['Edit User', 'Delete User'])
                <div class="flex-shrink-0">
                  @can("Edit User")
                    <a @if($userDetails['uuid'] === Auth::user()->uuid) href="javascript:void(0)" class="btn btn-disable" @disabled(true) @else class="btn btn-primary edit-item-btn" href="{{route('admin.editUser',['uuid'=>$userDetails['uuid']])}}" @endif ><i class="ri-edit-line fs-16"></i></a>
                  @endcan
                  @can("Delete User")
                    <a href="javascript:void(0)" @if($userDetails['uuid'] === Auth::user()->uuid) class="btn btn-disable" @disabled(true) @else class="btn btn-danger remove-item-btn" data-id="{{$userDetails['uuid']}}" @endif><i class="ri-delete-bin-2-line fs-16"></i></a>
                  @endcan
                </div>
                @endcanany
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <td class="font-bold-600" style="width: 25%;">{{ __('main.full_name') }}</td>
                                <td>{{ $userDetails['full_name'] }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold-600" style="width: 25%;">{{ __('main.email') }}</td>
                                <td>{{ $userDetails['email'] }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold-600" style="width: 25%;">{{ __('main.phone_number') }}</td>
                                <td>{{ $userDetails['phone'] }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold-600" style="width: 25%;">{{ __('main.birthday') }}</td>
                                <td>{{!empty($userDetails['birthdate']) ? date("F jS Y", strtotime($userDetails->birthdate)) : '-'}}</td>
                            </tr>
                            <tr>
                                <td class="font-bold-600" style="width: 25%;">{{ __('main.gender') }}</td>
                                <td>{{ isset($userDetails['genderType']['name']) ? $userDetails->genderType->name : ''}}</td>
                            </tr>
                            <tr>
                                <td class="font-bold-600">{{ __('main.user_type') }}</td>
                                <td>{{ isset($userDetails['userType']['name']) ? $userDetails->userType->name : '' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="font-bold-600">{{ __('main.whatsapp_numer') }}</td>
                                <td>{{ isset($userDetails['whatsApp_number']) ? $userDetails['whatsApp_number'] : '' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{__('main.profile_picture')}}</h6>
            </div>
            <div class="card-body">
                <div class="card-body text-center">
                    <img class="rounded-circle mb-2 avater-ext" src="{{!empty($userDetails['profile_image']) ? $userDetails['profile_image']: asset("assets/images/users/user-dummy-img.jpg")}}" style="height: 10rem;width: 10rem;">
                    <div class="large text-muted mb-4">
                        <span class="badge rounded-pill badge-outline-{{$userDetails['is_active']==1?'success':'danger'}}">
                            {{$userDetails['is_active'] ?  __('main.active')  :  __('main.in_active') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
  <div class="col-8">

  </div>
  <div class="col-lg-4">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{__('main.aggrement_file')}}</h6>
        </div>
        <div class="card-body">
            <div class="card-body text-center">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">S.No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Action </th>

                  </tr>
                </thead>
                <tbody>

                  @foreach ($userDetails['attachment_file'] as $key=>$file)
                    <tr>
                      <th scope="row">{{$key+1}}</th>
                      <td>{{$file['file_name']}}</td>
                      <td>
                        <li class="list-inline-item edit"><a href=" {{$file['download_url']}}" download="{{$file['download_url']}}"  class="text-primary d-inline-block edit-btn"><i class="ri-file-cloud-line fs-16"></i></a></li>

                        <li class="list-inline-item edit"><a href="#"  class="text-primary d-inline-block edit-btn remove-file-btn" data-id="{{$file['id']}}"><i class="ri-delete-bin-3-fill fs-16 " style="color: red;"></i></a></li>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>

              {{-- @if(isset($userDetails->attachment_file['download_url']))
              <a href="{{$userDetails->attachment_file['download_url']}}" download="{{$userDetails->attachment_file['download_url']}}"> <h5>{{isset($userDetails->attachment_file['file_name']) ? $userDetails->attachment_file['file_name'] : ''  }}</h5></a>
              @else
              No file Found
              @endif --}}

                <div class="large text-muted mb-4">
                    <a class="btn btn-info btn-sm d-inline-block aggrementFile" href="javascript:void(0);" data-url='{{route('admin.updateAttachmentFile',['uuid'=>$userDetails['uuid']])}}'>
                      {{__('main.upload')}}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<x-modal>
  <x-slot name="id">aggrementFile</x-slot>
  <x-slot name="modalSize">modal-m</x-slot>
  <x-slot name="modalTitle">{{__('main.upload') ." ". __('main.aggrement_file')}}</x-slot>
  <x-slot name="modalFormBody">
      <form class="form" method="POST" action="" id="aggrementFileForm" enctype="multipart/form-data">
          @csrf
          <div class="box-body">
            <div class="form-group mb-3">
              <label>Date</label>
              <input type="month" class="form-control" name="date" >
            </div>
              <div class="form-group mb-3">
                <label>Files</label>
                <input type="file" name="file[]" class="form-control" id="customFile" multiple accept=".jpg,.jpeg,.bmp,.png,.gif,.doc,.docx,.csv,.rtf,.xlsx,.xls,.txt,.pdf,.zip" required >
              </div>
          </div>
      </form>
  </x-slot>
  <x-slot name="modalFormFooter">
      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{__('main.close')}}</button>
      <button type="submit" class="btn btn-primary" form="aggrementFileForm">{{__('main.update')}}</button>
  </x-slot>
</x-modal>
@endsection
@section('script')
<script>
$(document).ready(function () {
    $('.dropify').dropify();
});
</script>
<script>
    $(document).ready(function() {

        $('body').on("click", ".aggrementFile",function (e) {
          e.preventDefault();
          var href       = $(this).attr('data-url');

          $("#aggrementFileForm").attr("action", href);

          $('#aggrementFile').modal('show');
        });


        $('body').on('click','.remove-item-btn',function(e) {
        e.preventDefault();
         var id = $(this).data("id");
          swal({
              title: "Are you sure?",
              text: "Once deleted, you will not be able to recover this user!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
              })
              .then((willDelete) => {
              if (willDelete) {
                  var data = {
                  "_token": $('a[name="csrf-token"]').val(),
                  "id": id,
                  }

                  $.ajax({
                  type: "DELETE",
                  url: "{{ route('admin.destroyUser', '') }}" + "/" + id,
                  data: data,
                  success: function(response) {
                      swal(response.status, {
                          icon: "success",
                          timer: 3000,
                      })
                      .then((result) => {
                          window.location =
                          '{{ route('admin.usersList') }}'
                      });
                  }
                  });
              }
              });
        });



        @can("Delete User")

        $('body').on('click','.remove-file-btn',function(e) {
          e.preventDefault();
         var id = $(this).attr("data-id");
          swal({
              title: "Are you sure?",
              text: "Once deleted, you will not be able to recover this file!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
              })
              .then((willDelete) => {
              if (willDelete) {
                  var data = {
                  "_token": $('a[name="csrf-token"]').val(),
                  "id": id,
                  }
                  $.ajax({
                  type: "DELETE",
                  url: "{{ route('admin.destroyFile', '') }}" + "/" + id,
                  data: data,
                  success: function(response) {
                      swal(response.status, {
                          icon: "success",
                          timer: 3000,
                      })
                      .then((result) => {
                        location.reload();

                      });
                  }
                  });
              }
              });
        });
        @endcan
    });
</script>
@endsection
