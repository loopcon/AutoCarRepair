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
//use Google;

class HomeController extends MainController
{
    public function index(Request $request)
    {
        /*$url = "https://mybusiness.googleapis.com/v4/accounts/12687265727280981176/locations/EnJLYXJnaWwgU2hhaGVlZCBTdWtoYmlyIFNpbmdoIFlhZGF2IE1hcmcsIFVkeW9nIFZpaGFyIEluZHVzdHJpYWwgQXJlYSBQaGFzZSBWSSwgU2VjdG9yIDM3LCBHdXJ1Z3JhbSwgSGFyeWFuYSwgSW5kaWEiLiosChQKEgkRdpI_8xcNOREXslgxMPydKxIUChIJmxwFxvEXDTkRWS1Zh5ES1vM/reviews";
//        $url = "https://maps.googleapis.com/maps/api/place/details/json?cid=12909283986953620003&key=AIzaSyCm_f4MOEgNY7na0hCIsz1TQIimdeVkJUU";
        $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $url);
     curl_setopt($ch, CURLOPT_POST, 0);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

     $response = curl_exec ($ch);
     
dd($response);
//        $scopes = [
//            'https://www.googleapis.com/auth/plus.business.manage'
//        ];
//        $google_client = new Google_Client();
//        $google_client->setApplicationName('YOUR APPLICATION NAME');
//        $google_client->setClientId('YOUR CLIENT ID');
//        $google_client->setClientSecret('SECRET');*/
        $return_data = array();
        $return_data['settings'] = $this->data;
        $hsetting = HomePageSetting::select('section1_title1', 'section1_title2', 'section1_image', 'section1_description','image_title', 'meta_title', 'meta_keywords', 'meta_description', 'extra_meta_tag','price_list')->where('id', 1)->first();
        $return_data['hsetting'] = $hsetting;
        $return_data['offer_slider'] = OfferSlider::select('id', 'title1', 'title2', 'image','image_title', 'btn_link', 'btn_title')->orderBy('id', 'ASC')->get();
        $return_data['brand_logo_slider'] = BrandLogoSlider::select('id', 'image','image_title')->orderBy('id', 'ASC')->get();
        $meta_title = isset($hsetting->meta_title) && $hsetting->meta_title ? $hsetting->meta_title : NULL;
        $return_data['meta_keywords'] =  isset($hsetting->meta_keywords) && $hsetting->meta_keywords ? $hsetting->meta_keywords : NULL;
        $return_data['meta_description'] =  isset($hsetting->meta_description) && $hsetting->meta_description ? $hsetting->meta_description : NULL;
        $return_data['extra_meta_tag'] =  isset($hsetting->extra_meta_tag) && $hsetting->extra_meta_tag ? $hsetting->extra_meta_tag : NULL;
        $return_data['site_title'] = $meta_title ? $meta_title : trans('Home');
        $return_data['scategories'] = ServiceCategory::select('id', 'slug', 'title', 'image','image_1','icon_image')->where([['is_archive', Constant::NOT_ARCHIVE], ['status', Constant::ACTIVE]])->orderBy('order_by', 'asc')->get();
        $return_data['service_center'] = ServiceCenterDetail::orderBy('id','asc')->get();
        

        $popup_detail = ServiceCenterDetail::select('id','image','address','phone_number','image_title')->get();
        $return_data['popup_detail'] = $popup_detail;
        return view('front/index',array_merge($this->data,$return_data));
    }
    
    public function appointmentStore(Request $request)
    {
        $this->validate($request, [
                'name' => ['required'],
                'email' => ['required'],
                // 'service' => ['required'],
                'message' => ['required'],
            ],[
                'required'  => trans('The :attribute field is required.')
            ]
        );
        $appointment = Enquiry::create([
            'name' => $request->name ? strip_tags($request->name) : NULL,
            'email' => $request->email,
            'phone' => $request->phone,
            // 'service' => $request->service,
            'message' => $request->message,
        ]);

        if($appointment){
            $this->sendDataToFreshFork($request);
            $scategories = ServiceCategory::select('id', 'title')->where('id',$request->service)->first();
            $name = $request->name;
            $email = $request->email;
            $phone = $request->phone;
            // $service = isset($scategories->title) ? $scategories->title : NULL;
            $message = $request->message;

            $templateStr = array('[NAME]','[EMAIL]','[PHONE]','[Message]', '[Service]');
            $data = array($name, $email,$phone, $message, '');
            $ndata = EmailTemplates::select('template')->where('label', 'request_appointment')->first();
            $html = isset($ndata->template) ? $ndata->template : NULL;
            $mailHtml = str_replace($templateStr, $data, $html);
            \Mail::to([$request->email, $this->data['email']])->send(new \App\Mail\CommonMail($mailHtml, 'Request An Appointment - ' . $this->data['site_name']));
            return redirect('/')->with('success', trans('Your Request Sent Successfully!'));
        } else {
            return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
        }
    }

