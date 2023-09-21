<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Order;
use App\Models\EmailTemplates;
use App\Models\PickUpSlotSetting;
use App\Models\BookedSlot;
use Illuminate\Support\Facades\Validator;
use App\Constant;
use Auth;
use Crypt;
use DB;
use PDF;
use Mpdf\Mpdf;

class PdfController extends MainController
{
    public function pdfInvoice(request $request,$id){
        $return_data = array();       
        $return_data['site_title'] = trans('Invoice');
        $user_id = auth()->user()->id;
        $invoice = $request->id;
        $return_data['orders'] = Order::with('detail', 'slotDetail')->where('invoice_no', $invoice)->orderBy('id', 'desc')->get();
        $aslots = PickUpSlotSetting::select('id', 'time', 'slot')->where('slot', Constant::AFTERNOON)->orderBy('id')->get();
        $eslots = PickUpSlotSetting::select('id', 'time', 'slot')->where('slot', Constant::EVENING)->orderBy('id')->get();
        $mslots = PickUpSlotSetting::select('id', 'time', 'slot')->where('slot', Constant::MORNING)->orderBy('id')->get();
        $return_data['aslots'] = $aslots;
        $return_data['eslots'] = $eslots;
        $return_data['mslots'] = $mslots;
        $pdf = PDF::loadView('front.user.pdf',$return_data);
        return $pdf->download('Invoice.pdf');
    }
}
