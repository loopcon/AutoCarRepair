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

    public function register(Request $request){
        $this->validate($request, [
            'email' => 'required|email|unique:users'
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

        // Send email for Welcome user - Start
        $templateStr = array('[USER]');
        $data = array($request->firstname);
        $ndata = EmailTemplates::select('template')->where('label', 'welcome')->first();
        $html = isset($ndata->template) ? $ndata->template : NULL;
        $mailHtml = str_replace($templateStr, $data, $html);
//        \Mail::to($request->email)->send(new \App\Mail\CommonMail($mailHtml, 'Welcome '.$this->data['site_name']));
        // Send email for Welcome user - End

        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user_id = Auth::guard('user')->user()->id;
            $user_detail = User::where([['id', '=', $user_id], ['is_archive', Constant::ARCHIVE]])->first();

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
}