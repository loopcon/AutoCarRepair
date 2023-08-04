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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{route('admin_service-center-detail-update')}}" id="faq-form" enctype="multipart/form-data" data-parsley-validate="">
                            <input type="hidden" name="id" value="{{ isset($record->id) ? Crypt::encrypt($record->id) : '' }}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label" for="name">{{__('Name')}}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="{{__('Name')}}" required=""  data-parsley-required-message="{{ __("This value is required.")}}" value="{{ isset($record->name) ? $record->name : old('name') }}">

                                    @if ($errors->has('name')) <div class="text-danger">{{ $errors->first('name') }}</div>@endif
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="address">{{__('Address')}}<span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="address" name="address" placeholder="{{__('Address')}}" required=""  data-parsley-required-message="{{ __("This value is required.")}}" value="{{ isset($record->address) ? $record->address : old('address') }}">{{ isset($record->address) ? $record->address : old('address') }}</textarea>

                                    @if ($errors->has('address')) <div class="text-danger">{{ $errors->first('address') }}</div>@endif
                                </div>

                                <div class="mt-2 col-md-6">
                                <label for="image">{{__('Image')}}<span class="text-danger">*</span></label>
                                    <div class="image">
                                    @php($required = 'required')
                                        @if(isset($record->image))
                                            @if($record->image !='')
                                                @php($required = '')
                                                <img class='previewImage img-fluid' id="uploadPreview0" src="{{url('public/uploads/servicecenterdetail/'.$record->image)}}"  alt=''>
                                            @else
                                                @php($required = 'required')
                                                <img class='img-fluid' id="uploadPreview0" src="{{url('public/no.jpg')}}"  alt=''>
                                            @endif
                                        @else
                                            @php($required = 'required')
                                            <img class='img-fluid' id="uploadPreview0" src="{{url('public/no.jpg')}}"  alt=''>
                                        @endif
                                    </div>
                                    <div class="m-b-10">
                                        <input type="file" id="uploadImage0" accept="image/x-png, image/gif, image/jpeg" class="btn btn-warning btn-block btn-sm"  name="image" {{$required}} data-parsley-required-message="{{ __("This value is required.")}}" onChange="this.parentNode.nextSibling.value = this.value; PreviewImage(0);">
                                        @if ($errors->has('image')) <div class="errors_msg">{{ $errors->first('image') }}</div>@endif
                                    </div> 
                                </div>

                                <div class="mt-2 col-md-6">
                                    <label class="form-label" for="phone_number">{{__('Phone Number')}}</label>
                                    <input type="text" class="form-control numeric" id="phone_number" value="{{ isset($record->phone_number) ? $record->phone_number : old('phone_number') }}" required=""  data-parsley-required-message="{{ __("This value is required.")}}" name="phone_number" placeholder="{{__('Phone Number')}}">
                                    @if ($errors->has('phone_number')) <div class="text-danger">{{ $errors->first('phone_number') }}</div>@endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">{{__('Submit')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('javascript')
    <script src="{{ asset('plugins/parsley/parsley.js') }}"></script>
    <script src="{{asset('public/plugins/ckeditor/ckeditor.js')}}"  type="text/javascript"></script>
@endsection
