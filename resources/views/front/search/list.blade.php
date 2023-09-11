@extends('front.layout.main')
@section('content')
<!-- shoping page start  -->
<div class="shoping-breadcrum-bg shoping-category-bg">
    <div class="container">
        <ul class="shoping-breadcrum-main">
            <li><a href="{{url('shopping')}}">Search </a></li>
            <li><i class="fa-solid fa-chevron-right"></i></li>
            <li>Product</li>
        </ul>
    </div>
</div>

<div class="shopping-section">
    <div class="container">
        <div class="row">
            <div class=" col-12  col-md-12 col-lg-12">
                <div class="row" id="search_ajax_list">
                    @if($products)
                        @foreach($products as $product)
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                <a href="{{url('shopping/'.$product->slug)}}">
                                    <div class="shoping-main-product">
                                        @if(!empty($product->primaryImage) && isset($product->primaryImage->image))
                                            <img src="{{ $product->primaryImage->image }}"  alt="" title="{{ isset($product->primaryImage->image_title) ? $product->primaryImage->image_title : '' }}">
                                        @else
                                            <img src="{{ asset('front/img/no_image.jpg') }}" class="img-fluid" alt="" title="no_image">
                                        @endif
                                        <?php /* @if(isset($product->primaryImage->image) && $product->primaryImage->image)
                                            <img src="{{ asset('public/uploads/product/'.$product->id.'/'.$product->primaryImage->image) }}"  alt="" title="{{isset($product->primaryImage->image_title) ? $product->primaryImage->image_title : ''}}">
                                        @else
                                            <img src="{{ asset('front/img/no_image.jpg') }}" class="img-fluid" alt="" title="no_image">
                                        @endif */ ?>
                                        <div class="shoping-text-name">
                                            <h5><a href="{{url('shopping/'.$product->slug)}}">{{$product->name}}</a></h5>
                                            <h5>{{isset($product->shopCategoryDetail->name) ? $product->shopCategoryDetail->name : ''}}</h5>
                                        </div>
                                        <div class="shoping-card-prise">
                                            <div class="shoping-card-text"><p>₹{{formatNumber($product->price)}}</p></div>
                                          <?php /*  <div class="shoping-star-group">
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                            </div> */ ?>
                                        </div>
                                        <button class="shop-add-btn add_to_cart" data-product_id="{{$product->id}}">Add to cart</button>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                        <div class="pagination-main">
                            <div class="pagination justify-content-center">
                                {{ $products->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection