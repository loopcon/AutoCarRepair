<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetails;
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
            $query = Order::select('id','user_id','name','email','phone','address','zip','city','total','order_date')->with('userData')->orderBy('id', 'DESC');
            $list = $query->get();

            return DataTables::of($list)
                ->addColumn('name', function($row) {
                    return $row->name;
                })
                ->addColumn('action', function ($row) {
                    $html = "";
                    $id = Crypt::encrypt($row->id);
                    $html .= "<span class='text-nowrap'>";
                    $html .= "<a href='javascript:void(0);' data-href='".route('admin_order-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm mr-20 delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                    $html .= "<a href='".route('admin_order-detail',array($row->id))."' rel='tooltip' title='Detail' class='btn btn-success btn-sm'>Detail</a>";
                    $html .= "</span>";
                    return $html;
                })
                ->rawColumns(['id','user_id','name','email','phone','address','zip','city','total','action'])
                ->make(true);
        } else {
            return redirect('backend/dashboard');
        }
    }

    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        $order = Order::where('id', $id)->delete();
        if($order) {
            return redirect()->back()->with('success', trans('Order Deleted Successfully!'));
        } else {
            return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
        }
    }

    public function detail(request $request,$id)
    {
        $return_data = array();       
        $return_data['site_title'] = trans('Order Detail');
        $return_data['order_id'] = $request->order_id;
        return view('backend.order.detail', array_merge($this->data, $return_data));
    }

    public function orderDetailDatatable(request $request)
    {
        if($request->ajax()){
            $query = OrderDetails::select('id','order_id','product_id','price','qty','subtotal')->with('orderDetail','productDetail')->where('id', $request->order_id);
            $list = $query->get();

            return DataTables::of($list)
                ->addColumn('order', function($row) {
                    return $row->orderDetail->name ?? '';
                })
                ->addColumn('product', function($row) {
                    return $row->productDetail->name ?? '';
                })
                ->addColumn('action', function ($row) {
                    $html = "";
                    $id = Crypt::encrypt($row->id);
                    $html .= "<span class='text-nowrap'>";
                    $html .= "<a href='javascript:void(0);' data-href='".route('admin_order-detail-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm mr-20 delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                    $html .= "</span>";
                    return $html;
                })
                ->rawColumns(['id','order_id','product_id','price','qty','subtotal','action'])
                ->make(true);
        } else {
            return redirect('backend/dashboard');
        }
    }

    public function detailDestroy($id)
    {
        $id = Crypt::decrypt($id);
        $orderdetail = OrderDetails::where('id', $id)->delete();
        if($orderdetail) {
            return redirect()->back()->with('success', trans('Order Detail Deleted Successfully!'));
        } else {
            return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
        }
    }
}
