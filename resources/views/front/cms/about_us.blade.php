@extends('front.layout.main')
@section('content')

<div class="about-banner">
    <img src="{{ asset('front/img/jdf.jpg') }}" alt="" width="100%">
</div>

<!-- about section start  -->
<div class="container">
    <div class="about-main-sec">
        <!-- <h1>{{ strtoupper($site_title) }}</h1> -->
        <h2>AUTO CAR REPAIR</h2>
        <p class="about-text">Auto Car Repair, incorporated in April 2022, is a proud addition to The Sachdev Group, a trusted provider of automotive solutions in Delhi (NCR) for decades. Leveraging our extensive experience and expertise in the automotive industry, we aim to elevate the standards of automotive solutions through Auto Car Repair, our multi-brand car service center.</p>
    </div>
    <div class="row align-items-center about-image-text-main">
        <div class="col-12 col-sm-6">
            <div>
                <img src="{{ asset('front/img/our mission copy.webp') }}" class="img-fluid" alt="">
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <h4>Our Mission - Exceptional Service</h4>
            <p>Our primary mission is to deliver exceptional automotive repair and maintenance services to our valued customers. We are committed to ensuring that every customer who entrusts their vehicle to us leaves with a car that runs smoothly and safely.</p>
        </div>

    </div>


    <div class="row align-items-center about-image-text-main">
     
        <div class="col-12 col-sm-6">
            <h4>Our Vision - Seamless Experience</h4>
            <p>Our vision is to create a seamless experience for our customers, characterized by transparency, efficiency, and convenience. We believe that every interaction with our service center should be straightforward and hassle-free, from booking an appointment to picking up a fully serviced vehicle.</p>
        </div>

        <div class="col-12 col-sm-6">
            <div>
                <img src="{{ asset('front/img/our vision copy.webp') }}" class="img-fluid" alt="">
            </div>
        </div>

    </div>


    <div class="row align-items-center about-image-text-main">
        <div class="col-12 col-sm-6">
            <div>
                <img src="{{ asset('front/img/tech and skilled (1).webp') }}" class="img-fluid" alt="">
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <h4>Technology and Skilled Technicians</h4>
            <p>At Auto Car Repair, we pride ourselves on staying at the forefront of automotive technology. Our service center is equipped with cutting-edge diagnostic tools and staffed by highly skilled technicians. This combination enables us to redefine excellence in multi-brand car services, ensuring that our customers receive the best possible care for their vehicles.</p>
        </div>

    </div>


     <div class="row align-items-center about-image-text-main">
     
        <div class="col-12 col-sm-6">
            <h4>Precision, Accuracy, and Speed</h4>
            <p>To achieve our vision, we rely on state-of-the-art diagnostic tools and advanced repair techniques. These tools and techniques allow us to service every car with the utmost precision, accuracy, and speed, ensuring that your vehicle is returned to you in optimal condition.</p>
        </div>

        <div class="col-12 col-sm-6">
            <div>
                <img src="{{ asset('front/img/precision.webp') }}" class="img-fluid" alt="">
            </div>
        </div>
    </div>


    <div class="row align-items-center about-image-text-main">
        <div class="col-12 col-sm-6">
            <div>
                <img src="{{ asset('front/img/relationship.webp') }}" class="img-fluid" alt="">
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <h4>Building Long-Lasting Relationships</h4>
            <p>We value the relationships we build with our customers. Transparency in communication, competitive pricing, and providing reliable solutions are the cornerstones of our commitment to building long-lasting connections with those who trust us with their vehicles.</p>
        </div>

    </div>



     <div class="row align-items-center about-image-text-main">
     
        <div class="col-12 col-sm-6">
            <h4>Future Vision - Comprehensive Solutions</h4>
            <p>Looking ahead, our vision for Auto Car Repair is to become the go-to destination for car owners, regardless of their vehicle's make or model. We aspire to offer comprehensive solutions, encompassing all aspects of car repair and maintenance.</p>
        </div>

        <div class="col-12 col-sm-6">
            <div>
                <img src="{{ asset('front/img/future vision.webp') }}" class="img-fluid" alt="">
            </div>
        </div>
    </div>


    
    <div class="row align-items-center about-image-text-main">
        <div class="col-12 col-sm-6">
            <div>
                <img src="{{ asset('front/img/Embracing Innovation and Sustainability.webp') }}" class="img-fluid" alt="">
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <h4>Embracing Innovation and Sustainability</h4>
            <p>We intend to lead the way in embracing new technologies, eco-friendly practices, and industry best practices. By setting the standard for excellence in car repairs and customer satisfaction, we aim to be at the forefront of the automotive service industry's evolution.</p>
        </div>

    </div>


     <div class="row align-items-center about-image-text-main">
     
        <div class="col-12 col-sm-6">
            <h4>Passion for Vehicle Health</h4>
            <p>Above all, our passion lies in keeping your vehicles in optimal condition, allowing you to drive with confidence and peace of mind. Your vehicle's well-being is our top priority, and we are dedicated to achieving this through our commitment to excellence and customer-centric approach.</p>
        </div>

        <div class="col-12 col-sm-6">
            <div>
                <img src="{{ asset('front/img/CAR HEALTH.webp') }}" class="img-fluid" alt="">
            </div>
        </div>
    </div>



