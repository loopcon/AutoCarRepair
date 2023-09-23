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
use App\Models\ScheduledPackage;
use Auth;
use Session;
use App\Models\EmailTemplates;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
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
        $mslots = PickUpSlotSetting::select('id', 'time', 'slot')->where('slot', Constant::MORNING)->orderBy('id')->get();
        $return_data['aslots'] = $aslots;
        $return_data['eslots'] = $eslots;
        $return_data['mslots'] = $mslots;
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
            $return_data = array();
            $return_data['cart_data'] = $cart_data;
            $html = view('front/checkout/cart_ajax', array_merge($this->data, $return_data))->render();
            echo json_encode(array('status' => $status, 'html' => $html));
            exit;
        } else {
            return redirect('/');
        }
    }

    public function createOrder(request $request)
    {
       // dd($request->all());
        $this->validate($request, [
            'city' => 'required|regex:/^[\pL\s\-]+$/u',
            
            ],['required'  => trans('city allowed only character')
        ]);
        $pcart = Session::get('pcart');
        $scart = Session::get('scart');
        if(empty($pcart) && empty($scart)){
            return redirect('/');
        }

        $payment_type = $request->payment_type;
        if($payment_type == Constant::OFFLINE){

            $usercheck=User::where('email',$request->email)->first();
            if($usercheck !== null){
                $user_id=$usercheck->id;
            }
            elseif (Auth::guard('user')->check()) {
                $user_id = Auth::guard('user')->user()->id;
            }
            else{
                $randomString = Str::random(8);
                $randomString .= rand(0, 9);
                $randomString .= Str::random(1, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ');
                $randomString .= Str::random(1, 'abcdefghijklmnopqrstuvwxyz');
                $specialChars = '!@#$%&*';
                $randomString .= $specialChars[rand(0, strlen($specialChars) - 1)];
                $genratepassword = str_shuffle($randomString);

                // dd($genratepassword);
                $user= new User();
                $user->firstname=$request->input('name');
                $user->phone=$request->input('mobile');
                $user->email=$request->input('email');
                $user->password = Hash::make($genratepassword);
                $user->visible_password = $genratepassword;
                $user->password_active=1;
                $user->save();

                $templateStr = array('[USER]' ,'[PASSWORD]');
                $data = array($request->name , $genratepassword);
                $ndata = EmailTemplates::select('template')->where('label', 'password')->first();
                $html = isset($ndata->template) ? $ndata->template : NULL;
                $mailHtml = str_replace($templateStr, $data, $html);
                \Mail::to($request->email)->send(new \App\Mail\CommonMail($mailHtml, 'Welcome '.$this->data['site_name']));
                $user_id=$user->id;

            }
            // $user_id = Auth::guard('user')->check() ? Auth::guard('user')->user()->id : NULL;
            $checkout_type = $user_id ? Constant::USER_CHECKOUT : Constant::GUEST_CHECKOUT;

            $order = new Order();
            $order->user_id = $user_id;
            $order->is_guest_chekout = $checkout_type;
            $order->payment_type = $payment_type;
            $order->name = $request->name;
            $order->email = $request->email;
            $order->phone = $request->mobile;
            $order->address = $request->address;
            $order->zip = $request->zip;
            $order->city = $request->city;
            $order->subtotal = $request->subtotal;
            // $order->service_gst_rate = isset($this->data['service_gst']) ? $this->data['service_gst'] : 0;
            // $order->service_gst_rate = isset($this->data['service_gst']) ? $this->data['service_gst'] : 0;
            $order->product_gst_rate = isset($this->data['product_gst']) ? $this->data['product_gst'] : 0;
            $order->service_gst_rate = isset($this->data['service_gst']) ? $this->data['service_gst'] : 0;
            $order->product_gst = $request->product_gst;
            $order->service_gst = $request->service_gst;
            $order->total = $request->order_total;
            $order->order_date = date('Y-m-d');
            $order->vehicle_number = $request->vehicle_number;
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
                $id_length = strlen((string)$order_id);
                $iorder_id = $id_length == 1 ? '0'.$order_id : $order_id;
                $inovice_no = 'ACR'.date('y').$iorder_id;
                Order::where('id', $order_id)->update(array('invoice_no' => $inovice_no));
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

                        // Send email for Booked Service - Start
                        $package_data = ScheduledPackage::with('modelDetail', 'brandDetail', 'fuelTypeDetail')->Select('id','brand_id', 'model_id', 'fuel_type_id', 'title')->where('id', $cdata->service_id)->first();
                        $package = isset($package_data->title) && $package_data->title ? $package_data->title : NULL;
                        $model = isset($package_data->modelDetail->title) ? $package_data->modelDetail->title : NULL;
                        $brand = isset($package_data->brandDetail->title) ? $package_data->brandDetail->title : NULL;
                        $fuelType = isset($package_data->fuelTypeDetail->title) ? $package_data->fuelTypeDetail->title : NULL;
                        $service_info = $package.' - '.$brand. ' - '.$model.' - '.$fuelType;

                        $sdate = $request->slot_date ? date('d/m/Y', strtotime($request->slot_date)) : '';
                        $templateStr = array('[USER]', '[SERVICE]', '[DATE]', '[TIME]');
                        $data = array($request->name, $service_info, $sdate, $request->slot_time);
                        $ndata = EmailTemplates::select('template')->where('label', 'booked_service')->first();
                        $html = isset($ndata->template) ? $ndata->template : NULL;
                        $mailHtml = str_replace($templateStr, $data, $html);
//                        print_r($mailHtml);exit;
//                        \Mail::to($request->email)->send(new \App\Mail\CommonMail($mailHtml, 'Service Booked - '.$this->data['site_name']));
                        // Send email for Booked Service - End
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
    
    public function getAvailableSlot(request $request){
        if($request->ajax()){
            $date = $request->date;
            $today = date('Y-m-d');

            $slot_ids = array();
            if($date == $today){
                $slots = PickUpSlotSetting::select('id', 'time', 'slot')->orderBy('id')->get();
                foreach($slots as $slot){
                    $slot_time = $slot->time;
                    $slot_time = str_replace(' ', '', $slot_time);
                    $slotarray = explode('-', $slot_time);
                    $slot1 = isset($slotarray[0]) ? $slotarray[0] : NULL;
                    $slot2 = isset($slotarray[1]) ? $slotarray[1] : NULL;
                    $slot2 = str_replace('PM', '', $slot2);
                    $time_type = 'PM';
                    if( $slot2 && strpos( $slot2, "AM" ) !== false) {
                        $time_type = 'AM';
                    }
                    $slot2 = str_replace('AM', '', $slot2);

                    $stime1 = $today.' '.$slot1.':00 '.$time_type;
                    $stime2 = $today.' '.$slot2.':00 '.$time_type;
                    $current = time();
                    if($current <= strtotime($stime1)){
                        array_push($slot_ids, $slot->id);
                    } else if( $current <= strtotime($stime2)){
                        array_push($slot_ids, $slot->id);
                    }
                }
                $aslots = PickUpSlotSetting::select('id', 'time', 'slot')->where('slot', Constant::AFTERNOON)->whereIn('id',$slot_ids)->orderBy('id')->get();
                $eslots = PickUpSlotSetting::select('id', 'time', 'slot')->where('slot', Constant::EVENING)->whereIn('id',$slot_ids)->orderBy('id')->get();
                $mslots = PickUpSlotSetting::select('id', 'time', 'slot')->where('slot', Constant::MORNING)->whereIn('id',$slot_ids)->orderBy('id')->get();
            } else {
                $aslots = PickUpSlotSetting::select('id', 'time', 'slot')->where('slot', Constant::AFTERNOON)->orderBy('id')->get();
                $eslots = PickUpSlotSetting::select('id', 'time', 'slot')->where('slot', Constant::EVENING)->orderBy('id')->get();
                $mslots = PickUpSlotSetting::select('id', 'time', 'slot')->where('slot', Constant::MORNING)->orderBy('id')->get();
            }
            $data = array('aslots' => $aslots, 'eslots' => $eslots, 'mslots' => $mslots);
            $html = view('front/checkout/slot_ajax', array_merge($this->data, $data))->render();
            $total_slots = $aslots->count() + $eslots->count() + $mslots->count();
            echo json_encode(array('html' => $html, 'total_slots' => $total_slots));
            exit;
        } else {
            return redirect('/');
        }
    }
}