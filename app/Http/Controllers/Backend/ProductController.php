<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ShopCategory;
use Auth;
use Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Crypt;
use App\Constant;
use DataTables;

class ProductController extends MainController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $return_data = array();
        $return_data['site_title'] = trans('Products');
        $shopcategories = ShopCategory::select('id','name')->where([['is_archive', Constant::NOT_ARCHIVE]])->orderby('id')->get();
        $return_data['shopcategories'] = $shopcategories;
        return view('backend.product.list',array_merge($this->data,$return_data));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $return_data = array();
        $return_data['site_title'] = trans('Product Create');
        $shop_category = ShopCategory::select('id','name')->where('is_archive', '=', Constant::NOT_ARCHIVE)->get();
        $return_data['shop_category'] = $shop_category;
        return view('backend.product.form',array_merge($this->data,$return_data));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $this->validate($request, [
                'name' => ['required'],
                'price' => ['required'],
                'sku' => ['required',
                    Rule::unique('products')->where(function ($query) use($request) {
                        return $query->where([['is_archive', Constant::NOT_ARCHIVE]]);
                    }),
                ],
            ],[
                'required'  => trans('The :attribute field is required.')
            ]
        );
        $slug = $request->name != '' || $request->name != '' ?  slugify($request->name.'-'.$request->sku) : NULL;

        $product = Product::create([
            'slug' => $slug,
            'name' => $request->name,
            'sku' => $request->sku,
            'shop_category_id' => $request->shop_category_id,
            'description' => $request->description,
            'specification' => $request->specification,
            'price' => $request->price,
            'amazon_link' => $request->amazon_link,
            'flipcart_link' => $request->flipcart_link,
            'is_archive' => Constant::NOT_ARCHIVE,
            'created_by' => Auth::guard('admin')->user()->id,
        ]);
        if($product){
            return redirect('backend/products')->with('success', trans('Product Added Successfully!'));
        } else {
            return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $return_data = array();
        $return_data['site_title'] = trans('Product Edit');
        $products = Product::find($id);
        $return_data['record'] = $products;
        $shop_category = ShopCategory::select('id','name')->where('is_archive', '=', Constant::NOT_ARCHIVE)->get();
        $return_data['shop_category'] = $shop_category;
        return view('backend.product.form', array_merge($this->data, $return_data));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $id = Crypt::decrypt($id);
        $this->validate($request, [
            'name' => ['required'],
            'price' => ['required'],
            'sku' => ['required',
                Rule::unique('products')->where(function ($query) use($request, $id) {
                    return $query->where([['is_archive', Constant::NOT_ARCHIVE]]);
                }),
            ],
        ],[
            'required'  => trans('The :attribute field is required.')
        ]);
        $slug = $request->name != '' || $request->sku != '' ?  slugify($request->name.'-'.$request->sku) : NULL;

        $product = Product::where('id', $id)->update([
            'slug' => $slug,
            'name' => $request->name,
            'sku' => $request->sku,
            'shop_category_id' => $request->shop_category_id,
            'description' => $request->description,
            'specification' => $request->specification,
            'price' => $request->price,
            'amazon_link' => $request->amazon_link,
            'flipcart_link' => $request->flipcart_link,
            'is_archive' => Constant::NOT_ARCHIVE,
            'updated_by' => Auth::guard('admin')->user()->id,
        ]);
        if($product){
            return redirect('backend/products')->with('success', trans('Product Updated Successfully!'));
        } else {
            return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $id = Crypt::decrypt($id);
        $product = Product::where('id',$id)->update([
            'is_archive' =>'0',
            'updated_by' => Auth::guard('admin')->user()->id,
        ]);
        if($product){
            return redirect()->back()->with('success', trans('Product Deleted Successfully!'));
        } else {
            return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
        }
    }

    public function productsDatatable(request $request)
    {
        if($request->ajax()){
            $query = Product::with('shopCategoryDetail')->select('id','shop_category_id', 'name','sku', 'price','status')->where('is_archive', '=', Constant::NOT_ARCHIVE)->orderBy('id', 'DESC');

            if($request->shopCategory!='all') {
                if($request->shopCategory!='') {
                    $query->whereHas('shopCategoryDetail', function($q) use ($request) {
                        $q->where([['shop_category_id', '=', $request->shopCategory]]);
                    });
                }
            }
            $list = $query->get();

            return DataTables::of($list)
                ->addColumn('shop_category_id', function ($row) {
                    $shop_category = isset($row->shopCategoryDetail->name) ? $row->shopCategoryDetail->name : '';
                    return $shop_category;
                })
                ->addColumn('name', function ($row) {
                    $name = $row->name;
                    return $name;
                })
                ->addColumn('sku', function ($row) {
                    $sku = $row->sku;
                    return $sku;
                })
                ->addColumn('price', function ($row) {
                    $price = $row->price;
                    return $price;
                })
                ->addColumn('status', function ($row) {
                    $html = $row->status == Constant::ACTIVE ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
                    return $html;
                })
                ->addColumn('action', function ($row) {
                    $html = "";
                    $id = Crypt::encrypt($row->id);
                    $html .= "<span class='text-nowrap'>";
                    $html .= "<a href='".route('admin_product-edit', array($id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";
                    $html .= "<a href='javascript:void(0);' data-href='".route('admin_product-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                    if($row->status == Constant::ACTIVE) {
                        $html .= "<a href='javascript:void(0);' class='btn btn-warning btn-sm status' data-status='".Constant::INACTIVE."' data-id='".$id."' rel='tooltip' title='Inactive'><i class='far fa-fw fa-window-close'></i></a>&nbsp";
                    } else {
                        $html .= "<a href='javascript:void(0);' class='btn btn-success btn-sm status' data-status='".Constant::ACTIVE."' data-id='".$id."' title='Active'><i class='fas fa-check'></i></a>";
                    }
                    $html .= "</span>";
                    return $html;
                })
                ->rawColumns(['id','shop_category_id','name', 'sku','price','action','status'])
                ->make(true);
        } else {
            return redirect('backend/dashboard');
        }
    }  
    
    public function changeProductStatus(request $request)
    {
        if($request->ajax()){
            $id = Crypt::decrypt($request->id);
            $message = $request->status == Constant::ACTIVE ? 'Product Activated Successfully!' : 'Product Inactivated Successfully!';
            Product::where([['id', $id]])->update(array('status' => $request->status, 'updated_by' => Auth::guard('admin')->user()->id)); 
            echo json_encode(array('message' => $message));
            exit;
        } else {
            return redirect('backend/dashboard');
        }
    }
}
