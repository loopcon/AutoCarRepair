<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Crypt;
use App\Constant;
use Session;
use DataTables;

class OrderController extends MainController
{
    public function index()
    {
        $return_data = array();       
        $return_data['site_title'] = trans('Orders');
        return view('backend.order.list', array_merge($this->data, $return_data));
    }

    public function orderDatatable(request $request)
    {
        if($request->ajax()){
            $query = Order::select('id','name','email','phone','address','zip','city','total','order_date')->with('userDetail')->orderBy('id', 'DESC');
            $list = $query->get();
            // dd($list);
            return DataTables::of($list)
            // ->addColumn('user', function($row) {
            //     return $row->userDetail->firstname;
            // })
                ->addColumn('action', function ($row) {
                    $html = "";
                    $id = Crypt::encrypt($row->id);
                    $html .= "<span class='text-nowrap'>";
                    $html .= "<a href='javascript:void(0);' data-href='".route('admin_user-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm mr-20 delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                    // $html .= "<a href='' rel='tooltip' title='Detail' class='btn btn-success btn-sm'>Detail</i></a>";
                    $html .= "</span>";
                    return $html;
                })
                ->rawColumns(['id','user_id','name','email','phone','address','zip','city','total','order_date','action'])
                ->make(true);
        } else {
            return redirect('backend/dashboard');
        }
    }
}