</div>





{{-- advantage  --}}

<section id="advantage-acr">
    <div class="container">
        <div class="advantage-parent">
            <div class="advantage-one">
                <img src="{{ asset('front/img/1 (3).webp') }}" alt="">
                <div class="advantage-content">
                    <h3>Pre-Owned Workshop</h3>
                    <p>We are not just an aggregator, but operate our own workshop ensuring a complete control over quality and pricing.</p>
                </div>
            </div>
            <div class="advantage-one">
                <img src="{{ asset('front/img/2 (2).webp') }}" alt="">
                <div class="advantage-content">
                    <h3>Competitive Price Range</h3>
                    <p>With no middlemen involved, we pass on the savings to you, offering top-notch services at affordable rates.</p>
                </div>
            </div>
            <div class="advantage-one">
                <img src="{{ asset('front/img/3.webp') }}" alt="">
                <div class="advantage-content">
                    <h3>High-Quality Services</h3>
                    <p>Witness excellence firsthand as we perform services right before your eyes, guaranteeing top-tier quality.</p>
                </div>
            </div>
            <div class="advantage-one">
                <img src="{{ asset('front/img/4 (2).webp') }}" alt="">
                <div class="advantage-content">
                    <h3>Experienced Professionals</h3>
                    <p>Our seasoned experts boast of years of hands-on experience in the automotive industry.
                    </p>
                </div>
            </div>

            <div class="advantage-one">
                <img src="{{ asset('front/img/5 (2).webp') }}" alt="">
                <div class="advantage-content">
                    <h3>Genuine Products</h3>
                    <p>Your vehicle is our priority, and we treat it with the best by using high-quality genuine products.
                    </p>
                </div>
            </div>

            <div class="advantage-one">
                <img src="{{ asset('front/img/6.webp') }}" alt="">
                <div class="advantage-content">
                    <h3>No Hidden Charges</h3>
                    <p>Our transparent pricing means you won't encounter surprise fees – we inform you upfront, ensuring peace of mind.
                    </p>
                </div>
            </div>       
        </div>
    </div>
</section>


<style>
    .about-main-sec{
        padding: 30px 0px;
    }
    .about-main-sec h2{
        text-align: center;
        font-weight: 700;
    }
    .advantage-parent{
        display: flex;
        flex-wrap: wrap;
        text-align: center;
        gap: 10px;

    }
    #advantage-acr{
        padding: 30px 0px;
    }
    .advantage-content h3{
        font-size: 18px;
        font-weight: 700;
        }
    .advantage-one{
        border: 2px solid #E56F31;
        padding: 10px;
        width: 32%;
    }
    .advantage-one img{
        margin-bottom: 8px
    }
    .advantage-content p{
        margin-bottom: 0px;
    }

    @media only screen and (max-width: 600px) {
  .advantage-one{
    width: 100%
  }
}



</style>

<!-- about brand logo  slider start  -->
<!--<div class="aboutus-logo-section">-->
<!--   <div class="container">-->

<!--   </div>-->
<!--</div>-->
<!-- about brand logo  slider end -->
<!-- about section  end -->
@endsection