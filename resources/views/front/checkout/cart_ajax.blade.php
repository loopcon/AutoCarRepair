@php($subtotal = 0)
@if($cart_data->count())
    @foreach($cart_data as $item)
        <div class="service-add-main">
            <div class="service-name-text">
                @if(isset($item->productDetail->primaryImage->image) && $item->productDetail->primaryImage->image)
                    <img src="{{ asset('public/uploads/product/'.$item->product_id.'/'.$item->productDetail->primaryImage->image) }}"  class="add-to-cart-img" alt="">
                @else
                    <img src="{{ asset('front/img/no_image.jpg') }}" class="img-fluid" alt="">
                @endif
                <p>{{isset($item->productDetail->name) ? $item->productDetail->name : NULL}}</p>
            </div>
            <div class="service-add-sec-main">
                @php($qty = $item->qty)
                @php($unit_price = isset($item->productDetail->price) && $item->productDetail->price ? $item->productDetail->price : 0)
                @php($item_total = $qty * $unit_price)
                @php($subtotal = $subtotal + $item_total)
                <p>₹{{formatNumber($item_total)}}</p>
                <div class="frame">
                    <div class="plus-minus-main">
                          <div class="button plus-col minus-btn-col-1">
                              <button class="minus-btn" data-id="{{$item->id}}" data-product_id="{{$item->product_id}}"><i class="fa-solid fa-trash-can"></i></button>
                          </div>
                          <div class="number plus-col text-btn-col-2">
                              <h1 class="count" id="qty{{$item->id}}">{{$qty}}</h1>
                          </div>
                          <div class="button plus-col plus-btn-col-1">
                              <button class="plus-btn" data-id="{{$item->id}}" data-product_id="{{$item->product_id}}"><i class="fa-solid fa-plus"></i></button>
                        </div>
                      </div>
                  </div>
            </div>
        </div>
    @endforeach
@endif

<div class="item-total-sec-main">
    <p>Item Total</p>
    <p>₹{{formatNumber($subtotal)}}</p>
</div>
<div class="you-pay-sec-main">
    <p>You Pay</p>
    <p>₹{{formatNumber($subtotal)}}</p>
</div>
<div>
    <input type="hidden" name="order_total" value="{{$subtotal}}">
    <button class="confirm-booking-btn" id="booking_confirm"> Confirm Booking</button>
</div>
