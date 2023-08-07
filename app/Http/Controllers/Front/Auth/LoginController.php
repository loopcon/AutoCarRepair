<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\User;
use App\Models\EmailTemplates;
use App\Models\HomePageSetting;
use App\Constant;
use Cookie;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:user', ['except' => ['logout']]);
    }

    public function showLoginForm()
    {
        $return_data = array();
        $setting_list = getSettingDetail();
        $footer_description = isset($footer_detail->footer_desc) ? $footer_detail->footer_desc : NULL;
        $setting_list['footer_description'] = $footer_description;
        $footer_detail = HomePageSetting::select('footer_description')->where('id', 1)->first();
        $this->data = $setting_list;
        $return_data['settings'] = $this->data;
        $return_data['site_title'] = trans('Login');
        return view('front.auth.login', array_merge($return_data, $this->data));
    }

    public function login(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'email'   => 'required',
            'password' => 'required'
        ]);

        // Attempt to log the user in
        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user_id = Auth::guard('user')->user()->id;
            $user_detail = User::where([['id', '=', $user_id], ['is_archive', Constant::ARCHIVE]])->first();
            if ($user_detail) {
                Cookie::queue(Cookie::forget('email'));
                Cookie::queue(Cookie::forget('password'));

                session()->put('userInfo', $user_detail);
            } else {
                Auth::guard('user')->logout();
                return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors(['Your account is not active.']);
            }
//            return redirect()->intended(route('front_/'));
            return redirect('/')->with('success', trans('Your Account Login Successfully!'));
        }
        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('email'))->withErrors(['login_error' => 'These credentials do not match our records.']);
    }

    public function logout()
    {
        Auth::guard('user')->logout();
        return redirect('/');
    }

    public function showForgetForm()
    {
        $return_data = array();
        $return_data['site_title'] = trans('Forgot Password');
        $setting_list = getSettingDetail();
        $footer_description = isset($footer_detail->footer_desc) ? $footer_detail->footer_desc : NULL;
        $setting_list['footer_description'] = $footer_description;
        $this->data = $setting_list;
        $return_data['settings'] = $this->data;

        return view('front/auth/forgot', array_merge($this->data, $return_data));
    }

    public function sendForgetLink(Request $request)
    {
        $uData = User::select('id', 'firstname', 'remember_token', 'is_archive')->where([['email', $request->email]])->first();
        $is_active = isset($uData->is_archive) ? $uData->is_archive : NULL;

        if ($is_active == Constant::ARCHIVE) {
            $user_id = isset($uData->id) && $uData->id ? $uData->id : NULL;
            if ($user_id) {
                $token = generateRandomString();
                User::where([['id', $user_id]])->update(['remember_token' => $token]);

                $uname = isset($uData->firstname) ? $uData->firstname : NULL;
                $url = route('front_reset-password', array($token));
                $link = '<a href="' . $url . '" target="_blank">Reset Password</a>';

                $templateStr = array('[USER]','[RESET-PASSWORD]');
                $data = array($uname, $link);
                $ndata = EmailTemplates::select('template')->where('label', 'forgot_password')->first();
                $html = isset($ndata->template) ? $ndata->template : NULL;
                $mailHtml = str_replace($templateStr, $data, $html);
//                \Mail::to($request->email)->send(new \App\Mail\CommonMail($mailHtml, 'Forgot Password ' . $this->data['site_name']));
                return redirect()->back()->with('success', trans('Reset link has been sent to your email address.'));
            }
        }
        return redirect()->back()->withInput($request->only('email'))->withErrors(['message' => 'Please enter registered email address.']);
    }

    public function showResetPasswordForm(Request $request){
        $token = $request->token;
        if($token){
            $uData = User::select('id', 'remember_token', 'is_archive')->where([['remember_token', $token]])->first();
            $is_active = isset($uData->is_archive) ? $uData->is_archive : NULL;

            if($is_active == Constant::NOT_ARCHIVE){
                $user_id = isset($uData->id) ? $uData->id : NULL;
                if($user_id){
                    $return_data = array();
                    $setting_list = getSettingDetail();
                    $footer_description = isset($footer_detail->footer_description) ? $footer_detail->footer_description : NULL;
                    $setting_list['footer_description'] = $footer_description;
                    $this->data = $setting_list;
                    $return_data['settings'] = $this->data;
                    $return_data['user_id'] = $user_id;
                    $return_data['site_title'] = trans('Reset Password');
                    $return_data['settings'] = $this->data;
                    return view('front.auth.reset', array_merge($this->data, $return_data));
                }
            }
        }
        return redirect()->intended(route('front_forgot-password'));
    }

    public function resetPassword(Request $request){
        $user_id = \Crypt::decrypt($request->user_id);
        $visible_password = $request->password;
        $password = \Hash::make($request->password);
        User::where([['id', $user_id]])->update(['password' => $password,'visible_password' => $visible_password, 'remember_token' => NULL]);
        return redirect()->route('front_login')->with('success', trans('Your password updated successfully!'));
    }
}
