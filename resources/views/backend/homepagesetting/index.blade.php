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
                        <form method="POST" action="{{route('admin_home-page-content-update')}}" id="faq-form" enctype="multipart/form-data" data-parsley-validate="">
                            <input type="hidden" name="id" value="{{ isset($record->id) ? Crypt::encrypt($record->id) : '' }}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label" for="section1_title1">{{__('Section 1 Title 1')}}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="section1_title1" name="section1_title1" placeholder="{{__('Section 1 Title 1')}}" required=""  data-parsley-required-message="{{ __("This value is required.")}}" value="{{ isset($record->section1_title1) ? $record->section1_title1 : old('section1_title1') }}">

                                    @if ($errors->has('section1_title1')) <div class="text-danger">{{ $errors->first('section1_title1') }}</div>@endif
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="section1_title2">{{__('Section 1 Title 2')}}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="section1_title2" name="section1_title2" placeholder="{{__('Section 1 Title 2')}}" required=""  data-parsley-required-message="{{ __("This value is required.")}}" value="{{ isset($record->section1_title2) ? $record->section1_title2 : old('section1_title2') }}">

                                    @if ($errors->has('name')) <div class="text-danger">{{ $errors->first('name') }}</div>@endif
                                </div>

                                <div class="mt-2 col-6">
                                    <label for="section1_image">{{__('Section 1 Image')}}</label>
                                    <div class="profile-icon">
                                        @php($i = 0)
                                        @php($required = 'required')
                                        @if(isset($record->section1_image))
                                            @if($record->section1_image !='')
                                                @php($required = '')
                                                <img class='img-responsive previewImage img-fluid' id="uploadPreview{{$i}}" src="{{url('public/uploads/content/'.$record->section1_image)}}"  alt=''>
                                            @else
                                                @php($required = 'required')
                                                <img class='img-responsive img-fluid' id="uploadPreview{{$i}}" src="{{url('public/no.jpg')}}"  alt=''>
                                            @endif
                                        @endif
                                        <div class="m-b-10">
                                            <input type="file" id="uploadImage{{$i}}" accept="image/x-png, image/gif, image/jpeg" class="btn btn-warning btn-block btn-sm"  name="section1_image" {{$required}} data-parsley-required-message="{{ __("This value is required.")}}">
                                            @if ($errors->has('section1_image')) <div class="errors_msg">{{ $errors->first('section1_image') }}</div>@endif
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-2 col-md-6">
                                    <label class="form-label" for="section1_description">{{__('Section1 Description')}}</label>
                                    <textarea class="form-control" id="section1_description" name="section1_description" placeholder="{{__('Section1 Description')}}">{{ isset($record->section1_description) ? $record->section1_description : old('section1_description') }}</textarea>
                                    @if ($errors->has('section1_description')) <div class="text-danger">{{ $errors->first('section1_description') }}</div>@endif
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
