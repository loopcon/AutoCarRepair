@extends('front.layout.main')
@section('css')
    <link class="js-stylesheet" href="{{ asset('plugins/parsley/parsley.css') }}" rel="stylesheet">
    <link class="js-stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="shop-center-tophead">
    <img src="{{ asset('front/img/service-inner-bg.png') }}" class="img-fluid" alt="">
    <div class="shop-center-text">
        <h2>{{ strtoupper($site_title) }}</h2>
        <ul class="shop-center-breadcum">
            <li><a href="{{url('/')}}">Home</a></li>
            <li><i class="fa-solid fa-angles-right"></i></li>
            <li>{{ $site_title }}</li>
        </ul>
    </div>
</div>

<div class="faq-section-main">
    <div class="container">
        <div class="row justify-content-center">
            <div class=" col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <form method="post" action="{{route('front_my-profile-update')}}" id="register-form" class="row  g-3" enctype="multipart/form-data" data-parsley-validate=''>
                                {{ csrf_field() }}
                                <div class="profileimg">
                                    <?php
                                        $user_profile = auth()->user()->image;
                                    ?>
                                    @if(isset($user_profile))
                                        @if($user_profile !='')
                                            @php($required = '')
                                            <img class='previewImage img-fluid' id="uploadPreview0" src="{{url('uploads/user/'.$user_profile)}}"  alt=''>
                                        @else
                                            @php($required = 'required')
                                            <img class='img-fluid' id="uploadPreview0" src="{{url('front/img/no_image.jpg')}}"  alt=''>
                                        @endif
                                    @else
                                        @php($required = 'required')
                                        <img class='img-fluid' id="uploadPreview0" src="{{url('front/img/no_image.jpg')}}" alt=''>
                                    @endif
                                    <input type="file" id="uploadImage0" class="profilepenicon" accept="image/x-png, image/gif, image/jpeg"  name="image" {{$required}} data-parsley-required-message="{{ __("This value is required.")}}" onChange="this.parentNode.nextSibling.value = this.value; PreviewImage(0);" />
                                    <!--<i class="fa-solid fa-pen profilepenicon "></i>-->
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">First Name<span class="text-danger">*</span></label>
                                    <input type="text" name="firstname" value="{{auth()->user()->firstname}}" placeholder="FIRST NAME" required="" class="form-control" maxlength="50">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Last Name<span class="text-danger">*</span></label>
                                    <input type="text" name="lastname" value="{{auth()->user()->lastname}}" placeholder="LAST NAME" required="" class="form-control" maxlength="50">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone No.<span class="text-danger">*</span></label>
                                    <input type="text" name="phone" id="phone"  value="{{auth()->user()->phone}}" maxlength="10" placeholder="PHONE NO" required="" class="form-control num_only">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email<span class="text-danger">*</span></label>
                                    <input type="email" name="email" value="{{auth()->user()->email}}" placeholder="EMAIL ID" required="" class="form-control ">
                                </div>
                                <div class="col-md-12">
                                    <h4>User Addresses</h4>
                                    <hr>
                                </div>
                                @if($addresses->count())
                                    @foreach($addresses as $address)
                                        <input  type="hidden" name="aid[]" value="{{($address->id)}}" >
                                        <div class="col-md-12">
                                            <label class="form-label">Address<span class="text-danger">*</span></label>
                                            <textarea name="address[]" value="{{($address->address)}}" placeholder="Address" required="" class="form-control ">{{$address->address}}</textarea>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">City<span class="text-danger">*</span></label>
                                            <input type="text" name="city[]" value="{{ $address->city}}" placeholder="CITY" required="" class="form-control" maxlength="35">
                                        </div> 
                                        <div class="col-md-4">
                                            <label class="form-label">Zip Code<span class="text-danger">*</span></label>
                                            <input type="text" name="zip[]" value="{{ $address->zip}}" placeholder="ZIP CODE" required="" class="form-control num_only" maxlength="6">
                                        </div>

                                        <div class="col-md-4 select-parsley">
                                            <label for="State">State<span class="text-danger">*</span></label>
                                            <select class="form-control state_selection " name="state[]"  required="">
                                                <option value="all">--select--</option>
                                                @foreach($states as $state)
                                                    <option value="{{$state->name}}" @if(isset($address->state) && $address->state == $state->name){{'selected'}}@endif>{{$state->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('state')) <div class="text-danger">{{ $errors->first('state') }}</div>@endif
                                        </div>
                                        <div class="col-12">
                                            <hr>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="col-md-12">
                                    <label class="form-label">Address</label>
                                    <textarea name="address[]" value="" placeholder="Address"  class="form-control "></textarea>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">City</label>
                                    <input type="text" name="city[]" value="" placeholder="CITY"  class="form-control" maxlength="35">
                                </div> 
                                <div class="col-md-4">
                                    <label class="form-label">Zip Code</label>
                                    <input type="text" name="zip[]" value="" placeholder="ZIP CODE" class="form-control num_only" maxlength="6">
                                </div>
                                <div class="col-md-4 select-parsley">
                                    <label for="State">State</label>
                                    <select class="form-control state_selection" name="state[]" >
                                        <option value="all">--select--</option>
                                        @foreach($states as $state)
                                            <option value="{{$state->name}}">{{$state->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('state')) <div class="text-danger">{{ $errors->first('state') }}</div>@endif
                                </div>
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-lg btn-primary">Update</button> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script src="{{ asset('plugins/parsley/parsley.js') }}"></script>
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $('.state_selection').select2();
    });
</script>
@endsection
