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

                                <div class="form-group col-md-12">
                                    <div class="col-md-6 d-flex px-0">
                                        <label class="form-label w-100">Image <a href="Javascript:void(0);" class="help" data-toggle="modal" data-target="#info-modal"><i class="fa fa-info-circle"></i></a></label>
                                        <a href="Javascript:void(0);" id="product-image-add" class="btn btn-success" style="width: 11vw;"><i class="fas fa-fw fa-plus align-middle"></i> Add more</a>
                                    </div>
                                    <div id="product-images" class="col-md-12">
                                        <div class="row image-head my-2 @if((isset($product) && $product->productImage->count()==0) || (isset($mode) && $mode=='clone')) d-none @endif">
                                            <div class="col-md-4 pl-0"><strong>Image File</strong></div>
                                            <div class="col-md-3 pl-0"><strong>Alt Text</strong></div>
                                            <div class="col-md-3 pl-0"><strong>Title</strong></div>
                                            <div class="col-md-1 pl-0"><strong>Primary</strong></div>
                                            <div class="col-md-1 pl-0 text-center"><strong>Action</strong></div>
                                        </div>
                                        @if(isset($mode) && $mode=='clone')
                                        @else
                                            @if(isset($product) && $product->productImage->count() > 0)
                                                @php($i = 0)
                                                @foreach($product->productImage as $productImage)
                                                    <div class="row image-row image-'{{$i}}' mb-2">
                                                        <div class="col-md-2 pl-0">
                                                            <input type="hidden" name="product_image[{{$i}}][igm_id]" value="{{ $productImage->igm_id }}">
                                                            <input type="hidden" name="product_image[{{$i}}][igm_is_remove]" value="0" class="is_remove">
                                                            <img src="">
                                                        </div>
                                                        <div class="col-md-3 pl-0">
                                                            <input type="text" class="form-control" name="product_image[{{$i}}][alt_text]" value="{{ $productImage->alt_text }}" placeholder="Alt Text">
                                                        </div>
                                                        <div class="col-md-3 pl-0">
                                                            <input type="text" class="form-control" name="product_image[{{$i}}][title]" value="{{ $productImage->title }}" placeholder="Title">
                                                        </div>
                                                        <div class="col-md-1 pl-0 text-center">
                                                            <input type="radio" class="" name="product_image[{{$i}}][is_primary]" @if($productImage->is_primary=='yes') checked="checked" @endif />
                                                        </div>
                                                        <div class="col-md-1 pl-0 text-center">
                                                            <span class="btn btn-danger btn-sm remove-exists-product-image" data-imagenumber="{{$i}}"><i class="fas fa-trash"></i></span>
                                                        </div>
                                                    </div>
                                                    @php($i++)
                                                @endforeach
                                            @endif
                                        @endif
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
            // CKEDITOR.on('instanceReady', function () {
            //     $('#description').attr('required', '');
            //     $.each(CKEDITOR.instances, function (instance) {
            //         CKEDITOR.instances[instance].on("change", function (e) {
            //             for (instance in CKEDITOR.instances) {
            //                 CKEDITOR.instances[instance].updateElement();
            //                 //$('form').parsley().validate();
            //             }
            //         });
            //     });
            // });

            $("#product-image-add").click(function() {
                var image_count = $("#product-images .image-row").length;
                var product_image_row = '<div class="row image-row image-'+image_count+' mb-2"><div class="col-md-4 pl-0"><input type="file" accept=" image/x-jpg, image/x-png, image/gif, image/jpeg" name="product_image['+image_count+'][image]" class="btn btn-warning btn-block btn-sm" /></div><div class="col-md-3 pl-0"><input type="text" class="form-control" name="product_image['+image_count+'][alt_text]" placeholder="Alt Text"></div><div class="col-md-3 pl-0"><input type="text" class="form-control" name="product_image['+image_count+'][title]" placeholder="Title"></div><div class="col-md-1 pl-0 text-center"><input type="radio" class="" name="product_image['+image_count+'][is_primary]" /></div><div class="col-md-1 pl-0 text-center"><span class="btn btn-danger btn-sm remove-product-image" data-imagenumber="'+image_count+'"><i class="fas fa-trash"></i></span></div></div>';
                $("#product-images .image-head").removeClass("d-none");
                $("#product-images").append(product_image_row);
            });

            $(document).on("click", ".remove-product-image", function() {
                $(this).closest(".image-row").remove();
                var image_count = $("#product-images .image-row:not(.d-none)").length;
                if(image_count <= 0) {
                    $("#product-images .image-head").addClass("d-none");
                }
            });

            $(".remove-exists-product-image").click(function() {
                $(this).closest(".image-row").find("input.is_remove").val(1);
                $(this).closest(".image-row").addClass("d-none");
                var image_count = $("#product-images .image-row:not(.d-none)").length;
                if(image_count <= 0) {
                    $("#product-images .image-head").addClass("d-none");
                }
            });
        });
    </script>
@endsection