<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Constant;

class ContactController extends MainController
{
    public function index()
    {
        $return_data = array();
        $return_data['settings'] = $this->data;
        $return_data['site_title'] = trans('Contact US');

        return view('front/contact/index',array_merge($this->data,$return_data));
    }
}