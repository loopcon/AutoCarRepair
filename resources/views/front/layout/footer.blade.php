<!-- footer start  -->
<div class="footer-bg-main">
    <div class="footer-widthset">  
        <div class="row m-0">
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="footer-img-main">
                    <img src="{{ asset('front/img/acr-logo.png') }}"  alt="">
                    <p>{{$footer_description}}</p>
                </div>
                
            </div>
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="row m-0">
                    <div class="col-2">
                        <img src="{{ asset('front/img/footer-location.png') }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-10 footer-address">
                        <p>{!! $address !!}</p>
                    </div>
                </div>
                <div class="row m-0 footer-email-main">
                    <div class="col-2">
                        <img src="{{ asset('front/img/footer-email.png') }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-10 footer-email">
                        <p>Email US:</p>
                        <a href="mailto:{{$email}}">{{$email}}</a>
                    </div>
                </div>
                <div class="row m-0 footer-call-main">
                    <div class="col-2">
                        <img src="{{ asset('front/img/footer-call.png') }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-10 footer-call">
                        <p>Call:</p>
                        <a href="tel:{{$phone}}"> {{$phone}} </a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-2">
                <ul class="fot-about-main">
                    @php($cmsInfo = getCmsPageName('1'))
                    @if(isset($cmsInfo->slug) && $cmsInfo->slug)
                        <li><a class="fot-about-main-header" href="{{url($cmsInfo->slug)}}">{{isset($cmsInfo->name) ? ucwords($cmsInfo->name) : ''}}</a></li>
                    @endif
                    <li><a href="{{url('faq')}}#">FAQs</a></li>
                    <li><a href="#">Blogs</a></li>
                    <li><a href="{{url('contact-us')}}">Contact US</a></li>
                    @php($cmsInfo = getCmsPageName('10'))
                    @if(isset($cmsInfo->slug) && $cmsInfo->slug)
                        <li><a href="{{url($cmsInfo->slug)}}">{{isset($cmsInfo->name) ? ucwords($cmsInfo->name) : ''}}</a></li>
                    @endif
                </ul>
            </div>
            <div class="col-10 col-sm-4 col-lg-2">
                <ul class="fot-ourservice-main">
                    <li><a class="fot-ourservice-heading" href="{{route('front_our-services')}}">Our Services</a></li>
                    @php($services = getServiceCategory())
                    @if($services->count())
                        @foreach($services as $service)
                            <li><a href="#">{{$service->title}}</a></li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <div class="col-2 col-sm-2 col-lg-1 footer-msgimg-main">
                <img src="{{ asset('front/img/footer-msg.png') }}" class="img-fluid" alt="">
            </div>  
        </div>
    </div>
</div>
<!-- footer end  -->
<!-- footer down start -->
    <div class="footet-down-bg">
        <div class="footet-down-main">
            <div class="row m-0">
                <div class="col-12 col-sm-6  col-md-4 main-soical-icon">
                    <p>Follow Us:  </p>
                    <div>
                        <a href="https://{{$facebook}}" target="blank"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="https://{{$twitter}}" target="blank"><i class="fa-brands fa-twitter"></i></a>
                        <a href="https://{{$linkedin}}" target="blank"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="https://{{$instagram}}" target="blank"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://{{$youtube}}" target="blank"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-5 copy-right-text-main">
                    <p>© {{$copyright_year}} - {{$site_name}} - All rights reserved</p>
                </div>
                <div class="col-12 col-sm-6 col-md-3 back-top-main">
                    <p>Back to Top </p>
                    <img src="{{ asset('front/img/back-top.png') }}" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </div>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- footer down end -->
