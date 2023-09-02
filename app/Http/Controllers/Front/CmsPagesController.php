<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Constant;
use App\Models\Page;
use App\Models\CompnyCmsPage;

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

    public function aboutUs()
    {
        $return_data = array();
        $return_data['site_title'] = trans('About Us');
        return view('front.cms.about_us', array_merge($this->data, $return_data));
    }

    public function cmsPage()
    {
        $data = array();
        $segment = request()->segment(1);

        if($segment){
            $compnypageInfo = CompnyCmsPage::where([['slug' , $segment]])->first();
            if($compnypageInfo){
                $return_data = array();
                $return_data['site_title'] = trans(ucwords($compnypageInfo->name));
                $return_data['compnypageInfo'] = $compnypageInfo;
                $return_data['meta_keywords'] = $compnypageInfo->meta_keywords;
                $return_data['meta_description'] = $compnypageInfo->meta_description;
                $return_data['meta_title'] = $compnypageInfo->meta_title;
                $return_data['extra_meta_tag'] = $compnypageInfo->extra_meta_tag;

                return view('front.cms.company', array_merge($this->data, $return_data));
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
        // $return_data = array();
        // $return_data['site_title'] = trans('CMS Page');
        // return view('front.cms.company', array_merge($this->data, $return_data));
    }
}
