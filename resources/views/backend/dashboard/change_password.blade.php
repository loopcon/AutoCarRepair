@extends('backend.layout.main')
@section('css')
    <link class="js-stylesheet" href="{{ asset('plugins/parsley/parsley.css') }}" rel="stylesheet">
@endsection
@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                @include('backend.alerts')
            </div>
        </div>
        <h1 class="h3 mb-3">{{$site_title}}</h1>

        <div class="row">
            <div class="col-12 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{route('admin_change-password')}}" data-parsley-validate>
                            {{ csrf_field() }}
                            <div class="mb-3">
                                <label class="form-label">{{__('Old Password')}} <span class="text-danger">*</span></label>
                                <input type="password" placeholder="{{trans('Old Password')}}" required="" class="form-control" value="" name="old_password" data-parsley-required-message="{{ __("This value is required.")}}">
                                @if ($errors->has('old_password')) <div class="text-danger">{{ $errors->first('old_password') }}</div>@endif
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{__('New Password')}} <span class="text-danger">*</span></label>
                                <input type="password" placeholder="{{trans('New Password')}}" required="" class="form-control" value="" name="new_password" id="new_password" data-parsley-minlength="6" data-parsley-required-message="{{ __("This value is required.")}}" data-parsley-error-message="{{__('This value is too short. It should have 6 characters or more.')}}">
                                @if ($errors->has('new_password')) <div class="text-danger">{{ $errors->first('new_password') }}</div>@endif
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{__('Confirm Password')}}<span class="text-danger">*</span></label>
                                <input type="password" placeholder="{{trans('Confirm Password')}}" required="" class="form-control" value="" name="confirm_new_password" data-parsley-equalto="#new_password" data-parsley-required-message="Please re-enter your new password." data-parsley-error-message="{{__('Confirm password should match password field.')}}">
                                @if ($errors->has('confirm_new_password')) <div class="text-danger">{{ $errors->first('confirm_new_password') }}</div>@endif
                            </div>
                            <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
@section('javascript')

    <script src="{{ asset('plugins/parsley/parsley.js') }}"></script>

@endsection