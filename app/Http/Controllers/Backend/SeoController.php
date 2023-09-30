<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seo;
use Auth;
use Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Crypt;
use App\Constant;
use DataTables;

class SeoController extends MainController
{
    /**
     * Display a listing of the resource.
     */
    public function ourServiceIndex()
    {
        $return_data = array();       
        $return_data['site_title'] = trans('Our Service');
        $return_data['record'] = Seo::find(Constant::OUR_SERVICE_SEO_ID);
        return view('backend.seo.our_service_index', array_merge($this->data, $return_data));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function ourserviceUpdate(Request $request)
    {
        $seo = Seo::where('id', Constant::OUR_SERVICE_SEO_ID)->update([
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'canonical_tag' => $request->canonical_tag,
            'extra_meta_description' => $request->extra_meta_description,
        ]);
        if($seo){
            return redirect()->back()->with('success', trans('Our Service Updated Successfully!'));
        } else {
            return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
        }
    }

    public function serviceCenterIndex()
    {
        $return_data = array();       
        $return_data['site_title'] = trans('Service Center');
        $return_data['record'] = Seo::find(Constant::SERVICE_CENTER_SEO_ID);
        return view('backend.seo.service_center_index', array_merge($this->data, $return_data));
    }

    public function serviceCenterUpdate(Request $request)
    {
        $seo = Seo::where('id', Constant::SERVICE_CENTER_SEO_ID)->update([
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'canonical_tag' => $request->canonical_tag,
            'extra_meta_description' => $request->extra_meta_description,
        ]);
        if($seo){
            return redirect()->back()->with('success', trans('Service Center Updated Successfully!'));
        } else {
            return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
        }
    }

    public function shoppingIndex()
    {
        $return_data = array();       
        $return_data['site_title'] = trans('Shopping');
        $return_data['record'] = Seo::find(Constant::SHOPPING_SEO_ID);
        return view('backend.seo.shopping_index', array_merge($this->data, $return_data));
    }

    public function shoppingUpdate(Request $request)
    {
        $seo = Seo::where('id', Constant::SHOPPING_SEO_ID)->update([
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'canonical_tag' => $request->canonical_tag,
            'extra_meta_description' => $request->extra_meta_description,
        ]);
        if($seo){
            return redirect()->back()->with('success', trans('Shopping Updated Successfully!'));
        } else {
            return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
        }
    }

    public function aboutUsIndex()
    {
        $return_data = array();       
        $return_data['site_title'] = trans('About Us');
        $return_data['record'] = Seo::find(Constant::ABOUT_US_SEO_ID);
        return view('backend.seo.aboutus_index', array_merge($this->data, $return_data));
    }

    public function aboutUsUpdate(Request $request)
    {
        $seo = Seo::where('id', Constant::ABOUT_US_SEO_ID)->update([
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'canonical_tag' => $request->canonical_tag,
            'extra_meta_description' => $request->extra_meta_description,
        ]);
        if($seo){
            return redirect()->back()->with('success', trans('About Us Updated Successfully!'));
        } else {
            return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
        }
    }
}
