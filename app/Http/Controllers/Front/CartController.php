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
            if($request->product_id){
                $cartInfo = Cart::select('id')->where([['product_id', $request->product_id]])->first();
                $cart_id = isset($cartInfo->id) && $cartInfo->id ? $cartInfo->id : NULL;
            }

            $cart = Session::get('cart') ? Session::get('cart') : array();

            $cfields = array('product_id', 'qty');

            if($cart_id){
                $cart_data = Cart::find($cart_id);
                $qty = $cart_data->qty;
                $request->qty = $request->qty + $qty;
            } else {
                $cart_data = new Cart();
            }
            foreach($cfields as $cfield){
                $cart_data->$cfield = isset($request->$cfield) && $request->$cfield != '' ? $request->$cfield : NULL;
            }
            $cart_data->user_id = $user_id;
            $cart_data->save();
            $cart_id = $cart_data->id;

            if(!in_array($cart_id, $cart)){
                array_push($cart, $cart_id);
            }
            Session::put('cart', $cart);
        } else {
            return redirect('/');
        }
    }

    public function itemCount(request $request)
    {
        if($request->ajax()){
            $cart = Session::get('cart') ? Session::get('cart') : array();
            $total = is_array($cart) && $cart ? count($cart) : 0;
            echo json_encode(array('total' => $total));
            exit;
        } else {
            return redirect('/');
        }
    }

    public function update(request $request){
        if($request->ajax()){
            Cart::where('id', $request->cart_id)->update(array('qty' => $request->qty));
        } else {
            return redirect('/');
        }
    }

    public function remove(request $request){
        if($request->ajax()){
            $cart = Session::get('cart') ? Session::get('cart') : array();
            $carray = array();
            if($cart){
                foreach($cart as $val){
                    //print_r($val);
                    if($val != $request->cart_id){
                        array_push($carray, $val);
                    }
                }
            }
            Session::put('cart', $carray);
            Cart::where('id', $request->cart_id)->delete();
        } else {
            return redirect('/');
        }
    }
}