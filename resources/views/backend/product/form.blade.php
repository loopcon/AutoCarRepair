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
                        <form method="POST" action="@if(isset($record->id)) {{ route('admin_product-update', array('id' => Crypt::encrypt($record->id))) }} @else{{route('admin_product-store')}} @endif" id="user-form" enctype="multipart/form-data" data-parsley-validate="">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="box-body">
                                <div class="row">

                                    <div class="col-md-6 select-parsley">
                                        <label for="shop_category_id">Shop Category<span class="text-danger">*</span></label>
                                        <select class="form-control select2" name="shop_category_id" id="shop_category_id">
                                            <option value="">--select--</option>
                                            @foreach($shop_category as $shop_cate)
                                                <option value="{{$shop_cate->id}}" @if(isset($record->shop_category_id) && $record->shop_category_id == $shop_cate->id){{'selected'}}@endif>{{$shop_cate->name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('shop_category_id')) <div class="text-danger">{{ $errors->first('shop_category_id') }}</div>@endif
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label" for="name">{{__('Product Name')}}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="{{__('Product Name')}}" maxlength="30" required=""  data-parsley-required-message="{{ __("This value is required.")}}" value="{{ isset($record->name) ? $record->name : old('name') }}">

                                        @if ($errors->has('name')) <div class="text-danger">{{ $errors->first('name') }}</div>@endif
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="sku">{{__('Sku')}}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="sku" name="sku" placeholder="{{__('Sku')}}" maxlength="30" required=""  data-parsley-required-message="{{ __("This value is required.")}}" value="{{ isset($record->sku) ? $record->sku : old('sku') }}">

                                        @if ($errors->has('sku')) <div class="text-danger">{{ $errors->first('sku') }}</div>@endif
                                    </div>

                                    <div class="mb-3 col-md-12">
                                        <label class="form-label" for="description">{{__('Description')}}<span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="description" name="description" placeholder="{{__('Description')}}">{{ isset($record->description) ? $record->description : old('description') }}</textarea>
                                        @if ($errors->has('description')) <div class="text-danger">{{ $errors->first('description') }}</div>@endif
                                    </div>

                                    <div class="mb-3 col-md-12">
                                        <label class="form-label" for="specification">{{__('Specification')}}<span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="specification" name="specification" placeholder="{{__('Specification')}}">{{ isset($record->specification) ? $record->specification : old('specification') }}</textarea>
                                        @if ($errors->has('specification')) <div class="text-danger">{{ $errors->first('specification') }}</div>@endif
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="price">{{__('Price')}}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="price" name="price" placeholder="{{__('Price')}}" maxlength="30"   data-parsley-required-message="{{ __("This value is required.")}}" value="{{ isset($record->price) ? $record->price : old('price') }}">

                                        @if ($errors->has('price')) <div class="text-danger">{{ $errors->first('price') }}</div>@endif
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="amazon_link">{{__('Amazon Link')}}<span class="text-danger">*</span></label>
                                        <input type="url" class="form-control" id="amazon_link" name="amazon_link" placeholder="{{__('Amazon Link')}}" maxlength="30"  data-parsley-required-message="{{ __("This value is required.")}}" value="{{ isset($record->amazon_link) ? $record->amazon_link : old('amazon_link') }}">

                                        @if ($errors->has('amazon_link')) <div class="text-danger">{{ $errors->first('amazon_link') }}</div>@endif
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="flipcart_link">{{__('Flipcart Link')}}<span class="text-danger">*</span></label>
                                        <input type="url" class="form-control" id="flipcart_link" name="flipcart_link" placeholder="{{__('Flipcart Link')}}" maxlength="30"  data-parsley-required-message="{{ __("This value is required.")}}" value="{{ isset($record->flipcart_link) ? $record->flipcart_link : old('flipcart_link') }}">

                                        @if ($errors->has('flipcart_link')) <div class="text-danger">{{ $errors->first('flipcart_link') }}</div>@endif
                                    </div>

                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{route('admin_products')}}" class="btn btn-danger">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('javascript')
    <script src="{{ asset('plugins/parsley/parsley.js') }}"></script>
    <script src="{{asset('public/plugins/ckeditor/ckeditor.js')}}"  type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            CKEDITOR.replace('description', {
                height:300,
                removePlugins : 'resize',
                filebrowserBrowseUrl : '<?php echo url("public/plugins/kcfinder/browse.php?opener=ckeditor&type=files") ?>',
                filebrowserImageBrowseUrl : '<?php echo url("public/plugins/kcfinder/browse.php?opener=ckeditor&type=images") ?>',
                filebrowserFlashBrowseUrl : '<?php echo url("public/plugins/kcfinder/browse.php?opener=ckeditor&type=flash") ?>',
                filebrowserUploadUrl : '<?php echo url("public/plugins/kcfinder/upload.php?opener=ckeditor&type=files") ?>',
                filebrowserImageUploadUrl : '<?php echo url("public/plugins/kcfinder/upload.php?opener=ckeditor&type=images") ?>',
                filebrowserFlashUploadUrl : '<?php echo url("public/plugins/kcfinder/upload.php?opener=ckeditor&type=flash") ?>',
            });

            CKEDITOR.replace('specification', {
                height:300,
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