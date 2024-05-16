@extends('layouts.admin.layout')
@section('title')
{{__('main.users')}}
@endsection
@section('css')
<link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/swiper/swiper.min.css') }}" rel="stylesheet" type="text/css" />
<!--datatable css-->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet"
  type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href={{asset("assets/css/dropify.css")}}>
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') {{__('main.index')}} @endslot
@slot('title') {{__('main.users')}} @endslot
@slot('link') {{ route('admin.usersList')}} @endslot
@endcomponent
<x-list_view>
  <x-slot name="card_style"> 1 </x-slot>
  <x-slot name="card_body_style"> 1 </x-slot>
  <x-slot name="card_heard"> {{__('main.all_users')}} </x-slot>
  <x-slot name="search_label">
    <div class="row g-3">
      <div class="col-xxl-5 col-sm-4">
        <div class="search-box">
          <input type="text" name="filter_search_key" id="filter_search_key" class="form-control search"
            placeholder="{{__('main.search')}}">
          <i class="ri-search-line search-icon"></i>
        </div>
      </div>
      <!--end col-->
      <div class="col-xxl-2 col-sm-4">
        <div class="form-group">
          <select class="form-control" name="filter_status" id="filter_status">
            <option value="all">{{__('main.all')}}</option>
            <option value="1">{{__('main.active')}}</option>
            <option value="0">{{__('main.in_active')}}</option>
          </select>
        </div>
      </div>
      <!--end col-->
      <div class="col-xxl-5 col-sm-4">
        <div class="d-flex">
          <button type="button" id="search_filter" class="btn btn-primary w-100 mx-1"><i
              class=" ri-search-line me-1 align-bottom"></i> {{__('main.search')}}</button>
          <button type="button" id="reset_filter" class="btn btn-success w-100 mx-1"><i
              class="ri-refresh-line me-1 align-bottom"></i> {{__('main.reset')}}</button>
          @can('Export Users')
          <a class="btn btn-success w-100 mx-1" href="{{ route('admin.exportUsers') }}">{{ __('main.export_users')
            }}</a>
          @endcan
          @can('Delete User')
          <button type="button" id="delete-selected-rows" class="btn btn-danger w-100 mx-1"><i
              class="ri-delete-bin-5-fill fs-16 align-bottom"></i> {{__('main.delete')}}</button>
          @endcan
          {{-- <a class="btn btn-danger w-100 mx-1" id="deleteUserDate" data-toggle="modal"
            data-target="#createTagsModal">Delete Users</a> --}}
        </div>
      </div>
      <!--end col-->
    </div>
  </x-slot>
  <x-slot name="table_id"> usersTable </x-slot>
  <x-slot name="table_th">
    {{-- <th><a class="text-danger d-inline-block" id="delete-selected-rows"><i
          class="ri-delete-bin-5-fill fs-16"></i></a></th> --}}
    <th><input type="checkbox" class="check-all" data-id="${row.id}"></th>
    <th>{{ __('main.image') }}</th>
    <th>{{ __('main.date') }}</th>
    <th>{{ __('main.uplode_Date') }}</th>

    <th>{{ __('main.DR_ID') }}</th>
    <th>{{ __('main.DEPARTMENT_NAME') }}</th>
    <th>{{ __('main.fullname') }} </th>
    <th>{{ __('main.email') }}</th>
    <th>{{ __('main.phone') }}</th>

    <th>{{ __('main.status') }}</th>
    <th>{{ __('main.user_type') }}</th>
    @canany(['View User Details', 'Edit User', 'Delete User'])
    <th>{{ __('main.action') }}</th>
    @endcanany
    {{-- <th>{{ __('main.chat') }}</th> --}}

  </x-slot>
</x-list_view>

@endsection
@section('script')
@include('layouts.admin.scripts.Datatables_scripts')

