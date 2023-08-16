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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="@if(isset($record->id)){{ route('admin_page-update', array('id' => Crypt::encrypt($record->id))) }}@else{{route('admin_page-store')}}@endif" id="page-form" enctype="multipart/form-data" data-parsley-validate="">
                            <input type="hidden" name="id" value="{{ isset($record->id) ? Crypt::encrypt($record->id) : '' }}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="name">{{__('Page Name')}}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="{{__('Page Name')}}" maxlength="30" required=""  data-parsley-required-message="{{ __("This value is required.")}}" value="{{ isset($record->name) ? $record->name : old('name') }}">

                                    @if ($errors->has('name')) <div class="text-danger">{{ $errors->first('name') }}</div>@endif
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="slug">{{__('Slug')}}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="slug" name="slug" placeholder="{{__('Slug')}}" maxlength="30" required=""  data-parsley-required-message="{{ __("This value is required.")}}"  value="{{ isset($record->slug) ? $record->slug : old('slug') }}">

                                    @if ($errors->has('slug')) <div class="text-danger">{{ $errors->first('slug') }}</div>@endif
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label class="form-label" for="description">{{__('Description')}}<span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="description" name="description" placeholder="{{__('Description')}}">{{ isset($record->description) ? $record->description : old('description') }}</textarea>
                                    @if ($errors->has('description')) <div class="text-danger">{{ $errors->first('description') }}</div>@endif
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="meta_keyword">{{__('Meta Keyword')}}</label>
                                    <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" placeholder="{{__('Meta Keyword')}}" value="{{ isset($record->meta_keyword) ? $record->meta_keyword : old('meta_keyword') }}">
                                    @if ($errors->has('meta_keyword')) <div class="text-danger">{{ $errors->first('meta_keyword') }}</div>@endif
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="meta_description">{{__('Meta Description')}}</label>
                                    <input type="text" class="form-control" id="meta_description" name="meta_description" placeholder="{{__('Meta Description')}}" value="{{ isset($record->meta_description) ? $record->meta_description : old('meta_description') }}">
                                    @if ($errors->has('meta_description')) <div class="text-danger">{{ $errors->first('meta_description') }}</div>@endif
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                            <a href="{{route('admin_pages')}}" class="btn btn-danger">{{__('Cancel')}}</a>
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
    <script>
        $(document).ready(function(){
            CKEDITOR.replace('description', {
                height:1000,
                removePlugins : 'resize',
                filebrowserBrowseUrl : '<?php echo url("public/plugins/kcfinder/browse.php?opener=ckeditor&type=files") ?>',
                filebrowserImageBrowseUrl : '<?php echo url("public/plugins/kcfinder/browse.php?opener=ckeditor&type=images") ?>',
                filebrowserFlashBrowseUrl : '<?php echo url("public/plugins/kcfinder/browse.php?opener=ckeditor&type=flash") ?>',
                filebrowserUploadUrl : '<?php echo url("public/plugins/kcfinder/upload.php?opener=ckeditor&type=files") ?>',
                filebrowserImageUploadUrl : '<?php echo url("public/plugins/kcfinder/upload.php?opener=ckeditor&type=images") ?>',
                filebrowserFlashUploadUrl : '<?php echo url("public/plugins/kcfinder/upload.php?opener=ckeditor&type=flash") ?>',
            });
            CKEDITOR.on('instanceReady', function () {
                $('#description').attr('required', '');
                $.each(CKEDITOR.instances, function (instance) {
                    CKEDITOR.instances[instance].on("change", function (e) {
                        for (instance in CKEDITOR.instances) {
                            CKEDITOR.instances[instance].updateElement();
                            //$('form').parsley().validate();
                        }
                    });
                });
            });
        });
    </script>
@endsection