<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Constant;
use App\Models\Cart;
use Session;
use Auth;

class CartController extends MainController
{
    public function add(request $request)
    {
        if($request->ajax()){
            $cart_id = NULL;
            $user_id = Auth::guard('user')->check() ? Auth::guard('user')->user()->id : NULL;
            $product_cart = Session::get('pcart') ? Session::get('pcart') : array();
            $service_cart = Session::get('scart') ? Session::get('scart') : array();
            if(isset($request->product_id) && $request->product_id){
                if(isset($product_cart[$request->product_id]) && $product_cart[$request->product_id]){
                    $cart_id = isset($product_cart[$request->product_id]['cart_id']) && $product_cart[$request->product_id]['cart_id'] ? $product_cart[$request->product_id]['cart_id'] : NULL;
                }
            }
            if(isset($request->service_id) && $request->service_id){
                if(isset($service_cart['service']) && $service_cart['service']){
//                   dd($service_cart);
                    $cart_id = isset($service_cart['cart_id']) && $service_cart['cart_id'] ? $service_cart['cart_id'] : NULL;
                }
            }

            $cfields = array('product_id', 'service_id', 'qty');

            if($cart_id){
                $cart_data = Cart::find($cart_id);
                $qty = $cart_data->qty;
                if(isset($cart_data->service_id) && $cart_data->service_id){
                    $request->qty = $request->qty;
                } else {
                    $request->qty = $request->qty + $qty;
                }
                
            } else {
                $cart_data = new Cart();
            }
            foreach($cfields as $cfield){
                $cart_data->$cfield = isset($request->$cfield) && $request->$cfield != '' ? $request->$cfield : NULL;
            }
            $cart_data->user_id = $user_id;
            $cart_data->save();
            $cart_id = $cart_data->id;

            if(isset($request->product_id) && $request->product_id){
                $product_cart[$request->product_id] = array('cart_id' => $cart_id, 'qty' => $request->qty);
                Session::put('pcart', $product_cart);
            }
            if(isset($request->service_id) && $request->service_id){
                $service_cart['service'] = $request->service_id;
                $service_cart['cart_id'] = $cart_id;
                Session::put('scart', $service_cart);
            }
            
        } else {
            return redirect('/');
        }
    }

    public function itemCount(request $request)
    {
        if($request->ajax()){
            $product_cart = Session::get('pcart') ? Session::get('pcart') : array();
            $ptotal = is_array($product_cart) && $product_cart ? count($product_cart) : 0;

            $service_cart = Session::get('scart') ? Session::get('scart') : array();
            $stotal = isset($service_cart['service']) && $service_cart['service'] ? 1 : 0;

            $total = $ptotal + $stotal;
            echo json_encode(array('total' => $total));
            exit;
        } else {
            return redirect('/');
        }
    }

    public function update(request $request){
        if($request->ajax()){
            Cart::where('id', $request->cart_id)->update(array('qty' => $request->qty));
            $cart = Session::get('pcart') ? Session::get('pcart') : array();
            $pcart = array();
            foreach($cart as $key => $val){
                foreach($val as $v){
                    if(isset($v['cart_id']) && $v['cart_id'] == $request->cart_id){
                        $cart[$key]['qty'] = $request->qty;
                    }
                }
            }
            Session::put('pcart', $cart);
        } else {
            return redirect('/');
        }
    }

    public function remove(request $request){
        if($request->ajax()){
            $type = $request->type;
            $cart_info = Cart::select('product_id', 'service_id')->where('id', $request->cart_id)->first();
            if(isset($cart_info->service_id) && $cart_info->service_id){
                Session::put('scart', array());
            } elseif(isset($cart_info->product_id) && $cart_info->product_id){
                $cart = Session::get('pcart') ? Session::get('pcart') : array();
                $pcart = array();
                foreach($cart as $key => $val){
                    if(isset($val['cart_id']) && $val['cart_id'] == $request->cart_id){ } else {
                        $pcart[$key] = $val; 
                    }
                }
                Session::put('pcart', $pcart);
            }
            Cart::where('id', $request->cart_id)->delete();
        } else {
            return redirect('/');
        }
    }
}