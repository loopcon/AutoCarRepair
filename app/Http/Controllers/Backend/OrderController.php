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
use DB;

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
            if($request->user_id){
                $query->where('user_id', $request->user_id);
            }
            $list = $query->get();

            return DataTables::of($list)
                ->addColumn('name', function($row) {
                    return $row->name;
                })
                ->addColumn('odate', function($row) {
                    $order_date = $row->order_date ? date("d/m/Y", strtotime($row->order_date)) : NULL;
                    $html = "<span class='text-nowrap'>";
                    $html .= $order_date;
                    $html .= "</span>";
                    return $html;
                })
                ->addColumn('action', function ($row) {
                    $html = "";
                    $id = Crypt::encrypt($row->id);
                    $html .= "<span class='text-nowrap'>";
                    // $html .= "<a href='javascript:void(0);' data-href='".route('admin_order-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm mr-20 delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                    $html .= "<a href='".route('admin_order-detail',array($id))."' rel='tooltip' title='Detail' class='btn btn-success btn-sm'>Detail</a>";
                    $html .= "</span>";
                    return $html;
                })
                ->rawColumns(['name','action','odate'])
                ->make(true);
        } else {
            return redirect('backend/dashboard');
        }
    }

    // public function destroy($id)
    // {
    //     $id = Crypt::decrypt($id);
    //     $order = Order::where('id', $id)->delete();
    //     if($order) {
    //         return redirect()->back()->with('success', trans('Order Deleted Successfully!'));
    //     } else {
    //         return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
    //     }
    // }

    public function detail(request $request,$id)
    {
        $return_data = array();       
        $return_data['site_title'] = trans('Order Detail');
        $id = Crypt::decrypt($id);
        $detail = Order::find($id);
        if(!isset($detail->id)){
            return redirect()->back()->with('error', 'Something went wrong, please try again later!');
        }
        $return_data['detail'] = $detail;
        return view('backend.order.detail', array_merge($this->data, $return_data));
    }

    public function orderDetailDatatable(request $request)
    {
        if($request->ajax()){
            $query = OrderDetails::with('packageDetail', 'productDetail')->select('id','order_id','product_id', 'service_id','price','qty','subtotal')->where('order_id', $request->order_id);
            $list = $query->get();

            return DataTables::of($list)
                ->addColumn('item', function($row) {
                    if($row->service_id){
                        $scheduled_title = isset($row->packageDetail->title) ? $row->packageDetail->title : NULL;
                        $brand = isset($row->packageDetail->brandDetail->title) ? $row->packageDetail->brandDetail->title : NULL;
                        $model = isset($row->packageDetail->modelDetail->title) ? $row->packageDetail->modelDetail->title : NULL;
                        $fuel_type = isset($row->packageDetail->fuelTypeDetail->title) ? $row->packageDetail->fuelTypeDetail->title : NULL;
                        $item = "<span class='text-nowrap'>".$scheduled_title."</br>".$brand.' - '.$model.' - '.$fuel_type."</span>";
                    } else {
                        $item = isset($row->productDetail->name) ? $row->productDetail->name : '';
                    }
                    return $item;
                })
                ->addColumn('action', function ($row) {
                    $html = "";
                    $id = Crypt::encrypt($row->id);
                    $user_id = isset($row->orderDetail->user_id) ? $row->orderDetail->user_id : '';
                    $html .= "<span class='text-nowrap'>";
                    if($row->service_id){
                        $html .= "<a href='".route('admin_booked-services')."?od_id=".$id."' class='badge bg-primary me-1 my-1' target='blank'>Slot Detail</a>";
                    }
//                    $html .= "<a href='javascript:void(0);' data-href='".route('admin_order-detail-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm mr-20 delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                    $html .= "</span>";
                    return $html;
                })
                ->rawColumns(['item','action'])
                ->make(true);
        } else {
            return redirect('backend/dashboard');
        }
    }

    // public function detailDestroy($id)
    // {
    //     $id = Crypt::decrypt($id);
    //     $orderdetail = OrderDetails::where('id', $id)->delete();
    //     if($orderdetail) {
    //         return redirect()->back()->with('success', trans('Order Detail Deleted Successfully!'));
    //     } else {
    //         return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
    //     }
    // }
}
