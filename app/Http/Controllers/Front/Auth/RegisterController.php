<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\EmailTemplates;
use App\Models\HomePageSetting;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Constant;
use Auth;
use DB;
use Cookie;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:user', ['except' => ['logout']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function showRegisterForm()
    {
        $return_data = array();
        $setting_list = getSettingDetail();
        $footer_detail = HomePageSetting::select('footer_description')->where('id', 1)->first();
        $footer_description = isset($footer_detail->footer_description) ? $footer_detail->footer_description : NULL;
        $setting_list['footer_description'] = $footer_description;
        $this->data = $setting_list;
        $return_data['settings'] = $this->data;
        $return_data['site_title'] = trans('Register');
        return view('front.auth.register', array_merge($return_data, $this->data));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required'],
        ]);
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users'
        ]);

        $setting_list = getSettingDetail();
        $this->data = $setting_list;
        $user = new User();
        $fields = array('firstname', 'email', 'phone');
        foreach($fields as $key => $value){
            $user->$value = isset($request->$value) && $request->$value != '' ? $request->$value : NULL; 
        }
        $user->visible_password = $request->password;
        $user->password = Hash::make($request->password);
        $user->save();

        $this->sendDataToFreshFork($request);
        // Send email for Welcome user - Start
        $templateStr = array('[USER]');
        $data = array($request->firstname);
        $ndata = EmailTemplates::select('template')->where('label', 'welcome')->first();
        $html = isset($ndata->template) ? $ndata->template : NULL;
        $mailHtml = str_replace($templateStr, $data, $html);
       
       \Mail::to($request->email)->send(new \App\Mail\CommonMail($mailHtml, 'Welcome '.$this->data['site_name']));
        // Send email for Welcome user - End

        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user_id = Auth::guard('user')->user()->id;
            $user_detail = User::where([['id', '=', $user_id], ['is_archive', Constant::NOT_ARCHIVE]])->first();

            if ($user_detail) {
                //to remove cookie
                Cookie::queue(Cookie::forget('email'));
                Cookie::queue(Cookie::forget('password'));

                session()->put('userInfo', $user_detail);
            } else {
                Auth::guard('user')->logout();
                return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors(['Your account is not active.']);
            }
//            return redirect('/');
            return redirect('/')->with('success', trans('Your Account Registration Successfully!'));
        }
        return redirect()->back()->withInput()->withErrors(['register_error' => 'Email address has already been taken.']);
    }

    public function sendDataToFreshFork($request){
        $name = isset($request->firstname) ? $request->firstname : '' ;
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