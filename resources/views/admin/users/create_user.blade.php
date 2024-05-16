@extends('layouts.admin.layout')
@section('title')
    {{ __('main.create_user')}}
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') {{__('main.create')}} @endslot
@slot('title') {{__('main.users')}} @endslot
@slot('link') {{ route('admin.usersList')}} @endslot
@endcomponent
<form method="POST" action="{{route('admin.storeUser')}}" enctype="multipart/form-data">
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="row card-header py-3 d-flex align-items-center" style="background: none">
                <h6 class="col-10 m-0 font-weight-bold text-primary flex-grow-1">{{__('main.user_details')}}</h6>
                <div class="col-2 form-check form-switch form-check-right flex-shrink-0">
                    <input class="form-check-input mx-1" name="is_active" type="checkbox" role="switch" id="is_active" >
                    <label class="form-check-label mx-1" for="is_active">{{__('main.is_active')}}</label>
                </div>
            </div>
            <div class="card-body">
                    @csrf
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="full_name">{{__('main.full_name')}}</label>
                            <input class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" type="text" placeholder="{{__('main.Enter your full name')}}"  required autofocus>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="email">{{__('main.email')}}</label>
                            <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email" placeholder="{{__('main.Enter email adderss')}}">
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="password">{{__('main.password')}}</label>
                            <input class="form-control" id="password" name="password" type="password" placeholder="{{__('main.enter_password')}}" required autofocus>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="password_confirmation">{{__('main.retype_password')}}</label>
                            <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" placeholder="{{__('main.retype_password')}}" required autofocus>
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="phone">{{__('main.phone_number')}}</label>
                            <input class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" type="tel" placeholder="{{__('main.Enter your phone number')}}"  required autofocus>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="birthdate">{{__('main.birthday')}}</label>
                            <input class="form-control @error('birthdate') is-invalid @enderror" id="birthdate" name="birthdate" type="date" max="{{date("Y-m-d")}}" placeholder="{{__('main.Enter your birthday')}}"  required autofocus>
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1">{{__('main.gender')}}</label>
                            <select class="form-control @error('gender_type') is-invalid @enderror" name="gender_type">
                                @php
                                    $genders = \App\Models\Lockup::getByTypeKey('genderType');
                                @endphp
                                @foreach ($genders as $key=>$gender)
                                    <option value="{{$key}}" {{isset($userDetails->gender_type) && $userDetails->gender_type == $key? 'selected':''}}>{{$gender}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1">{{__('main.user_type')}}</label>
                            <select class="form-control @error('user_type') is-invalid @enderror" name="user_type">
                                @if (count($userTypes))
                                @foreach ($userTypes as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            @endif
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">{{__('main.save_changes')}}</button>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{__('main.user_profile_picture')}}</h6>
            </div>
            <div class="card-body">
                <div class="card-body text-center">
                    <input class="dropify" id="formFile" name="image" type="file" accept="image/png, image/jpeg, image/jpg">
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection
@section('script')
<script src={{asset("assets/js/pages/dropify.min.js")}}></script>
<script>
    $(document).ready(function () {
        $('.dropify').dropify();
    });
</script>
@endsection