<script src="{{ asset('front/js/jquery.min.js') }}"></script>
<script src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('front/js/all.min.js') }}"></script>
<script src="{{ asset('plugins/notification/toastr.min.js') }}"></script>
<script src="{{asset('plugins/sweetalert/sweetalert.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        basic();
        // notification //
        <?php if (Session::get('error')) : ?>
            toastr.error('<?php echo Session::get('error') ?>');
        <?php endif; ?>
        <?php if (Session::get('errors')) : ?>
            toastr.error('<?php echo Session::get('errors')->first() ?>');
        <?php endif; ?>
        <?php if (Session::get('success')) : ?>
            toastr.success('<?php echo Session::get('success') ?>');
        <?php endif; ?>
        <?php if (Session::get('warning')) : ?>
            toastr.warning('<?php echo Session::get('warning') ?>');
        <?php endif; ?>

        $('.btn-toggle-item').click(function(){
            $('.mobile-toggle-data').toggle();
        });

        $(document).on('keyup', '#search_brand', function(){
            var search_brand = $(this).val();
            searchBrand(search_brand);
        });

        $(document).on('click', '.amodal-brand', function(){
            var brand_id = $(this).data('id');
            modelFromBrandSearch(brand_id, '');
        });

        $(document).on('keyup', '#search_model', function(){
            var search_model = $(this).val();
            var brand_id = "{{session()->get('brand_id')}}";
            modelFromBrandSearch(brand_id, search_model);
        });

        $(document).on('click', '.amodal-model', function(){
            var model_id = $(this).data('id');
            fuelFromModelSearch(model_id, '');
        });

        $(document).on('keyup', '#search_fuel', function(){
            var search_fuel = $(this).val();
            fuelFromModelSearch('', search_fuel);
        });

        $(document).on('click', '.amodal-fuel', function(){
            var fuel_id = $(this).data('id');
            appointmentnumberModal(fuel_id);
        });

        $(document).on('click', '.apt-btn', function(){
            appointmentnumberModal(fuel_id = '');
        });
        $('#appointmentselectModal').on('hidden.bs.modal', function() {
            $('#search_brand').val('');
        });
        $('#appointmentsearchModal').on('hidden.bs.modal', function() {
            $('#search_model').val('');
        });
        $('#appointmentfuelModal').on('hidden.bs.modal', function() {
            $('#search_fuel').val('');
        });
    });
    function basic(){
        $("input").attr("autocomplete", "off");
        $("textarea").attr("autocomplete", "off");
        $("input[type=password]").attr("autocomplete", "new-password");
        $(".numeric").bind("keypress", function (e) {
            var keyCode = e.which ? e.which : e.keyCode;
            if (!((keyCode >= 48 && keyCode <= 57) || keyCode == 46)) {
                return false;
            }
        });
        $(".num_only").bind("keypress", function (e) {
            var keyCode = e.which ? e.which : e.keyCode;
            if (!((keyCode >= 48 && keyCode <= 57))) {
                return false;
            }
        });
        $(document).on('keypress', '.alphabetic', function (event) {
            var regex = new RegExp("^[a-zA-Z ]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        });
        setCartItemCount();
    }
    function PreviewImage(no) 
    {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadImage"+no).files[0]);
        oFReader.onload = function (oFREvent) 
        {
            document.getElementById("uploadPreview"+no).src = oFREvent.target.result;
            $('#uploadPreview'+no).removeClass('npPreviewImage');
            $('#uploadPreview'+no).addClass('previewImage');
            $('#uploadPreview'+no).css('width', '250px');
        };
    }

    function setCartItemCount(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url : '{{ route('front_cart-item-count') }}',
            method : 'post',
            data : {_token: CSRF_TOKEN},
            success : function(result){
                var result = $.parseJSON(result);
                if(result.total){
                    $('#cart_header_total_item').html('('+result.total+')');
                }
            }
        });
    }

    function searchBrand(search_brand = ''){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url : '{{ route('front_search-brand') }}',
            method : 'post',
            data : {_token: CSRF_TOKEN, brand: search_brand},
            success : function(result){
                var result = $.parseJSON(result);
                $('#amodal_brands').html(result.html);
            }
        });
    }

    function modelFromBrandSearch(brand_id = '', search_model = ''){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url : '{{ route('front_model-from-brand-modal') }}',
            method : 'post',
            data : {_token: CSRF_TOKEN, brand_id: brand_id, model:search_model},
            success : function(result){
                var result = $.parseJSON(result);
                $('#amodal_models').html(result.html);
                $('#appointmentsearchModal').modal('show');
                $('#appointmentselectModal').modal('hide');
            }
        });
    }

    function fuelFromModelSearch(model_id = '', search_fuel = ''){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url : '{{ route('front_search-fuel-from-model') }}',
            method : 'post',
            data : {_token: CSRF_TOKEN, model_id: model_id, fuel: search_fuel},
            success : function(result){
                var result = $.parseJSON(result);
                $('#amodal_fuels').html(result.html);
                $('#appointmentfuelModal').modal('show');
                $('#appointmentsearchModal').modal('hide');
            }
        });
    }

    function appointmentnumberModal(fuel_id){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url : '{{ route('front_appoitment-number-modal') }}',
            method : 'post',
            data : {_token: CSRF_TOKEN, fuel_id: fuel_id},
            success : function(result){
                var result = $.parseJSON(result);
                $('#appointmentfuelModal').modal('hide');
                if(result.result == 'success' && result.type == 'number'){
                    $('#search_info').html(result.html);
                    $('#appointmentnumberModal').modal('show');
                } else if(result.result == 'success' && result.type == 'fuel'){
                    fuelFromModelSearch();
                } else if(result.result == 'success' && result.type == 'model'){
                    modelFromBrandSearch();
                } else {
                    $('#appointmentselectModal').modal('show');
                }
            }
        });
    }
</script>
@yield('javascript')
</body>
</html>