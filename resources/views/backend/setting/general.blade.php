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
                        <form method="post" action="{{route('admin_site-settings')}}" enctype="multipart/form-data" data-parsley-validate>
                            {{ csrf_field() }}
                            @if(isset($settings))
                                <div class="row">
                                    @foreach($settings as $item)
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="name">{{$item->name}} @if($item->label == 'site_name' || $item->label == 'phone' || $item->label == 'email' || $item->label == 'fax')<span class="text-danger">*</span>@endif</label>
                                                @php 
                                                    $icon = array('facebook' => 'facebook', 'twitter' => 'twitter', 'youtube' => 'youtube', 'linkedin' => 'linkedin', 'instagram' => 'instagram');
                                                @endphp
                                                @if($item->label == 'site_name')
                                                    <input type="text" class="form-control" value="{{$item->value}}" name="{{$item->id}}" id="{{ $item->label }}" required="">
                                                @elseif($item->label == 'email')
                                                    <input type="email" class="form-control" value="{{$item->value}}" name="{{$item->id}}" id="{{ $item->label }}" required="">
                                                @elseif($item->label == 'address')
                                                    <textarea class="form-control" name="{{ $item->id }}" rows="5">{{$item->value}}</textarea>
                                                @elseif($item->label == 'cookie_concent' || $item->label == 'shipping_information')
                                                    <textarea class="form-control" name="{{ $item->id }}" rows="5">{{$item->value}}</textarea>
                                                @elseif($item->label == 'certified_title' || $item->label == 'brand_title' || $item->label == 'collection_title')
                                                    <textarea class="form-control" name="{{ $item->id }}" rows="5">{{$item->value}}</textarea>
                                                @elseif(in_array($item->label, array('facebook', 'twitter', 'youtube', 'linkedin', 'instagram')))
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name="{{$item->id}}" id="{{ $item->label }}" value="{{ $item->value }}">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="align-middle" data-feather="{{$icon[$item->label]}}"></i></span>
                                                        </div>
                                                    </div>
                                                @elseif($item->label == 'phone' || $item->label == 'fax')
                                                    <input type="text" class="form-control" value="{{$item->value}}" name="{{$item->id}}" id="{{ $item->label }}" data-parsley-pattern="^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[6789]\d{9}$" required="">
                                                @elseif($item->label == 'product_gst' || $item->label == 'service_gst')
                                                    <input type="text" class="form-control numeric" value="{{$item->value}}" name="{{$item->id}}" id="{{ $item->label }}"  required="">
                                                @elseif($item->label == 'authorized_signatory')
                                                   <div class="profile-icon">
                                                        @php($i = 0)
                                                        @if(isset($item->value))
                                                            @if($item->value !='')
                                                                <img class='img-fluid previewImage' id="uploadPreview{{$i}}" src="{{url('uploads/setting/'.$item->value)}}"  alt=''>
                                                            @endif
                                                        @endif
                                                    </div>
                                                    <input type="file" accept="image/x-png, image/gif, image/jpeg" id="uploadImage{{$i}}" class="btn btn-warning btn-block btn-sm"  name="{{$item->id}}" onChange="this.parentNode.nextSibling.value = this.value; PreviewImage({{$i}});" >
                                                @elseif($item->label == 'pan_card')
                                                    <input type="text" class="form-control numeric" value="{{$item->value}}" name="{{$item->id}}" id="{{ $item->label }}">
                                                @elseif($item->label == 'gst_number')
                                                    <input type="text" class="form-control numeric" value="{{$item->value}}" name="{{$item->id}}" id="{{ $item->label }}">
                                                @else
                                                <input type="text" class="form-control numeric" value="{{$item->value}}" name="{{$item->id}}" id="{{ $item->label }}"  required="">
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <button type="submit" class="btn btn-primary">{{ __('Submit')}}</button>
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