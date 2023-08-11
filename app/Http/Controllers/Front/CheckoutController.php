<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Constant;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\UserAddress;
use App\Models\PickUpSlotSetting;
use App\Models\BookedSlot;
use Auth;
use Session;

class CheckoutController extends MainController
{
    public function index(request $request)
    {
        $return_data = array();
        $return_data['site_title'] = trans('Checkout');
        $pcart = Session::get('pcart');
        $scart = Session::get('scart');
        if(empty($pcart) && empty($scart)){
            return redirect('/');
        }
        $cart_ids = array();
        if(isset($scart['cart_id']) && $scart['cart_id']){
            array_push($cart_ids, $scart['cart_id']);
        }
        if($pcart && is_array($pcart)){
            foreach($pcart as $pval){
                if(isset($pval['cart_id']) && $pval['cart_id']){
                    array_push($cart_ids, $pval['cart_id']);
                }
            }
        }
        $cart_data = Cart::whereIn('id', $cart_ids)->get();
        $return_data['cart_data'] = $cart_data;

        $user_id = Auth::guard('user')->check() ? Auth::guard('user')->user()->id : NULL;
        if($user_id){
            $addresses = UserAddress::where('user_id', $user_id)->get();
            $return_data['addresses'] = $addresses;
        }
        $aslots = PickUpSlotSetting::select('id', 'time', 'slot')->where('slot', Constant::AFTERNOON)->orderBy('id')->get();
        $eslots = PickUpSlotSetting::select('id', 'time', 'slot')->where('slot', Constant::EVENING)->orderBy('id')->get();
        $return_data['aslots'] = $aslots;
        $return_data['eslots'] = $eslots;
        return view('front/checkout/index',array_merge($this->data,$return_data));
    }

    public function cartAjaxHtml(request $request){
        if($request->ajax()){
            $status = 'success';
            $pcart = Session::get('pcart');
            $scart = Session::get('scart');
            if(empty($pcart) && empty($scart)){
                $status = 'error';
            }
            $cart_ids = array();
            if(isset($scart['cart_id']) && $scart['cart_id']){
                array_push($cart_ids, $scart['cart_id']);
            }
            if($pcart && is_array($pcart)){
                foreach($pcart as $pval){
                    if(isset($pval['cart_id']) && $pval['cart_id']){
                        array_push($cart_ids, $pval['cart_id']);
                    }
                }
            }
            $cart_data = Cart::with('productDetail', 'serviceDetail')->whereIn('id', $cart_ids)->get();
            $html = view('front/checkout/cart_ajax',array('cart_data' => $cart_data))->render();
            echo json_encode(array('status' => $status, 'html' => $html));
            exit;
        } else {
            return redirect('/');
        }
    }

    public function createOrder(request $request){
        $pcart = Session::get('pcart');
        $scart = Session::get('scart');
        if(empty($pcart) && empty($scart)){
            return redirect('/');
        }

        $payment_type = $request->payment_type;
        if($payment_type == Constant::OFFLINE){
            $user_id = Auth::guard('user')->check() ? Auth::guard('user')->user()->id : NULL;
            $checkout_type = $user_id ? Constant::USER_CHECKOUT : Constant::GUEST_CHECKOUT;

            $order = new Order();
            $order->is_guest_chekout = $checkout_type;
            $order->payment_type = $payment_type;
            $order->name = $request->name;
            $order->email = $request->email;
            $order->phone = $request->mobile;
            $order->address = $request->address;
            $order->zip = $request->zip;
            $order->city = $request->city;
            $order->total = $request->order_total;
            $order->order_date = date('Y-m-d');
            $order->save();

            $cart_ids = array();
            if(isset($scart['cart_id']) && $scart['cart_id']){
                array_push($cart_ids, $scart['cart_id']);
            }
            if($pcart && is_array($pcart)){
                foreach($pcart as $pval){
                    if(isset($pval['cart_id']) && $pval['cart_id']){
                        array_push($cart_ids, $pval['cart_id']);
                    }
                }
            }
            $cart_data = Cart::with('productDetail')->whereIn('id', $cart_ids)->get();
            if($cart_data->count() && $order){
                $order_id = $order->id;
                foreach($cart_data as $cdata){
                    $price = 0;
                    if($cdata->product_id){
                        $price = isset($cdata->productDetail->price) ? $cdata->productDetail->price : 0;
                    }
                    if($cdata->service_id){
                        $price = isset($cdata->serviceDetail->price) ? $cdata->serviceDetail->price : 0;
                    }
                    $qty = $cdata->qty;
                    $subtotal = $qty*$price;

                    $odetail = new OrderDetails();
                    $odetail->order_id = $order_id;
                    $odetail->product_id = $cdata->product_id;
                    $odetail->service_id = $cdata->service_id;
                    $odetail->price = $price;
                    $odetail->qty = $qty;
                    $odetail->subtotal = $subtotal;
                    $odetail->save();

                    if($cdata->service_id){
                        $slot_time = $request->slot_time;
                        $slot_time = str_replace(' ', '', $slot_time);
                        $slotarray = explode('-', $slot_time);
                        $slot2 = isset($slotarray[1]) ? $slotarray[1] : NULL;
                        $time_type = 1;
                        if( $slot2 && strpos( $slot2, "AM" ) !== false) {
                            $time_type = 0;
                        }
                        $slot2 = str_replace('AM', '', $slot2);
                        $slot2 = str_replace('PM', '', $slot2);
                        
                        $slot = new BookedSlot();
                        $slot->user_id = $user_id;
                        $slot->order_id = $order_id;
                        $slot->order_detail_id = $odetail->id;
                        $slot->slot_date = $request->slot_date;
                        $slot->pick_up_time1 = isset($slotarray[0]) ? $slotarray[0] : NULL;
                        $slot->pick_up_time2 = $slot2;
                        $slot->time_type = $time_type;
                        $slot->time_takes = isset($request->time_takes) ? $request->time_takes : NULL;
                        $slot->service_id = $cdata->service_id;
                        $slot->save();
                    }
                    Cart::where('id', $cdata->id)->delete();
                }
                Session::put('scart', array());
                Session::put('pcart', array());

                $address_radio = $request->address_radio;
                if(empty($address_radio) && $user_id){
                    $address = new UserAddress();
                    $address->address = $request->address;
                    $address->zip = $request->zip;
                    $address->city = $request->city;
                    $address->user_id = $user_id;
                    $address->save();
                }
                return redirect('thank-you')->with('success', 'Your order created successfully!');
            }
        }
    }

    public function thankYou(request $request){
        $return_data = array();
        $return_data['site_title'] = trans('Thank you');
        return view('front/thank_you',array_merge($this->data,$return_data));
    }
}