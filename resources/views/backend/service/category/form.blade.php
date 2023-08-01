@extends('backend.layout.main')
@section('css')
    <link class="js-stylesheet" href="{{ asset('plugins/parsley/parsley.css') }}" rel="stylesheet">
    <style>
    .image_errortext{
        color:red;
        font-size:10px;
        white-space: nowrap;
    }
</style>
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="@if(isset($record->id)){{ route('admin_service-category-update', array('id' => Crypt::encrypt($record->id))) }}@else{{route('admin_service-category-store')}}@endif" id="page-form" enctype="multipart/form-data" data-parsley-validate="">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="title">{{__('Title')}}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="{{__('Title')}}" maxlength="50" required=""  data-parsley-required-message="{{ __("This value is required.")}}" value="{{ isset($record->title) ? $record->title : old('title') }}">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="description">{{__('Description')}}</label>
                                    <textarea class="form-control" id="description" name="description" placeholder="{{__('Description')}}" >{{ isset($record->description) ? $record->description : old('description') }}</textarea>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="image">{{__('Image')}}<span class="text-danger">*</span></label>
                                    <div class="profile-icon">
                                        @if(isset($record->image))
                                            @if($record->image !='')
                                                @php($required = '')
                                                <img class='previewImage img-fluid' id="uploadPreview0" src="{{url('public/uploads/service/category/'.$record->image)}}"  alt=''>
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
                                        <input type="file" id="uploadImage0" accept="image/x-png, image/gif, image/jpeg" class="btn btn-warning btn-block btn-sm"  name="image" {{$required}} data-parsley-required-message="{{ __("This value is required.")}}" onChange="this.parentNode.nextSibling.value = this.value; PreviewImage(0);" >
                                    </div> 
                                    <p class="image_errortext">For Best resolution please upload 92*59 size and in WebP file format.</p>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="image_1">{{__('Image')}}</label>
                                    <div class="profile-icon">
                                        @if(isset($record->image_1))
                                            @if($record->image_1 !='')
                                                @php($required = '')
                                                <img class='previewImage img-fluid' id="uploadPreview0" src="{{url('public/uploads/service/category/'.$record->image_1)}}"  alt=''>
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
                                        <input type="file" id="uploadImage0" accept="image/x-png, image/gif, image/jpeg" class="btn btn-warning btn-block btn-sm"  name="image_1" >
                                    </div> 
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                            <a href="{{route('admin_service-category')}}" class="btn btn-danger">Cancel</a>
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