@php($subtotal = $producttotal = $servicetotal = 0)
@php($is_service_available = 0)
@php($is_product_available = 0)
@if($cart_data->count())
    @foreach($cart_data as $item)
        
        <div class="service-name-text">
            <p>{{isset($item->serviceDetail->packageDetail->categoryDetail->title) ? $item->serviceDetail->packageDetail->categoryDetail->title : NULL}}</p>
        </div>
        <div class="service-add-main">
            <div class="service-name-text">
                @if(isset($item->product_id) && $item->product_id)
                    @php($is_product_available = 1)
                    <?php /* <img src="{{ $item->productDetail->primaryImage->image }}"  class="add-to-cart-img" alt=""> */ ?>
                    @if(isset($item->productDetail->primaryImage->image) && $item->productDetail->primaryImage->image)
                        <img src="{{ $item->productDetail->primaryImage->image }}"  alt="" class="add-to-cart-img" title="{{ isset($item->productDetail->primaryImage->image_title) ? $item->productDetail->primaryImage->image_title : '' }}">
                    @else
                        <img src="{{ asset('front/img/no_image.jpg') }}" class="img-fluid" alt="">
                    @endif 
                    <p>{{isset($item->productDetail->name) ? $item->productDetail->name : NULL}}</p>
                @endif
                @if(isset($item->service_id) && $item->service_id)
                    @php($is_service_available = 1)

                    @if(isset($item->serviceDetail->packageDetail->image) && $item->serviceDetail->packageDetail->image)
                        <img src="{{ asset('public/uploads/service/package/'.$item->serviceDetail->packageDetail->image )}}"  class="add-to-cart-img" alt="">
                    @else
                        <img src="{{ asset('front/img/no_image.jpg') }}" class="img-fluid" alt="">
                    @endif
                    <p>{{isset($item->serviceDetail->packageDetail->title) ? $item->serviceDetail->packageDetail->title : NULL}}</p>
                @endif
            </div>
            <div class="service-add-sec-main">
                @php($qty = $item->qty)
                @if(isset($item->product_id) && $item->product_id)
                    @php($unit_price = isset($item->productDetail->price) && $item->productDetail->price ? $item->productDetail->price : 0)
                    @php($item_total = $qty * $unit_price)
                    @php($subtotal = $subtotal + $item_total)
                    @php($producttotal = $producttotal + $item_total)
                    <p>₹{{formatNumber($item_total)}}</p>
                    <div class="frame">
                        <div class="plus-minus-main">
                            <div class="button plus-col minus-btn-col-1">
                                <a class="minus-btn" href="javascript:void(0);" data-id="{{$item->id}}" data-product_id="{{$item->product_id}}"><i class="fa-solid fa-trash-can"></i></a>
                            </div>
                            <div class="number plus-col text-btn-col-2">
                                <p class="count" id="qty{{$item->id}}">{{$qty}}</p>
                            </div>
                            <div class="button plus-col plus-btn-col-1">
                                <a class="plus-btn" href="javascript:void(0);" data-id="{{$item->id}}" data-product_id="{{$item->product_id}}"><i class="fa-solid fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                @endif
                @if(isset($item->service_id) && $item->service_id)
                    @php($unit_price = isset($item->serviceDetail->price) && $item->serviceDetail->price ? $item->serviceDetail->price : 0)
                    @php($item_total = $qty * $unit_price)
                    @php($subtotal = $subtotal + $item_total)
                    @php($servicetotal = $servicetotal + $item_total)
                    <p>₹{{formatNumber($item_total)}}</p>
                    <div class="frame">
                        <div class="plus-minus-main">
                            <div class="button plus-col minus-btn-col-1">
                                <a href="javascript:void(0);" class="minus-btn" data-id="{{$item->id}}" data-service_id="{{$item->service_id}}"><i class="fa-solid fa-trash-can"></i></a>
                            </div>
                            <div class="number plus-col text-btn-col-2">
                                <p class="count" id="qty{{$item->id}}">{{$qty}}</p>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="time_takes" value="{{isset($item->serviceDetail->packageDetail->time_takes) ? $item->serviceDetail->packageDetail->time_takes : ''}}">
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <p class="cart-car-brandname">{{isset($item->serviceDetail->brandDetail->title) ? $item->serviceDetail->brandDetail->title : NULL}}</p>
            </div>
            <div class="col-5">
                <p class="cart-car-modalname">{{isset($item->serviceDetail->modelDetail->title) ? $item->serviceDetail->modelDetail->title : NULL}}</p>
            </div>
            <div class="col-3">
                <p class="cart-car-brandname">{{isset($item->serviceDetail->fuelTypeDetail->title) ? $item->serviceDetail->fuelTypeDetail->title : NULL}}</p>
            </div>
        </div>
    @endforeach
@endif

<div class="item-total-sec-main item-total-sec-border">
    <p>Item Total</p>
    <p>₹{{formatNumber($subtotal)}}</p>
</div>
@php($pgst_val = $sgst_val = 0)
@if($is_product_available == 1)
    <div class="item-total-sec-main">
        @php($pgst_val = $product_gst && $producttotal ? ($producttotal*$product_gst)/100 : 0)
        <p>
            @if($is_product_available == 1 && $is_service_available == 1) 
                Product Gst({{$product_gst}} %)
            @else
                Gst({{$product_gst}} %)
            @endif
        </p>
        <p>₹{{formatNumber($pgst_val)}}</p>
    </div>
@endif
@if($is_service_available == 1)
    <div class="item-total-sec-main">
        @php($sgst_val = $service_gst && $servicetotal ? ($servicetotal*$service_gst)/100 : 0)
        <p>
            @if($is_service_available == 1 && $is_service_available == 1) 
                Service GST({{$service_gst}} %)
            @else
                Gst({{$service_gst}} %)
            @endif
        </p>
        <p>₹{{formatNumber($sgst_val)}}</p>
    </div>
@endif
@php($total = $subtotal + $pgst_val + $sgst_val)
<div class="you-pay-sec-main">
    <p>You Pay</p>
    <p>₹{{formatNumber($total)}}</p>
</div>
<div>
    <input type="hidden" name="subtotal" value="{{$subtotal}}">
    <input type="hidden" name="product_gst" value="{{$pgst_val}}">
    <input type="hidden" name="service_gst" value="{{$sgst_val}}">
    <input type="hidden" name="order_total" value="{{$total}}">
    <input type="hidden" name="is_service_in_cart" value="{{$is_service_available}}">
    <a class="btn confirm-booking-btn d-none" id="loading_btn">
        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
        Loading...
    </a>
    <button class="confirm-booking-btn" id="booking_confirm" type="submit">CONFIRM BOOKING</button>
</div>
