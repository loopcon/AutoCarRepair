@extends('front.layout.main')
@section('css')
    <style>
        .icon{
            height:30px;
            width:30px;
        }
        #note{
            font-size: 10px;
        }
        .loan-detail-form{
            width: 40%;
        }
    </style>
    <link class="js-stylesheet" href="{{ asset('plugins/parsley/parsley.css') }}" rel="stylesheet">
@endsection
@section('content')
    <a id="button"></a>
    <!-- section-1 -->
    <section>
        <div class="test-car loan-car" style="background-image: url({{ url('front/img/register.jpg') }});">
            <div class="container">
                <div class="row">
                    <div class="test-car-text">
                        <h1 class="test-car-title color-white font-bebas fz-64">Forgot Password </h1>
                        <p class="test-car-desc color-white fz-24 "></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section-1 end -->
    <!-- section-2 -->
    <section>
        <div class="login-acc loan-acc insurance-acc">
           <?php /*  <div class="shape-1">
                <img src="{{ url('front/img/shape-7.png')}}" alt="shape-7" class="img-fluid">
            </div> */ ?>
            <div class="loan-form">
                <div class="d-flex justify-content-between flex-wrap">
                    <div class="loan-detail-form">
                        <form method="post" action="{{route('front_forgot-password')}}" data-parsley-validate=''>
                            @csrf
                            <h4 class="font-bebas fz-24 text-center">Forgot Password Form</h4>
                            <div class="email-1">
                                <input type="email" name="email" placeholder="EMAIL ID" required="" class="form-control ">
                            </div>
                            <div class="submit-details" id="submit-sec">
                                <button type="submit" class="btn btn-submit">Submit <img src="{{ url('front/img/arrow-loan-right.svg') }}"></button>
                            </div>
                        </form>
                    </div>
                    <img src="{{ url('front/img/insurance-policy.webp') }}" alt="insurance" class="loan-img img-fluid d-block">
                </div>
            </div>
    </section>
    <!-- section-2 end -->
    <!-- section-3 -->
    <section>
        <div class="verification insurance-verification">
            
        </div>
    </section>
    <!-- section-3 end-->

    <!-- section-9 -->
    <section>
        <?php /* <div class="section-bottom-space">
            <div class="shape-1">
                <img src="{{ url('front/img/shape-4.png')}}" alt="shape-4" class="img-fluid">
            </div>
            <div class="shape-2">
                <img src="{{ url('front/img/shape-5.png')}}" alt="shape-5" class="img-fluid">
            </div>
        </div> */ ?>
    </section>
    <!-- section-9 end-->
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('javascript')
    <script src="{{ asset('plugins/parsley/parsley.js') }}"></script>
    <script>
        $(document).ready(function(){
        });
    </script>
@endsection