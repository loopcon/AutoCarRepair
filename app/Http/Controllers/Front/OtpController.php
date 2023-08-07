<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Constant;
use Msg91;

class OtpController extends MainController
{
    public function send(request $request)
    {
        if($request->ajax()){
            $mobile = $request->mobile;
            $template = env("MSG91_TEMPLATE_ID");
            try {
                $response = Msg91::otp()
                    ->to('91'.$mobile) // phone number with country code
                    ->template($template) // set the otp template
                    ->send();
                $info = $response->getData();
                if(isset($info['type']) && $info['type'] == 'success'){
                    $return['result'] = 'success';
                }
            } catch (\Craftsys\Msg91\Exceptions\ValidationException $e) {
                // issue with the request e.g. token not provided
                $return = array('result' => 'error');
            } catch (\Craftsys\Msg91\Exceptions\ResponseErrorException $e) {
                // error thrown by msg91 apis or by http client
                $return = array('result' => 'error');
            } catch (\Exception $e) {
                // something else went wrong
                // plese report if this happens :)
                $return = array('result' => 'error');
            }

            echo json_encode($return);
            exit;
        } else {
            return redirect('/');
        }
    }

    public function verify(request $request)
    {
        if($request->ajax()){
            $mobile = $request->mobile;
            $otp = (int)$request->otp;
            $template = env("MSG91_TEMPLATE_ID");
            try {
                $response = Msg91::otp($otp) // OTP to be verified
                        ->to('91'.$mobile) // phone number with country code
                        ->verify();
                $info = $response->getData();
                if(isset($info['type']) && $info['type'] == 'success'){
                    $return['result'] = 'success';
                }
            } catch (\Craftsys\Msg91\Exceptions\ValidationException $e) {
                // issue with the request e.g. token not provided
                $return = array('result' => 'error');
            } catch (\Craftsys\Msg91\Exceptions\ResponseErrorException $e) {
                // error thrown by msg91 apis or by http client
                $return = array('result' => 'error');
            } catch (\Exception $e) {
                // something else went wrong
                // plese report if this happens :)
                $return = array('result' => 'error');
            }

            echo json_encode($return);
            exit;
        } else {
            return redirect('/');
        }
    }

    public function resend(request $request)
    {
        if($request->ajax()){
            $mobile = $request->mobile;
            $template = env("MSG91_TEMPLATE_ID");
            try {
                $response = Msg91::otp()
                        ->to('91'.$mobile) // phone number with country code
                        ->template($template) // set the otp template
                        ->resend();
                $info = $response->getData();
                if(isset($info['type']) && $info['type'] == 'success'){
                    $return['result'] = 'success';
                }
            } catch (\Craftsys\Msg91\Exceptions\ValidationException $e) {
                // issue with the request e.g. token not provided
                $return = array('result' => 'error');
            } catch (\Craftsys\Msg91\Exceptions\ResponseErrorException $e) {
                // error thrown by msg91 apis or by http client
                $return = array('result' => 'error');
            } catch (\Exception $e) {
                // something else went wrong
                // plese report if this happens :)
                $return = array('result' => 'error');
            }
            echo json_encode($return);
            exit;
        } else {
            return redirect('/');
        }
    }
}