    public static function sendDataToFreshFork($request){
        $name = isset($request->name) ? $request->name : '' ;
        $email = isset($request->email) ? $request->email : "";
        $mobile = isset($request->phone) ? $request->phone : (isset($request->mobile) ? $request->mobile : '');
        $visit_date = date('Y-m-d');
        $model = isset($request->model) ? $request->model : "";

        $location = "";
        $enquiry_type = "ACR Service";
        $timestamp = time();
        $formname = "ACR Landing ";
        
        $sources = isset($request->utm_source) ? $request->utm_source : "";
        $medium = isset($request->utm_medium) ? $request->utm_medium : "";
        $campaign = isset($request->utm_campaign) ? $request->utm_campaign : "";
        $term = isset($request->utm_term) ? $request->utm_term : "";
        $content = isset($request->utm_content) ? $request->utm_content : "";
        $sourceid = "70001109499";

        if($location==""){
            $location = isset($request->location) ? $request->location : "";
        }

        $jsonobj=array("contact"=>array("first_name"=>$name."-".$timestamp,"last_name"=>".","email"=>$email,"mobile_number"=>$mobile,"lead_source_id"=>$sourceid,"custom_field"=>array("cf_enquiry_type"=>$enquiry_type,"cf_ford_showroom_location"=>$location,"lead_source_id"=>$sourceid,"cf_acr_service_model"=>$model,"cf_utm_source"=>$sources,"cf_utm_medium"=>$medium,"cf_utm_campaign"=>$campaign,"cf_utm_term"=>$term,"cf_utm_content"=>$content,"cf_form_name"=>$formname)));
        $objPass=json_encode($jsonobj);

        try{
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => "https://harpreet-ford.myfreshworks.com/crm/sales/api/search.json?include=contact&q=".$mobile."&qf=mobile",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_POSTFIELDS => $objPass,
                CURLOPT_HTTPHEADER => [
                    "Authorization: Token token=eAYC1H05AnUO6D_w-W2Fbg",
                    "Content-Type: application/json"
                ],
            ]);
            
            $response = curl_exec($curl);
            
            $err = curl_error($curl);
            
            curl_close($curl);

            $result = json_decode($response);

            if(!empty($result)){
    
                $jsonobj1=array("contact"=>array("first_name"=>$name."-".$timestamp,"last_name"=>".","email"=>$email,"custom_field"=>array("cf_enquiry_type"=>$enquiry_type,"cf_ford_showroom_location"=>$location,"lead_source_id"=>$sourceid,"cf_acr_service_model"=>$model,"cf_utm_source"=>$sources,"cf_utm_medium"=>$medium,"cf_utm_campaign"=>$campaign,"cf_utm_term"=>$term,"cf_utm_content"=>$content,"cf_form_name"=>$formname)));
                $objPass1=json_encode($jsonobj1);

                $result = json_decode($response);
                $responseid= $result[0]->id;  
                $curl = curl_init();

                curl_setopt_array($curl, [
                    CURLOPT_URL => "https://harpreet-ford.myfreshworks.com/crm/sales/api/contacts/".$responseid,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "PUT",
                    CURLOPT_POSTFIELDS => $objPass1,
                    CURLOPT_HTTPHEADER => [
                        "Authorization: Token token=eAYC1H05AnUO6D_w-W2Fbg",
                        "Content-Type: application/json"
                    ],
                ]);

                $response = curl_exec($curl);
                $err = curl_error($curl);
                
                curl_close($curl);

                if ($err) {
                    // echo "cURL Error #:" . $err;
                } else {
//                    echo 'search api';
//                    echo $response;
//                    exit;
                    // echo $response;
                }

            } else {
    
                $curl = curl_init();
                
                curl_setopt_array($curl, [
                    CURLOPT_URL => "https://harpreet-ford.myfreshworks.com/crm/sales/api/contacts",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => $objPass,
                    CURLOPT_HTTPHEADER => [
                        "Authorization: Token token=eAYC1H05AnUO6D_w-W2Fbg",
                        "Content-Type: application/json"
                    ],
                ]);
    
                $response = curl_exec($curl);
                $err = curl_error($curl);
                
                curl_close($curl);
    
                if ($err) {
                    // echo "cURL Error #:" . $err;
                } else {
//                     echo "ee";
//                     echo $response;
//                     exit;
                }
            }
        } catch (Exception $ex) {
            curl_close($curl);
        }
    }
}