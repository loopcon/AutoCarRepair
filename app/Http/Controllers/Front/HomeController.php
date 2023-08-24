<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Constant;
use App\Models\HomePageSetting;
use App\Models\OfferSlider;
use App\Models\BrandLogoSlider;
use App\Models\ServiceCategory;
use App\Models\ServiceCenterDetail;
use App\Models\Enquiry;
use App\Models\EmailTemplates;
use Auth;
use DB;

class HomeController extends MainController
{
    public function index(Request $request)
    {
        $return_data = array();
        $return_data['settings'] = $this->data;
        $hsetting = HomePageSetting::select('section1_title1', 'section1_title2', 'section1_image', 'section1_description', 'meta_title', 'meta_keywords', 'meta_description')->where('id', 1)->first();
        $return_data['hsetting'] = $hsetting;
        $return_data['offer_slider'] = OfferSlider::select('id', 'title1', 'title2', 'image', 'btn_link', 'btn_title')->orderBy('id', 'ASC')->get();
        $return_data['brand_logo_slider'] = BrandLogoSlider::select('id', 'image')->orderBy('id', 'ASC')->get();
        $meta_title = isset($hsetting->meta_title) && $hsetting->meta_title ? $hsetting->meta_title : NULL;
        $return_data['meta_keywords'] =  isset($hsetting->meta_keywords) && $hsetting->meta_keywords ? $hsetting->meta_keywords : NULL;
        $return_data['meta_description'] =  isset($hsetting->meta_description) && $hsetting->meta_description ? $hsetting->meta_description : NULL;
        $return_data['site_title'] = $meta_title ? $meta_title : trans('Home');
        $return_data['scategories'] = ServiceCategory::select('id', 'slug', 'title', 'image')->where([['is_archive', Constant::NOT_ARCHIVE], ['status', Constant::ACTIVE]])->orderBy('id', 'desc')->get();
        $return_data['service_center'] = ServiceCenterDetail::orderBy('id','asc')->get();
        $popup_detail = ServiceCenterDetail::select('id','image','address','phone_number')->get();
        $return_data['popup_detail'] = $popup_detail;
        return view('front/index',array_merge($this->data,$return_data));
    }
    
    public function appointmentStore(Request $request)
    {
        $this->validate($request, [
                'name' => ['required'],
                'email' => ['required'],
                'service' => ['required'],
                'message' => ['required'],
            ],[
                'required'  => trans('The :attribute field is required.')
            ]
        );
        $appointment = Enquiry::create([
            'name' => $request->name ? strip_tags($request->name) : NULL,
            'email' => $request->email,
            'phone' => $request->phone,
            'service' => $request->service,
            'message' => $request->message,
        ]);

        if($appointment){
            $scategories = ServiceCategory::select('id', 'title')->where('id',$request->service)->first();
            $name = $request->name;
            $email = $request->email;
            $phone = $request->phone;
            $service = isset($scategories->title) ? $scategories->title : NULL;
            $message = $request->message;

            $templateStr = array('[NAME]','[EMAIL]','[PHONE]','[Service]','[Message]');
            $data = array($name, $email,$phone, $service, $message);
            $ndata = EmailTemplates::select('template')->where('label', 'request_appointment')->first();
            $html = isset($ndata->template) ? $ndata->template : NULL;
            $mailHtml = str_replace($templateStr, $data, $html);
            // \Mail::to($request->email)->send(new \App\Mail\CommonMail($mailHtml, 'Request An Appointment - ' . $this->data['site_name']));
            return redirect('/')->with('success', trans('Your Request Sent Successfully!'));
        } else {
            return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
        }
    }
}