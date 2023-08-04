<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceCenterDetail;
use App\Constant;

class ServiceCenterConroller extends MainController
{
    public function index()
    {
        $return_data = array();
        $return_data['site_title'] = trans('Service Center');
        $record = ServiceCenterDetail::select('id', 'name', 'address','phone_number','image')->first();
        $return_data['record'] = $record;
        return view('front/servicecenter/index',array_merge($this->data,$return_data));
    }
}
