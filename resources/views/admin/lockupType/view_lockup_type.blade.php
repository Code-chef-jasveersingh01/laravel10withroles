@extends('layouts.admin.layout')
@section('title')
{{__('main.list_type_detail')}}
@endsection
@section('content')
@component('components.breadcrumb')
    @slot('title') {{__('main.lockup_type_list')}} @endslot
    @slot('li_1') {{__('main.lockup_list')}} @endslot
    @slot('link') {{ route('admin.indexListType')}} @endslot
@endcomponent
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                {{__('main.list_type_detail')}}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <td class="font-bold-600" style="width: 25%;">{{__('main.title')}}</td>
                                <td> {{$lockupType->name}} </td>
                            </tr>
                            <tr>
                                <td class="font-bold-600" style="width: 25%;">{{__('main.active')}}</td>
                                <td>
                                    @if ($lockupType->is_active)
                                        <div class="badge bg-success text-white rounded-pill">{{__('main.active')}}</div>
                                    @else
                                        <div class="badge bg-danger text-white rounded-pill">{{__('main.de-active')}}</div>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1">{{__('main.list_items')}}</h5>
                <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#createLockupModal"><i class="fas fa-plus fa-sm text-white-50"></i> {{__('main.add_item')}}</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="listItem">
                        <thead>
                            <tr>
                                <th style="width: 50%">{{__('main.name')}}</th>
                                <th class="text-center" style="width: 25%">{{__('main.is_active')}}</th>
                                <th class="text-center" style="width: 25%">{{__('main.action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($lockupType->lockup) && count($lockupType->lockup))
                                @foreach ($lockupType->lockup as $key=>$lockup)
                                    <tr class="hover-primary">
                                        <td>{{$lockup->name}}</td>
                                        <td class="text-center">
                                            @if ($lockup->is_active)
                                                <div class="badge bg-success text-white rounded-pill">{{__('main.active')}}</div>
                                            @else
                                                <div class="badge bg-danger text-white rounded-pill">{{__('main.de-active')}}</div>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a class="text-primary d-inline-block edit-btn" href="javascript:void(0);" data-href="{{route('admin.updateListItem', $lockup->id)}}" data-is-active="{{$lockup->is_active}}" data-lockup-type-id="{{$lockup->lockup_type_id}}" data-name="{{isset($lockup->name) ? json_encode($lockup->getTranslations('name')): null }}" data-other="{{isset($lockup->other) ? json_encode($lockup->getTranslations('other')):null}}"><i class="ri-eye-fill fs-16"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<x-modal>
    <x-slot name="id">createLockupModal</x-slot>
    <x-slot name="modalSize">modal-m</x-slot>
    <x-slot name="modalTitle">{{__('main.Add_Item')}}</x-slot>
    <x-slot name="modalFormBody">
        <form class="form" method="POST" action="{{route('admin.storeListItem')}}" id="createItem">
            @csrf
            <input type="hidden" name="lockup_type_id" value="{{$lockupType->id}}">
            <div class="box-body">
                <div class="form-group mb-3">
                    <div class="input-group mb-3 flex-column">
                        <x-create_lang_input>
                            <x-slot name="field_lable">{{__('main.name')}}</x-slot>
                            <x-slot name="field_name">name</x-slot>
                            <x-slot name="field_placeholder">{{__('main.name')}}</x-slot>
                        </x-create_lang_input>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <x-create_lang_input>
                        <x-slot name="field_lable">{{__('main.other')}} <span class="form-text-ext text-muted"><code>{{__('main.optional')}}</code></span></x-slot>
                        <x-slot name="field_name">other</x-slot>
                        <x-slot name="required_false">false</x-slot>
                        <x-slot name="field_placeholder">{{__('main.other')}}</x-slot>
                    </x-create_lang_input>
                </div>
                <div class="row form-group form-switch form-check-right">
                    <div class="col-12 mb-3">
                        <input type="checkbox" name="is_active" role="switch" id="md_checkbox_21" class="form-check-input mx-1" checked="">
                        <label for="md_checkbox_21">{{__('main.is_active')}}</label>
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
                <div class="form-group mb-3">
                    <div class="input-group mb-3 flex-column">
                        <label for="edit_name" class="form-label">{{__('main.name')}}
                            [
                            <span href="javascript:void(0)" class="mutli-lang" data-lang-type="en" data-lang-field="edit_name" data-field-type="input" style="@if(app()->getLocale() == 'en') color:#38b7fe; cursor: pointer; @else cursor: pointer; @endif">{{__('main.english')}}</span>&nbsp;
                            <span href="javascript:void(0)" class="mutli-lang" data-lang-type="ar" data-lang-field="edit_name" data-field-type="input" style="@if(app()->getLocale() == 'ar') color:#38b7fe; cursor: pointer; @else cursor: pointer; @endif">{{__('main.arabic')}}</span>
                            ]
                        </label>
                        <input type="text" class="form-control w-100" id="edit_name_en" name="edit_name[en]" placeholder="{{__('main.name')}}" style="@if(app()->getLocale() == 'en') display: block; @else display: none; @endif" required>
                        <input type="text" class="form-control w-100" id="edit_name_ar" name="edit_name[ar]" placeholder="{{__('main.name')}}" style="@if(app()->getLocale() == 'ar') display: block; @else display: none; @endif">
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="input-group mb-3 flex-column">
                        <label for="edit_name" class="form-label">{{__('main.other')}} <span class="form-text-ext text-muted"><code>({{__('main.optional')}})</code></span>
                            [
                            <span href="javascript:void(0)" class="mutli-lang" data-lang-type="en" data-lang-field="edit_other" data-field-type="input" style="@if(app()->getLocale() == 'en') color:#38b7fe; cursor: pointer; @else cursor: pointer; @endif">{{__('main.english')}}</span>&nbsp;
                            <span href="javascript:void(0)" class="mutli-lang" data-lang-type="ar" data-lang-field="edit_other" data-field-type="input" style="@if(app()->getLocale() == 'ar') color:#38b7fe; cursor: pointer; @else cursor: pointer; @endif">{{__('main.arabic')}}</span>
                            ]
                        </label>
                        <input type="text" class="form-control w-100" id="edit_other_en" name="edit_other[en]" placeholder="{{__('main.other')}}" style="@if(app()->getLocale() == 'en') display: block; @else display: none; @endif">
                        <input type="text" class="form-control w-100" id="edit_other_ar" name="edit_other[ar]" placeholder="{{__('main.other')}}" style="@if(app()->getLocale() == 'ar') display: block; @else display: none; @endif">
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
<script>
$(document).ready(function () {
    $('#listItem').DataTable({
        'paging'        : true,
        'lengthChange'  : false,
        'searching'     : false,
        'ordering'      : true,
        'info'          : true,
        'autoWidth'     : false,
        "processing"    : false,
        "serverSide"    : false,
        language: {
                        url: '@if (session()->get('locale') == 'ar') {{asset('js/Arabic.json')}} @elseif(session()->get('locale') == 'fr') {{asset('js/French.json')}} @endif'
                    }
    });

    $(".edit-btn").click(function (e) {
        e.preventDefault();
        var href            = $(this).attr('data-href');
        var lockupTypeId    = $(this).attr('data-lockup-type-id');
        var isActive        = $(this).attr('data-is-active');
        var name            = ($(this).attr('data-name') !== '' && $(this).attr('data-name') !== null) ? JSON.parse($(this).attr('data-name')) : '{"en":"","ar":""}';
        var other_data      = ($(this).attr('data-other') !== '' && $(this).attr('data-other') !== null) ? JSON.parse($(this).attr('data-other')) : '{"en":"","ar":""}';

        $("#lockupEdit").attr("action", href);
        $("#edit_lockup_type_id").val(lockupTypeId);
        $("#edit_name_en").val(name.en);
        $("#edit_name_ar").val(name.ar);
        $("#edit_other_en").val(other_data.en);
        $("#edit_other_ar").val(other_data.ar);

        if(isActive==1){
            $('#edit_is_active').prop('checked', true);
        }
        $('#editLockupModal').modal('show');
    });

    // $(".delete-item").click(function (e) {
    //     e.preventDefault();
    //     var href = $(this).attr('data-lockup-href');
    //     swal({
    //         title: "{{__('message.are_you_sure')}}",
    //         text: "{{__('message.you_will_not_be_able_to_recover_data')}}",
    //         type: "warning",
    //         showCancelButton: true,
    //         confirmButtonColor: "#3246D3",
    //         confirmButtonText: "{{__('message.delete_it')}}",
    //         closeOnConfirm: false
    //     }, function(){
    //         $("#deleteLockupForm").attr("action", href);
    //         $('#deleteLockupForm').submit();
    //     });
    // });
});
</script>

@endsection
