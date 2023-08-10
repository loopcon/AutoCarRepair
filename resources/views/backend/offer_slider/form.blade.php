@extends('backend.layout.main')
@section('css')
    <link class="js-stylesheet" href="{{ asset('plugins/parsley/parsley.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('public/plugins/sweetalert/sweetalert.css')}}">
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
                        <div class="col-md-12 text-end">
                            <div class="col-md-12 text-end"><a href="javascript:void(0)" id="add_more" class="btn btn-success"><i class="align-middle" data-feather="plus"></i>{{__('Add More')}}</a></div>
                        </div>
                        <form method="POST" action="{{route('admin_offer-slider-update')}}" id="accessories-form" enctype="multipart/form-data" data-parsley-validate="">
                            {{ csrf_field() }}

                                <div class="row" id="slider">
                                    @if($slider->count())
                                        @foreach($slider as $offer)
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label" for="image">{{__('Image')}}<span class="text-danger">*</span></label>
                                            <div class="profile-icon">
                                                <img class='img-fluid' id="uploadPreview" src=""  alt=''>
                                            </div>
                                            <div class="m-b-10">
                                                <input type="file" id="uploadImage" accept="image/x-png, image/gif, image/jpeg" class="btn btn-warning btn-block btn-sm"  name="image"  data-parsley-required-message="{{ __("This value is required.")}}" onChange="this.parentNode.nextSibling.value = this.value; PreviewImage();" >
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label" for="title1">{{__('Title 1')}}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="title1" value="{{$offer->title1}}" name="title1" placeholder="{{__('Title1')}}" maxlength="50" required=""  data-parsley-required-message="{{ __("This value is required.")}}" >
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label" for="title2">{{__('Title 2')}}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="title2" value="{{$offer->title2}}" name="title2" placeholder="{{__('Title2')}}" maxlength="30" required=""  data-parsley-required-message="{{ __("This value is required.")}}">
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label" for="btn_title">{{__('Button Title')}}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="btn_title" value="{{$offer->btn_title}}"  name="btn_title" placeholder="{{__('Button Title')}}" maxlength="30" required=""  data-parsley-required-message="{{ __("This value is required.")}}">
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label" for="btn_link">{{__('Button Link')}}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="btn_link" value="{{$offer->btn_link}}"  name="btn_link" placeholder="{{__('Button Link')}}" maxlength="30" required=""  data-parsley-required-message="{{ __("This value is required.")}}" >
                                        </div>
                                        @endforeach
                                    @endif
                                </div>

                                @php($total = 0)
                                @if(isset($record) && $record->image)
                                    @php($total = $record->image->count())
                                    @foreach($record->image as $pkey => $pval)
                                    
                                <div class="row" id="slider">
                                    <input type="hidden" name="sid{{$pkey}}" value="{{ $pval->id }}">
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label" for="image">{{__('Image')}}<span class="text-danger">*</span></label>
                                        <div class="profile-icon">
                                            <img class='img-fluid' id="uploadPreview{{$pkey}}" src="{{url('public/uploads/offerslider/'.$pval->image)}}"  alt=''>
                                        </div>
                                        <div class="m-b-10">
                                            <input type="file" id="uploadImage{{$pkey}}" accept="image/x-png, image/gif, image/jpeg" class="btn btn-warning btn-block btn-sm"  name="image{{$pkey}}"  data-parsley-required-message="{{ __("This value is required.")}}" onChange="this.parentNode.nextSibling.value = this.value; PreviewImage({{$pkey}});" >
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label" for="title1">{{__('Title 1')}}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="title1" name="title1" placeholder="{{__('Title1')}}" maxlength="50" required=""  data-parsley-required-message="{{ __("This value is required.")}}" value="{{$pkey}}">
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label" for="title2">{{__('Title 2')}}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="title2" name="title2" placeholder="{{__('Title2')}}" maxlength="30" required=""  data-parsley-required-message="{{ __("This value is required.")}}" value="{{$pkey}}">
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label" for="btn_title">{{__('Button Title')}}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="btn_title" name="btn_title" placeholder="{{__('Button Title')}}" maxlength="30" required=""  data-parsley-required-message="{{ __("This value is required.")}}" value="{{$pkey}}">
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label" for="btn_link">{{__('Button Link')}}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="btn_link" name="btn_link_0" placeholder="{{__('Button Link')}}" maxlength="30" required=""  data-parsley-required-message="{{ __("This value is required.")}}" value="{{$pkey}}">
                                    </div>
                                    <div class="col-md-6 pl-0 text-end">
                                        <br/><span class="btn btn-danger btn-sm delete" data-id="{{$pkey}}" data-db_id="{{$pval->id}}">delete</span>
                                    </div>
                                </div>
                            @endforeach
                            @endif
                            <input type="hidden" name="total" value="{{$total}}">
                            <input type="hidden" name="last_id" value="{{$total}}"> 

                            <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                            <a href="{{route('admin_offer-slider')}}" class="btn btn-danger">{{__('Cancel')}}</a>
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
<script src="{{asset('plugins/sweetalert/sweetalert.js')}}" type="text/javascript"></script>
<script>
$(document).ready(function(){
    $("#add_more").click(function() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var total = $('input[name="total"]').val();
        var last_id = $('input[name="last_id"]').val();
        console.log(last_id);
        $.ajax({
            url : '{{ route('admin_offer-slider-ajax-html') }}',
            method : 'post',
            data : {_token: CSRF_TOKEN, id : last_id},
            success : function(result){
                var result = $.parseJSON(result);
                var html = result.html;
                $("#slider").append(html);
            }
        });
        var total = parseInt(total) + 1;
        $('input[name="total"]').val(total);
        var lastId = parseInt(last_id) + 1;
        $('input[name="last_id"]').val(lastId);
    });

    $(document).on('click', '.delete', function(){
        var db_id = $(this).data('db_id');
        var id = $(this).data('id');
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        swal({
            title: "",
            text: "Are you sure? Delete this Image!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: true
        },
        function(){
            if(db_id){
                $.ajax({
                    url : '{{ route('admin_product-image-delete') }}',
                    method : 'post',
                    data : {_token: CSRF_TOKEN, id : db_id},
                    success : function(result){
                        console.log(id);
                        $('.image-'+ id).remove();
                        var total = $('input[name="total"]').val();
                        var total = parseInt(total) - 1;
                        $('input[name="total"]').val(total);
                        window.notyf.open({
                            type : 'success',
                            message : 'Image Deleted Successfully!',
                            duration : '10000',
                            ripple : true,
                            dismissible : true,
                            position: {
                                    x: 'right',
                                    y: 'top'
                            }
                        });
                    }
                });
            } else {
                $('.image' + id).remove();
                var total = $('input[name="total"]').val();
                var total = parseInt(total) - 1;
                $('input[name="total"]').val(total);
                window.notyf.open({
                    type : 'success',
                    message : 'Slider Deleted Successfully!',
                    duration : '10000',
                    ripple : true,
                    dismissible : true,
                    position: {
                            x: 'right',
                            y: 'top'
                    }
                });
            }
        });              
    });
});
</script>
@endsection
