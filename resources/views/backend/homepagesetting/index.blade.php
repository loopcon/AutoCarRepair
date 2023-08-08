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

                                    @if ($errors->has('section1_title2')) <div class="text-danger">{{ $errors->first('section1_title2') }}</div>@endif
                                </div>

                                <div class="mt-2 col-md-6">
                                <label for="section1_image">{{__('Section 1 Image')}}</label>
                                    <div class="product_image">
                                    @php($required = 'required')
                                        @if(isset($record->section1_image))
                                            @if($record->section1_image !='')
                                                @php($required = '')
                                                <img class='previewImage img-fluid' id="uploadPreview1" src="{{url('public/uploads/content/'.$record->section1_image)}}"  alt=''>
                                            @else
                                                @php($required = 'required')
                                                <img class='img-fluid' id="uploadPreview1" src="{{url('public/no.jpg')}}"  alt=''>
                                            @endif
                                        @else
                                            @php($required = 'required')
                                            <img class='img-fluid' id="uploadPreview1" src="{{url('public/no.jpg')}}"  alt=''>
                                        @endif
                                    </div>
                                    <div class="m-b-10">
                                        <input type="file" id="uploadImage1" accept="image/x-png, image/gif, image/jpeg" class="btn btn-warning btn-block btn-sm"  name="section1_image" onChange="this.parentNode.nextSibling.value = this.value; PreviewImage(1);">
                                    </div> 
                                </div>

                                <div class="mt-2 col-md-6">
                                    <label class="form-label" for="section1_description">{{__('Section1 Description')}}</label>
                                    <textarea class="form-control" id="section1_description" name="section1_description" placeholder="{{__('Section1 Description')}}">{{ isset($record->section1_description) ? $record->section1_description : old('section1_description') }}</textarea>
                                    @if ($errors->has('section1_description')) <div class="text-danger">{{ $errors->first('section1_description') }}</div>@endif
                                </div>

                                <div class="mt-2 col-md-6">
                                    <label class="form-label" for="footer_description">{{__('Footer Description')}}</label>
                                    <textarea class="form-control" id="footer_description" name="footer_description" placeholder="{{__('Footer Description')}}">{{ isset($record->footer_description) ? $record->footer_description : old('footer_description') }}</textarea>
                                    @if ($errors->has('footer_description')) <div class="text-danger">{{ $errors->first('footer_description') }}</div>@endif
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="button_title">{{__('Button Title')}}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="button_title" name="button_title" placeholder="{{__('Button Title')}}" required=""  data-parsley-required-message="{{ __("This value is required.")}}" value="{{ isset($record->button_title) ? $record->button_title : old('button_title') }}">

                                    @if ($errors->has('button_title')) <div class="text-danger">{{ $errors->first('button_title') }}</div>@endif
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="button_link">{{__('Button link')}}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="button_link" name="button_link" placeholder="{{__('Button Title')}}" required=""  data-parsley-required-message="{{ __("This value is required.")}}" value="{{ isset($record->button_link) ? $record->button_link : old('button_link') }}">

                                    @if ($errors->has('button_link')) <div class="text-danger">{{ $errors->first('button_link') }}</div>@endif
                                </div>

                                <div class="mt-3  col-md-12">
                                    <h6>SEO Details</h6>
                                    <hr/>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label" for="meta_title">{{__('Meta Title')}}</label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="{{__('Meta Title')}}" value="{{ isset($record->meta_title) ? $record->meta_title : old('meta_title') }}">
                                        @if ($errors->has('meta_title')) <div class="text-danger">{{ $errors->first('meta_title') }}</div>@endif
                                    </div>
                                    
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label" for="meta_keywords">{{__('Meta Keyword')}}</label>
                                        <textarea class="form-control" id="meta_keywords" name="meta_keywords" placeholder="{{__('Meta Keyword')}}">{{ isset($record->meta_keywords) ? $record->meta_keywords : old('meta_keywords') }}</textarea>
                                        @if ($errors->has('meta_keywords')) <div class="text-danger">{{ $errors->first('meta_keywords') }}</div>@endif
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label class="form-label" for="meta_description">{{__('Meta Description')}}</label>
                                        <textarea class="form-control" id="meta_description" name="meta_description" placeholder="{{__('Meta Description')}}">{{ isset($record->meta_description) ? $record->meta_description : old('meta_description') }}</textarea>
                                        @if ($errors->has('meta_description')) <div class="text-danger">{{ $errors->first('meta_description') }}</div>@endif
                                    </div>
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
