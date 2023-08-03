<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Constant;
use App\Models\Page;

class CmsPagesController extends MainController
{
    public function index(){
        $data = array();
        $segment = request()->segment(1);

        if($segment){
            $pageInfo = Page::where([['slug' , $segment]])->first();
            if($pageInfo){
                $return_data = array();
                $return_data['site_title'] = trans(ucwords($pageInfo->name));
                $return_data['pageInfo'] = $pageInfo;
                $return_data['meta_keywords'] = $pageInfo->meta_keyword;
                $return_data['meta_description'] = $pageInfo->meta_description;

                return view('front.cms.index', array_merge($this->data, $return_data));
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }
}
