@extends('front.layout.main')
@section('css')
    <link class="js-stylesheet" href="{{ asset('plugins/parsley/parsley.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="container">
    <form method="POST" action="{{route('front_create-order')}}" id="appointment-form" enctype="multipart/form-data" data-parsley-validate="">
        @csrf
    <div class="row m-0">
        <div class="col-12 col-md-7">
            <div class="personal-detail-main">
                <h4>Personal Details</h4>
                    <div class="row ">
                         <div class="col-12 col-sm-6 col-md-12 col-lg-6">
                            <div class="mb-3">
                                <input type="text" class="form-control" name="name" required="" maxlength="50" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Name" value="{{ Auth::guard('user')->check() ? Auth::guard('user')->user()->firstname.' '.Auth::guard('user')->user()->lastname : ''}}">
                            </div>
                         </div>
                         <div class="col-12 col-sm-6 col-md-12 col-lg-6">
                            <div class="mb-3">
                                <input type="text" class="form-control num_only" maxlength="10" required="" name="mobile" id="mobile" aria-describedby="emailHelp" placeholder="Phone Number" value="{{ Auth::guard('user')->check() ? Auth::guard('user')->user()->phone : ''}}">
                            </div>
                         </div>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" id="email" name="email" required="" aria-describedby="emailHelp" placeholder="Email" value="{{ Auth::guard('user')->check() ? Auth::guard('user')->user()->email : ''}}">
                    </div>
                    <div class="otp-section">
                        <div class="mb-3 otpinput-main">
                            <input type="text" class="form-control num_only" id="otp" name="otp" aria-describedby="emailHelp" placeholder="OTP">
                            <div id="resend_text"><b>Resend OTP in <span id="timer"></span> seconds</b></div>
                        </div>
                        <a href="javascript:void(0)" id="verify_otp" class="btn verify-otpbtn">VERIFY OTP </a>
                        <a href="javascript:void(0)" id="resend_otp" class="btn verify-otpbtn">RESEND OTP </a>
                    </div>
                    <input type="hidden" id="is_otp_verify" value="0">
                    <a href="javascript:void(0)" class="btn verify-otpbtn" id="send_otp">SEND OTP </a>
            </div>
            <?php /**<div class="Choose-service-date-main">
                <h4>Choose service date</h4>
                <div class="date-sec-main">
                    <a class="date-main select-date" href="#">
                        <p>26</p>
                        <p>WED</p>
                    </a>
                    <a class="date-main" href="#">
                        <p>27</p>
                        <p>WED</p>
                    </a>
                    <a class="date-main" href="#">
                        <p>28</p>
                        <p>WED</p>
                    </a>
                    <a class="date-main" href="#">
                        <p>29</p>
                        <p>WED</p>
                    </a>
                    <a class="date-main" href="#">
                        <p>30</p>
                        <p>WED</p>
                    </a>
                    <a class="date-main" href="#">
                        <p>31</p>
                        <p>WED</p>
                    </a>
                </div>
                <div class="pick-slot-main">
                    <h4>Pick Time Slot <span>(5 slot available)</span> </h4>
                </div>
                <div class="afternoon-slot-sec-main">
                    <h4><span>slots</span>Afternoon Slot</h4>
                    <div class="row m-0">
                        <div class="col-12 col-sm-6">
                            <button class="afternoon-slot-btn afternoon-slot-active">2-3PM</button>
                        </div>
                        <div class="col-12 col-sm-6">
                            <button class="afternoon-slot-btn">3-4PM</button>
                        </div>
                    </div>
                </div>
                <div class="evening-slot-sec-main">
                    <h4><span>slots</span>Evening Slot</h4>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <button class="evening-slot-btn evening-slot-active">2-3PM</button>
                        </div>
                        <div class="col-12 col-sm-6">
                            <button class="evening-slot-btn">3-4PM</button>
                        </div>
                    </div>
                </div>
                <div class="sele-date-continue-sec">
                    <button class="sele-date-continue-btn">CONTINUE <i class="fa-solid fa-arrow-right"></i></button>
                </div>
            </div> **/ ?>
            <div class="select-address">
                <h4>Add Address</h4>
                <div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="address" required="" name="address" aria-describedby="emailHelp" placeholder="Enter Address">
                    </div>
                    <div class="row m-0">
                        <div class="col-12 col-sm-6">
                            <div class="mb-3">
                                <input type="text" class="form-control num_only" required="" id="zip" maxlength="6" name="zip" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Pincode">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="mb-3">
                                <input type="text" class="form-control" name="city" required="" id="city" aria-describedby="emailHelp" placeholder="City">
                            </div>
                        </div>
                    </div>
                    <div class="row m-0">
                        @if(isset($addresses) && $addresses->count())
                            <div class="col-12">
                                <p>Choose From Saved Addresses</p>
                                @foreach($addresses as $aval)
                                    <div class="row m-0 choose-address-main mb-3">
                                        <input type="radio" name="address_radio" value="{{$aval->id}}" class="form-check-input address_radio">
                                        <input type="hidden" id='uaddress{{$aval->id}}' value="{{$aval->address}}">
                                        <input type="hidden" id='uzip{{$aval->id}}' value="{{$aval->zip}}">
                                        <input type="hidden" id='ucity{{$aval->id}}' value="{{$aval->city}}">
                                        <div class="col-3">
                                            <i class="fa-solid fa-location-dot"></i>
                                        </div>
                                        <div class="col-9">
                                            <p> {{$aval->address}} , {{$aval->zip}}, {{$aval->city}}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>  
                        @endif
                    </div>
