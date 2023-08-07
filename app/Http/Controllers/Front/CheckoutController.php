<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Constant;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetails;
use Session;

class CheckoutController extends MainController
{
    public function index(request $request)
    {
        $return_data = array();
        $return_data['site_title'] = trans('Checkout');
        $cart = Session::get('cart');
//        dd($cart);
        if(empty($cart)){
            return redirect('/');
        }
        $cart_data = Cart::whereIn('id', $cart)->get();
        $return_data['cart_data'] = $cart_data;
        return view('front/checkout/index',array_merge($this->data,$return_data));
    }

    public function cartAjaxHtml(request $request){
        if($request->ajax()){
            $cart = Session::get('cart');
            $status = 'success';
            if(empty($cart)){
                $status = 'error';
            }
            $cart_data = Cart::whereIn('id', $cart)->get();
            $html = view('front/checkout/cart_ajax',array('cart_data' => $cart_data))->render();
            echo json_encode(array('status' => $status, 'html' => $html));
            exit;
        } else {
            return redirect('/');
        }
    }

    public function createOrder(request $request){
        $cart = Session::get('cart');
        if(empty($cart)){
            return redirect('/');
        }

        $payment_type = $request->payment_type;
        if($payment_type == Constant::OFFLINE){
            $order = new Order();
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

            $cart_data = Cart::with('productDetail')->whereIn('id', $cart)->get();
            if($cart_data->count() && $order){
                $order_id = $order->id;
                foreach($cart_data as $cdata){
                    $price = isset($cdata->productDetail->price) ? $cdata->productDetail->price : 0;
                    $qty = $cdata->qty;
                    $subtotal = $qty*$price;

                    $odetail = new OrderDetails();
                    $odetail->order_id = $order_id;
                    $odetail->product_id = $cdata->product_id;
                    $odetail->price = $price;
                    $odetail->qty = $qty;
                    $odetail->subtotal = $subtotal;
                    $odetail->save();

                    Cart::where('id', $cdata->id)->delete();
                }
                Session::put('cart', array());

                return redirect('/')->with('success', 'Your order created successfully.');
            }
        }
    }
}