<script>
  $(document).ready(function () {
        $('#usersTable').DataTable({
            'paging'        : true,
            'lengthChange'  : false,
            'searching'     : false,
            'ordering'      : true,
            'info'          : true,
            'autoWidth'     : false,
            "processing"    : true,
            "serverSide"    : true,
            "scrollX": true,
            "ajax"          : {
                                "url": "{!! route('dataTable.dataTableUsersListTable') !!}",
                                "type": "GET",
                                "data": function ( d ) {
                                        d.filterSearchKey = $("#filter_search_key").val();
                                        d.filterStatus = $("#filter_status").val();
                                        d.filterUserType = $("#filter_user_type").val();
                                }
                            },
            "columns"       : [
                                {   "data": "uuid",
                                    "render": function ( data, type, row ) {
                                      return `<input type="checkbox" class="multi-remove-btn" data-id="${row.id}">`;
                                    },
                                },
                                {   "data": "uuid",
                                    "render": function ( data, type, row ) {
                                        return (row.profile_image !== "") ? '<img src="'+row.profile_image+'" alt="'+row.profile_image+'" class="img-fluid d-block">' : '';
                                    },
                                },
                                {   "data": "form_date",
                                    "render": function ( data, type, row ) {

                                        return row.form_date;
                                    },
                                },
                                 {   "data": "updated_at",
                                    "render": function ( data, type, row ) {

                                        var date = new Date(row.updated_at);
                                        var month = date.getMonth() + 1;
                                        return date.getFullYear()+ "-"+ (month.toString().length > 1 ? month : "0" + month) +'-'+ date.getDate();


                                        // return row.created_at  ;
                                    },
                                },
                                {   "data": "DR_ID",
                                    "render": function ( data, type, row ) {
                                        return row.DR_ID;
                                    },
                                },
                                {   "data": "DEPARTMENTNAME",
                                    "render": function ( data, type, row ) {
                                        return data;
                                    },
                                },

                                // {   "data": "email",
                                //     "render": function ( data, type, row ) {
                                //         if(row.name && row.email){
                                //             var name = row.name + ' ' + row.email;
                                //             return name;
                                //         }else{
                                //             return ;
                                //         }

                                //     },
                                // },
                                {   "data": "full_name" },

                                {   "data": "email" },
                                {   "data": "phone" },


                                {   "data": "is_active",
                                    "render": function ( data, type, row ) {
                                        if(data == 1){
                                            return '<span class="badge badge-soft-success text-uppercase">Active</span>';
                                        }else{
                                            return '<span class="badge badge-soft-danger text-uppercase">Not Active</span>';
                                        }
                                    },
                                },
                                {   "data": "name",
                                    "render": function ( data, type, row ) {
                                        @if (session()->get('locale') == 'ar')
                                            return '<div class="badge bg-info text-white rounded-pill">'+row.user_type.name.ar+'</div>';
                                        @elseif(session()->get('locale') == 'fr')
                                            return '<div class="badge bg-info text-white rounded-pill">'+row.user_type.name.fr+'</div>';
                                        @else
                                            return '<div class="badge bg-info text-white rounded-pill">'+row.user_type.name.en+'</div>';
                                        @endif
                                    },
                                },
                                @canany(['View User Details', 'Edit User', 'Delete User'])
                                {   "data": "uuid",
                                    "render": function ( data, type, row ) {
                                        return '@can("View User Details") <li class="list-inline-item edit"><a href="{{route("admin.viewUser","")}}/'+row.uuid+'" data-id="'+row.uuid+'" class="text-primary d-inline-block edit-btn"><i class="ri-eye-fill fs-16"></i></a></li> @endcan @can("Edit User") <li class="list-inline-item edit"><a href="{{route("admin.editUser","")}}/'+row.uuid+'" data-id="'+row.uuid+'" class="text-primary d-inline-block edit-btn"><i class="ri-pencil-fill fs-16"></i></a></li> @endcan @can("Delete User") <li class="list-inline-item"><a class="text-danger d-inline-block remove-item-btn"  data-id="'+row.id+'" href="javascript:void(0);" data-href="{{ route("admin.viewUser","") }}/' + row.uuid + '" title="{{ __('main.delete') }}"><i class="ri-delete-bin-5-fill fs-16"></i></a></li> @endcan';
                                    },
                                },
                                @endcanany
                            ],
            'columnDefs': [
                            {
                                    "targets": 0,
                                    "className": "text-center",
                                    "orderable": false,
                                    "width":"4%"
                            },
                            {
                                    "targets": 1,
                                    "className": "text-center avatar-sm bg-light rounded p-1",
                            },
                            {
                                    "targets": 2,
                                    "className": "text-center",
                            },
                            {
                                    "targets": 3,
                                    "className": "text-center",
                                    // "width": "15%"
                            },
                            {
                                    "targets": 4,
                                    "className": "text-center",
                                    // "width": "15%"
                            },
                            {
                                    "targets": 5,
                                    "className": "text-center",
                                    // "width": "15%"
                            },
                            {
                                    "targets": 6,
                                    "className": "text-center",
                                    // "width": "15%"
                            },
                            {
                                    "targets": 7,
                                    "className": "text-center",
                                    // "width": "15%"
                            },
                            {
                                    "targets": 8,
                                    "className": "text-center",
                                    // "width": "15%"
                            },
                            {
                                    "targets": 9,
                                    "className": "text-center",
                                    // "width": "15%"
                            },
                            {
                                    "targets": 10,
                                    "className": "text-center",
                                    // "width": "15%"
                            },
                            @canany(['View User Details', 'Edit User', 'Delete User'])
                            {
                                    "targets": 11,
                                    "className": "text-center",
                                    // "width": "15%"
                            },
                            @endcanany

                        ],
            language: {
                            url: '@if (session()->get('locale') == 'ar') {{asset('js/Arabic.json')}} @elseif(session()->get('locale') == 'fr') {{asset('js/French.json')}} @endif'
                        }
        });
    });

    $("#search_filter").click(function (e) {
        e.preventDefault();
        $('#usersTable').DataTable().ajax.reload();
    });

    $("#reset_filter").click(function (e) {
        e.preventDefault();
        $('#filter_search_key').val('');
        $('#filter_status').prop('selectedIndex',0);
        $('#filter_user_type').prop('selectedIndex',0);
        $('#usersTable').DataTable().ajax.reload();
    });

    @can('Delete User')

    $('body').on('click','.remove-item-btn',function(e) {
        e.preventDefault();
        var id = $(this).data("id");
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this User!",
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

    // $('body').on('change','.check-all',function(e) {
    //     e.preventDefault();
    //     var is_checked = $(this).prop('checked');

    //     if(is_checked) {
    //       swal({
    //         title: "Are you sure you want to check all?",
    //        // text: "Once deleted, you will not be able to recover this User!",
    //         icon: "warning",
    //         buttons: true,
    //         dangerMode: true,
    //         })
    //         .then((willDelete) => {
    //         if (willDelete) {
    //           $('.multi-remove-btn').prop('checked', is_checked);
    //         }
    //         });
    //     }else{
    //       $('.multi-remove-btn').prop('checked', is_checked);
    //     }

    // });


    $(document).ready(function() {
        $(".check-all").click(function() {
            var checkBoxes = $(".multi-remove-btn");
            console.log('checkBoxes',checkBoxes);
            checkBoxes.prop("checked", !checkBoxes.prop("checked"));
        });
    });

    @if (Auth::user()->getRoleNames()[0] == 'Super Admin')

    $('body').on('click', '#delete-selected-rows', function(e) {
        e.preventDefault();

        var selectedIds = [];

        $('input[type="checkbox"].multi-remove-btn:checked').each(function() {
            selectedIds.push($(this).data("id"));
        });

        if (selectedIds.length > 0) {
          var data = {
                        "_token": $('a[name="csrf-token"]').val(),
                        "ids": selectedIds,
                    };
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.destroyMultiUser') }}",
                        data: data,
                        success: function(response) {
                          var icons = response.status == '1' ? 'success' : 'error';
                            swal(response.message, {
                                icon: icons,
                                timer: 3000,
                            }).then((result) => {
                                // Reload the page after successful deletion
                                window.location.href = '{{ route('admin.usersList') }}';
                            });
                        }
                    });
        } else {
          swal({
                title: "Select the users!",
                icon: "warning",
                dangerMode: true,
            });
        }
    });

    @else

    $('body').on('click', '#delete-selected-rows,#adminselect', function(e) {
        e.preventDefault();
        $('#show-admin-list').modal('show');
    });

    $('body').on('click', '#send-request', function(e) {
        e.preventDefault();


        if ( $(".super-admin-select option:selected").val() === "" )
        {
          swal({
                title: "{{__('main.reviewer_select')}}",
                icon: "warning",
                dangerMode: true,
            });
          return false;
        }

        let superAdminId = $('.super-admin-select').val();

        var selectedIds = [];

        $('input[type="checkbox"].multi-remove-btn:checked').each(function() {
            selectedIds.push($(this).data("id"));
        });

        if (selectedIds.length > 0) {
          var data = {
                        "_token": $('a[name="csrf-token"]').val(),
                        "ids": selectedIds,
                        "superAdminId":superAdminId
                    };
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.destroyMultiUser') }}",
                        data: data,
                        success: function(response) {
                          var icons = response.status == '1' ? 'success' : 'error';
                            swal(response.message, {
                                icon: icons,
                                timer: 3000,
                            }).then((result) => {
                                // Reload the page after successful deletion
                                window.location.href = '{{ route('admin.usersList') }}';
                            });
                        }
                    });
        } else {
          swal({
                title: "Select the users!",
                icon: "warning",
                dangerMode: true,
            });
        }
    });

    @endif

    // $('#deleteUserDate').click(function(){
    //   $('#createTagsModal').modal('show')

    // });

    // $('.close').click(function(){
    //   $('#createTagsModal').modal('hide')
    // });

    $('.close').click(function(){
      $('#show-admin-list').modal('hide');
    })
    @endcan
</script>
@endsection