<!--                    <div class="text-end mt-3 mb-3">
                        <button class="sele-date-continue-btn">CONTINUE <i class="fa-solid fa-arrow-right"></i></button>
                    </div>-->
                </div>
            </div>
            <div>
                <div class="select-payment-main">
                    <h4>Add Address</h4>
                    <div>
                        <p>Select a  payment method and place Order :</p>
                    </div>
                    <div>
                        <p class="pay-online-text"> <img src="{{ asset('front/img/cashless-payment.png') }}" width="30px" alt=""> Pay Online 
                            <input class="form-check-input" type="radio" name="payment_type" value="0" id="flexRadioDefault2" checked>
                        </p>
                        <p class="pay-cash-text"> <img src="{{ asset('front/img/rupee.png') }}" width="30px" alt=""> Pay cash 
                            <input class="form-check-input" type="radio" name="payment_type" value="1" id="flexRadioDefault2" checked>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-5">
            <div class="card-detial-sec-main">

            </div>
        </div>
    </div>
    </form>
</div>
<!-- add to cart page end -->
@endsection
@section('javascript')
<script src="{{ asset('plugins/parsley/parsley.js') }}"></script>
<script>
$(document).ready(function(){
    getCartAjaxHtml();

    $(document).on('click', '.address_radio', function(){
        var id = $("input[name='address_radio']:checked").val();
        if(id){
            var address = $('#uaddress'+id).val();
            var zip = $('#uzip'+id).val();
            var city = $('#ucity'+id).val();

            $('#address').val(address);
            $('#zip').val(zip);
            $('#city').val(city);
        }
    });
    $(document).on('click', '.plus-btn', function(){
        var id = $(this).data('id');
        var qty = $('#qty'+id).html();
        qty = parseInt(qty) + 1;
        $('#qty'+id).html(qty);
        updateCart(id);
    });
    $(document).on('click', '.minus-btn', function(){
        var id = $(this).data('id');
        var qty = $('#qty'+id).html();
        if(parseInt(qty) > 1){
            qty = parseInt(qty) - 1;
            $('#qty'+id).html(qty);
            updateCart(id);
        } else {
            swal({
                title: "",
                text: "Are you sure? You want to delete this product from cart!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes",
                cancelButtonText: "{{__('Cancel')}}",
                closeOnConfirm: true
            },
            function(){
                removeFromCart(id);
            });
        }
    });

    $('#resend_otp').hide();
            $('.otp-section').hide();
            $('#booking_confirm').hide();
            $(document).on('click', '#send_otp', function(){
                var validateMobNum= /[1-9]{1}[0-9]{9}/;
                var mobile = $('#mobile').val();
                if (validateMobNum.test(mobile) && mobile.length == 10) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url : '{{ route('front_send-otp') }}',
                        method : 'post',
                        data : {_token: CSRF_TOKEN, mobile:mobile},
                        success : function(result){
                            var result = $.parseJSON(result);
                            if(result.result == 'success'){
                                $("#mobile").attr("readonly", "readonly");
                                $('.otp-section').show();
                                $('#send_otp').hide();
                                timer(20);
                            } else {
                                toastr.error('Something went wrong. Please try again later!');
                            }
                        }
                    });
                }
                else {
                    toastr.error('Please Enter Valid Mobile No.');
                }
            });

            $(document).on('click', '#verify_otp', function(){
                var mobile = $('#mobile').val();
                var otp = $('#otp').val();
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url : '{{ route('front_verify-otp') }}',
                    method : 'post',
                    data : {_token: CSRF_TOKEN, mobile:mobile, otp:otp},
                    success : function(result){
                        var result = $.parseJSON(result);
                        if(result.result == 'success'){
                            $('#verify_otp').hide();
                            $('#resend_text').hide();
                            $('#is_otp_verify').val('1');
                            $('#booking_confirm').show();
                            $("#mobile").attr("readonly", "readonly"); 
                            $('#otp').hide();
                        } else {
                            toastr.error('Please Enter Valid OTP.');
                        }
                    }
                });
            });

            $(document).on('click', '#resend_otp', function(){
                var validateMobNum= /[1-9]{1}[0-9]{9}/;
                var mobile = $('#mobile').val();
                if (validateMobNum.test(mobile) && mobile.length == 10) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url : '{{ route('front_resend-otp') }}',
                        method : 'post',
                        data : {_token: CSRF_TOKEN, mobile:mobile},
                        success : function(result){
                            var result = $.parseJSON(result);
                            if(result.result == 'success'){
                                console.log('test');
                                $('.otp-section').show();
                                $('#verify_otp').show();
                                $('#resend_text').show();
                                $('#otp').val('');
                                $('#otp').show();
                                $("#mobile").attr("readonly", "readonly");
                                $('#resend_otp').hide();
                                timer(20);
                            } else {
                                toastr.error('Something went wrong. Please try again later!');
                            }
                        }
                    });
                }
                else {
                    toastr.error('Please Enter Valid Mobile No.');
                }
            });
    function updateCart(cart_id){
        var qty = $('#qty'+cart_id).html();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url : '{{ route('front_update-cart') }}',
            method : 'post',
            data : {_token: CSRF_TOKEN, cart_id : cart_id, qty : qty},
            success : function(result){
                getCartAjaxHtml();
            }
        });
    }

    function getCartAjaxHtml(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url : '{{ route('front_cart-ajax-html') }}',
            method : 'post',
            data : {_token: CSRF_TOKEN},
            success : function(result){
                var result = $.parseJSON(result);
                if(result.status == 'success'){
                    $('.card-detial-sec-main').html(result.html);
                    var is_verify_otp = $('#is_otp_verify').val();
                    if(is_verify_otp == '0'){
                        $('#booking_confirm').hide();
                    }
                } else {
                    location.href="{{route('front_/')}}";
                }
            }
        });
    }

    function removeFromCart(cart_id){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url : '{{ route('front_remove-from-cart') }}',
            method : 'post',
            data : {_token: CSRF_TOKEN, cart_id : cart_id},
            success : function(result){
                getCartAjaxHtml();
                setCartItemCount();
            }
        });
    }
});
let timerOn = true;
        function timer(remaining) {
            var m = Math.floor(remaining / 60);
            var s = remaining % 60;
            m = m < 10 ? '0' + m : m;
            s = s < 10 ? '0' + s : s;
            document.getElementById('timer').innerHTML = m + ':' + s;
            remaining -= 1;
            if(remaining >= 0 && timerOn) {
              setTimeout(function() {
                  timer(remaining);
              }, 1000);
              return;
            }

            if(!timerOn) {
              // Do validate stuff here
              return;
            }
            // Do timeout stuff here
            var is_otp_verify = $('#is_otp_verify').val();
            if(is_otp_verify == '0'){
                $('#resend_otp').show();
                $("#mobile").removeAttr("readonly"); 
                $('#verify_otp').hide();
                $('#resend_text').hide();
                $('#otp').hide();
            }
        }
</script>
@endsection