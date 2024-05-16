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
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href={{asset("assets/css/dropify.css")}}>
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') {{__('main.index')}} @endslot
@slot('title') {{__('main.activity')}} @endslot
@slot('link') {{ route('admin.auditLogs')}} @endslot
@endcomponent
    <x-list_view>
        <x-slot name="card_style"> 1 </x-slot>
        <x-slot name="card_body_style"> 1 </x-slot>
        <x-slot name="card_heard"> {{__('main.activity')}} </x-slot>
        <x-slot name="search_label">
            <div class="row g-3">
                <div class="col-xxl-7 col-sm-6">
                    <div class="search-box">
                        <input type="text" name="filter_search_key" id="filter_search_key" class="form-control search" placeholder="{{__('main.action_placeholder')}}">
                        <i class="ri-search-line search-icon"></i>
                    </div>
                </div>
                <div class="col-xxl-5 col-sm-6">
                    <div class="d-flex">
                        <button type="button" id="search_filter" class="btn btn-primary w-100 mx-1" ><i class=" ri-search-line me-1 align-bottom"></i> {{__('main.search')}}</button>
                        <button type="button" id="reset_filter" class="btn btn-success w-100 mx-1"><i class="ri-refresh-line me-1 align-bottom"></i> {{__('main.reset')}}</button>

                    </div>
                </div>
            </div>
     </x-slot>
        <x-slot name="table_id"> activityTable </x-slot>
        <x-slot name="table_th">


          <th>{{ __('main.fullname') }} </th>
          <th>{{ __('main.email') }}</th>
          <th>{{ __('main.event') }}</th>
          <th>{{ __('main.auditable_id') }}</th>
          <th>{{ __('main.created_at') }}</th>

        </x-slot>
    </x-list_view>
@endsection
@section('script')
@include('layouts.admin.scripts.Datatables_scripts')

<script>
    $(document).ready(function () {
        $('#activityTable').DataTable({
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
                                "url": "{!! route('dataTable.dataTableActivityListTable') !!}",
                                "type": "GET",
                                "data": function ( d ) {
                                        d.filterSearchKey = $("#filter_search_key").val();
                                        d.filterStatus = $("#filter_status").val();
                                        d.filterUserType = $("#filter_user_type").val();
                                }
                            },
            "columns"       : [
                                {   "data": "user_name" },
                                {   "data": "user_email" },
                                {   "data": "event"},
                                {   "data": "auditable_id" },
                                {   "data": "created_at",
                                    "render": function ( data, type, row ) {
                                        var date = new Date(row.updated_at);
                                        var month = date.getMonth() + 1;
                                        return date.getFullYear()+ "-"+ (month.toString().length > 1 ? month : "0" + month) +'-'+ date.getDate();
                                    },
                                },

                            ],
            'columnDefs': [
                            {
                                    "targets": 0,
                                    "className": "text-center",
                            },
                            {
                                    "targets": 1,
                                    "className": "text-center ",
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
</script>
@endsection
