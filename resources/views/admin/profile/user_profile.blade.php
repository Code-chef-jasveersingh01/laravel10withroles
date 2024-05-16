@extends('layouts.admin.layout')
@section('title')
    {{ __('main.profile') }}
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            {{ __('main.profile') }}
        @endslot
        @slot('link')
            {{ route('admin.profile') }}
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('main.user_details') }}</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.updateProfile') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="full_name">{{ __('main.full_name') }}</label>
                                <input class="form-control @error('full_name') is-invalid @enderror" id="full_name"
                                    name="full_name" type="text" placeholder="{{ __('main.Enter your full name') }}"
                                    value="{{ Auth::user()->full_name }}" required autofocus>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="email">{{ __('main.email') }}</label>
                                <input class="form-control @error('email') is-invalid @enderror" id="email"
                                    name="email" type="email" placeholder="{{ __('main.Enter email adderss') }} "
                                    value="{{ Auth::user()->email }}" readonly>
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="phone">{{ __('main.phone_number') }}</label>
                                <input class="form-control @error('phone') is-invalid @enderror" id="phone"
                                    name="phone" type="tel" placeholder="{{ __('main.Enter your phone number') }}"
                                    value="{{ Auth::user()->phone }}" required autofocus>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1">{{ __('main.gender') }}</label>
                                <select class="form-control @error('gender_type') is-invalid @enderror" name="gender_type">
                                    @php
                                        $genders = \App\Models\Lockup::getByTypeKey('genderType');
                                    @endphp
                                    @foreach ($genders as $key => $gender)
                                        <option value="{{ $key }}"
                                            {{ isset(Auth::user()->gender_type) && Auth::user()->gender_type == $key ? 'selected' : '' }}>
                                            {{ $gender }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="phone">{{ __('main.whatsappnumber') }}</label>
                                <input class="form-control @error('phone') is-invalid @enderror" id="whatsappnumber"
                                    name="whatsappnumber" type="tel"
                                    placeholder="{{ __('main.Enter your WhatsApp phone number') }}"
                                    value="{{ Auth::user()->whatsApp_number }}" autofocus>
                            </div>

                        </div>
                        <button class="btn btn-primary" type="submit">{{ __('main.save_changes') }}</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('main.profile_picture') }}</h6>
                </div>
                <div class="card-body">
                    <div class="card-body text-center">
                        <img class="rounded-circle mb-2 avater-ext"
                            src="{{ !empty(Auth::user()->profile_image) ? Auth::user()->profile_image : asset('assets/images/users/user-dummy-img.jpg') }}"
                            style="height: 10rem;width: 10rem;">
                        <div class="large text-muted mb-4">
                            <span class="badge badge-pill badge-{{ Auth::user()->is_active == 1 ? 'success' : 'danger' }}">
                                {{ Auth::user()->is_active ? __('main.active') : __('main.in_active') }}
                            </span>
                        </div>
                        <button class="btn btn-soft-primary" data-bs-toggle="modal"
                            data-bs-target="#profileImageModal">{{ __('main.update_profile_image') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-image_modal>
        <x-slot name="id">profileImageModal</x-slot>
        <x-slot name="modalTitle"> {{ __('main.update_profile_image') }} </x-slot>
        <x-slot name="modalFormAction">{{ route('admin.updateProfileImage') }}</x-slot>
        <x-slot name="modalFormData">
            <div class="form-group">
                <input type="file" name="image" required class="dropify" accept="image/png, image/jpeg, image/jpg"
                    data-default-file="{{ isset(Auth::user()->profile_image) && !empty(Auth::user()->profile_image) ? Auth::user()->profile_image : '' }}">
            </div>
        </x-slot>
        <x-slot name="modalFormId">profileImageUpdate</x-slot>
        <x-slot name="modalFormSumbitText"> {{ __('main.update') }} </x-slot>
    </x-image_modal>
@endsection
{{-- @section('script')
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
        });
    </script>
@endsection --}}
