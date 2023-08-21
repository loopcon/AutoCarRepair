<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Constant;

class FaqController extends MainController
{
    public function index()
    {
        $return_data = array();
        $return_data['site_title'] = trans('Faqs');
        $return_data['faqs'] = Faq::select('id','name','description')->where('is_archive','0')->orderBy('updated_at','desc')->get();
        return view('front/faq/index',array_merge($this->data,$return_data));
    }
}
