<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Constant;
use App\Models\Page;
use App\Models\CompnyCmsPage;
use App\Models\Enquiry;
use App\Models\ServiceCategory;
use App\Models\EmailTemplates;
use App\Models\BrandLogoSlider;
use App\Models\Seo;
use Auth;
use DB;

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
                $return_data['meta_title'] = $pageInfo->meta_title;
                $return_data['extra_meta_tag'] = $pageInfo->extra_meta_tag;

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
        $return_data['brand_logo_slider'] = BrandLogoSlider::select('id', 'image','image_title')->orderBy('id', 'ASC')->get();
        $about_us = Seo::select('meta_title','meta_keyword','meta_description','extra_meta_description')->where('id', Constant::ABOUT_US_SEO_ID)->first();
        $return_data['meta_keywords'] =  isset($about_us->meta_keyword) && $about_us->meta_keyword ? $about_us->meta_keyword : NULL;
        $return_data['meta_description'] = isset($about_us->meta_description) && $about_us->meta_description ? $about_us->meta_description : NULL;
        $return_data['extra_meta_description'] =  isset($about_us->extra_meta_description) && $about_us->extra_meta_description ? $about_us->extra_meta_description : NULL;
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

    public function compnyStore(Request $request)
    {
        $this->validate($request, [
                'name' => ['required'],
                'email' => ['required'],
                'message' => ['required'],
            ],[
                'required'  => trans('The :attribute field is required.')
            ]
        );
        $compny = Enquiry::create([
            'name' => $request->name ? strip_tags($request->name) : NULL,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ]);
        if($compny){
            HomeController::sendDataToFreshFork($request);
            $scategories = ServiceCategory::select('id', 'title')->where('id',$request->service)->first();
            $name = $request->name;
            $email = $request->email;
            $phone = $request->phone;
            $message = $request->message;

            $templateStr = array('[NAME]','[EMAIL]','[PHONE]','[Message]');
            $data = array($name, $email,$phone, $message);
            $ndata = EmailTemplates::select('template')->where('label', 'request_appointment')->first();
            $html = isset($ndata->template) ? $ndata->template : NULL;
            $mailHtml = str_replace($templateStr, $data, $html);
            // \Mail::to($request->email)->send(new \App\Mail\CommonMail($mailHtml, 'Request An Appointment - ' . $this->data['site_name']));
            return redirect()->back()->with('success', trans('Your Request Sent Successfully!'));
        } else {
            return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
        }
    }
}
