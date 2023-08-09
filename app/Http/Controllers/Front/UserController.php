<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Validator;
use App\Constant;
use Auth;
use DB;

class UserController extends MainController
{
    public function myprofile(){
        $return_data = array();
        $return_data['settings'] = $this->data;
        $return_data['site_title'] = trans('User Profile');
        $return_data['car_details'] = Cart::where([['user_id', Auth::guard('user')->user()->id]])->first();
        //dd($return_data);
        
        return view('front.auth.myprofile',array_merge($this->data,$return_data)); 
    }    
}
