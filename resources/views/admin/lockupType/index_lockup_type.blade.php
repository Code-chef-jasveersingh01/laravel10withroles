@extends('layouts.admin.layout')
@section('title')
{{__('main.list_types')}}
@endsection
@section('css')
<!--datatable css-->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />

@endsection
@section('content')
@component('components.breadcrumb')
    @slot('title') {{__('main.lockup_type_list')}} @endslot
    @slot('link') {{ route('admin.indexListType')}} @endslot
@endcomponent
<div class="card shadow mb-4">
    <div class="card-header d-flex align-items-center">
        <h5 class="card-title mb-0 flex-grow-1">{{__('main.list_types')}}</h5>
        <div>
            <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#createLockupModal"><i class="fas fa-plus fa-sm text-white-50"></i> {{__('main.Add_Item')}}</button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-nowrap dt-responsive table-bordered display" width="100%" cellspacing="0" id="listTypes">
                <thead class="">
                    <tr>
                        <th class="text-center" style="width: 25%">{{__('main.title')}}</th>
                        <th class="text-center" style="width: 25%">{{__('main.key')}}</th>
                        <th class="text-center" style="width: 25%">{{__('main.is_active')}}</th>
                        <th class="text-center" style="width: 25%">{{__('main.action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lockupTypes as $key=>$lockupType)
                        <tr class="hover-primary">
                            <td class="text-center">
                               {{$lockupType->name}}
                            </td>
                            <td class="text-center">
                               {{$lockupType->key}}
                            </td>
                            <td class="text-center">
                                @if ($lockupType->is_active)
                                    <div class="badge bg-success text-white rounded-pill">{{__('main.active')}}</div>
                                @else
                                    <div class="badge bg-danger text-white rounded-pill">{{__('main.in-active')}}</div>
                                @endif
                            </td>
                            <td class="text-center">
                                <a class="text-primary d-inline-block m-2" href="{{route('admin.showListType', $lockupType->id)}}"><i class="ri-eye-fill fs-16"></i></a>
                                <a class="text-primary d-inline-block m-2" id="edit-btn" href="javascript:void(0);" data-href="{{route('admin.updateListType', $lockupType->id)}}" data-is-active="{{$lockupType->is_active}}" data-is-system="{{$lockupType->is_system}}" data-name="{{isset($lockupType->name) ? json_encode($lockupType->getTranslations('name')):'' }}"><i class="ri-pencil-fill fs-16"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<x-modal>
    <x-slot name="id">createLockupModal</x-slot>
    <x-slot name="modalSize">modal-m</x-slot>
    <x-slot name="modalTitle">{{__('main.Add_Item')}}</x-slot>
    <x-slot name="modalFormBody">
        <form class="form" method="POST" action="{{route('admin.storeListType')}}" id="createItem">
            @csrf
            <div class="box-body">
                <div class="form-group mb-3">
                    <div class="input-group mb-3 flex-column">
                        <x-create_lang_input>
                            <x-slot name="field_lable">{{__('main.lockup_type_name')}}</x-slot>
                            <x-slot name="field_name">name</x-slot>
                            <x-slot name="field_placeholder">{{__('main.name')}}</x-slot>
                        </x-create_lang_input>
                    </div>
                </div>
                <div class="row form-group form-switch form-check-right">
                    <div class="col-12 mb-3">
                        <input type="checkbox" name="is_active" role="switch" id="md_checkbox_21" class="form-check-input mx-1" checked="">
                        <label for="md_checkbox_21">{{__('main.is_active')}}</label>
                    </div>
                    <div class="col-12">
                        <input type="checkbox" name="is_system" role="switch" id="md_checkbox_21" class="form-check-input mx-1" checked="">
                        <label for="md_checkbox_21">{{__('main.is_system')}}</label>
                    </div>
                </div>
            </div>
        </form>
    </x-slot>
    <x-slot name="modalFormFooter">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{__('main.close')}}</button>
        <button type="submit" class="btn btn-primary float-end" form="createItem">{{__('main.save')}}</button>
    </x-slot>
</x-modal>
<x-modal>
    <x-slot name="id">editLockupModal</x-slot>
    <x-slot name="modalSize">modal-m</x-slot>
    <x-slot name="modalTitle">{{__('main.update_item')}}</x-slot>
    <x-slot name="modalFormBody">
        <form class="form" method="POST" action="" id="lockupEdit">
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <div class="input-group mb-3 flex-column">
                        <label for="edit_name" class="form-label">{{__('main.lockup_type_name')}}
                            [
                            <span href="javascript:void(0)" class="mutli-lang" data-lang-type="en" data-lang-field="edit_name" data-field-type="input" style="color:#38b7fe; cursor: pointer;">{{__('main.english')}}</span>&nbsp;
                            <span href="javascript:void(0)" class="mutli-lang" data-lang-type="ar" data-lang-field="edit_name" data-field-type="input" style=" cursor: pointer;">{{__('main.arabic')}}</span>
                            ]
                        </label>
                        <input type="text" class="form-control w-100" id="edit_name_en" name="edit_name[en]" placeholder="{{__('main.name')}}" required>
                        <input type="text" class="form-control w-100" id="edit_name_ar" name="edit_name[ar]" placeholder="{{__('main.name')}}" style="display: none;">
                    </div>
                </div>
                <div class="row form-group form-switch form-check-right">
                    <div class="col-12 mb-3">
                        <input type="checkbox" name="edit_is_active" id="edit_is_active" role="switch" class="form-check-input mx-1">
                        <label for="md_checkbox_21">{{__('main.is_active')}}</label>
                    </div>
                    <div class="col-12">
                        <input type="checkbox" name="edit_is_system" id="edit_is_system" role="switch" class="form-check-input mx-1">
                        <label for="md_checkbox_21">{{__('main.is_system')}}</label>
                    </div>
                </div>
            </div>
        </form>
    </x-slot>
    <x-slot name="modalFormFooter">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{__('main.close')}}</button>
        <button type="submit" class="btn btn-primary" form="lockupEdit">{{__('main.update')}}</button>
    </x-slot>
</x-modal>
@endsection
@section('script')
@include('layouts.admin.scripts.Datatables_scripts')
<script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#listTypes').DataTable({
            'paging'        : true,
            'lengthChange'  : false,
            'searching'     : false,
            'ordering'      : false,
            'info'          : true,
            'autoWidth'     : false,
            "processing"    : false,
            "serverSide"    : false,
            language: {
                            url: '@if (session()->get('locale') == 'ar') {{asset('js/Arabic.json')}} @elseif(session()->get('locale') == 'fr') {{asset('js/French.json')}} @endif'
                        }
        });
        $('body').on("click", "#edit-btn",function (e) {
            e.preventDefault();
            var href            = $(this).attr('data-href');
            var isActive        = $(this).attr('data-is-active');
            var isSystem        = $(this).attr('data-is-system');
            var name            = JSON.parse($(this).attr('data-name'));

            $("#lockupEdit").attr("action", href);
            $("#edit_name_en").val(name.en);
            $("#edit_name_ar").val(name.ar);

            if(isActive==1){
                $('#edit_is_active').prop('checked', true);
            }
            if(isSystem==1){
                $('#edit_is_system').prop('checked', true);
            }
            $('#editLockupModal').modal('show');
        });
    });
</script>
@endsection
