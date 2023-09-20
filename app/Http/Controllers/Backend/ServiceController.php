<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use App\Models\ScheduledPackage;
use App\Models\ScheduledPackageDetail;
use App\Models\PackageSpecification;
use App\Models\CarModel;
use App\Models\CarBrand;
use App\Models\FuelType;
use App\Models\BookedSlot;
use App\Models\PickUpSlotSetting;
use App\Models\EmailTemplates;
use Auth;
use Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Crypt;
use App\Constant;
use DataTables;
use DB;

class ServiceController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function serviceCategoryList()
    {
        $return_data = array();       
        $return_data['site_title'] = trans('Service Category');
        return view('backend.service.category.list', array_merge($this->data, $return_data));
    }

    public function serviceCategorycreate()
    {
        $return_data = array();
        $return_data['site_title'] = trans('Service Category Create');
        return view('backend.service.category.form',array_merge($this->data,$return_data));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function serviceCategoryStore(Request $request)
    {
        $this->validate($request, [
            'title' => [
                'required',
                Rule::unique('service_categories')->where(function ($query) use($request) {
                    return $query->where('is_archive', Constant::NOT_ARCHIVE);
                }),
            ],
        ]
        );
        $slug = $request->title != '' ? slugify($request->title) : NULL;

        $scstegory = new ServiceCategory();
        $fields = array('title','image','image_1','icon_image', 'price_list','description','meta_title','meta_keywords','meta_description');
        foreach($fields as $field){
            $scstegory->$field = isset($request->$field) && $request->$field ? $request->$field : NULL;
        }
        if($request->hasFile('image')) {
            $newName = fileUpload($request, 'image', 'uploads/service/category');
            $scstegory->image = $newName;
        }
        if($request->hasFile('image_1')) {
            $newName = fileUpload($request, 'image_1', 'uploads/service/category');
            $scstegory->image_1 = $newName;
        }
        if($request->hasFile('icon_image')) {
            $newName = fileUpload($request, 'icon_image', 'uploads/service/category/icon');
            $scstegory->icon_image = $newName;
        }
        $scstegory->order_by = 0;
        $scstegory->slug = $slug;
        $scstegory->created_by = Auth::guard('admin')->user()->id;
        $scstegory->save();
        if($scstegory){
            return redirect('backend/service-category')->with('success', trans('Service Category Added Successfully!'));
        } else {
            return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function serviceCategoryedit($id)
    {
        $id = Crypt::decrypt($id);
        $return_data = array();
        $return_data['site_title'] = trans('Service Category Edit');
        $service_category = ServiceCategory::find($id);
        $return_data['record'] = $service_category;
        return view('backend.service.category.form',array_merge($this->data,$return_data));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function serviceCategoryUpdate(Request $request, $id)
    {

        $id = Crypt::decrypt($id);
        $this->validate($request, [
                'title' => [
                    'required',
                    Rule::unique('service_categories')->where(function ($query) use($request, $id) {
                        return $query->where([['is_archive', Constant::NOT_ARCHIVE],['id', '!=', $id]]);
                    }),
                ],
            ]
        );
        $slug = $request->title != '' ? slugify($request->title) : NULL;

        $scategory = ServiceCategory::find($id);
        $fields = array('title','image','image_1','icon_image', 'price_list','description','meta_title','meta_keywords','meta_description');
        foreach($fields as $field){
            $scategory->$field = isset($request->$field) && $request->$field ? $request->$field : NULL;
        }
        if($request->hasFile('image')) {
            $old_image = $scategory->image;
            if($old_image){
                removeFile('uploads/service/category/'.$old_image);
            }
            $newName = fileUpload($request, 'image', 'uploads/service/category');
            $scategory->image = $newName;
        }
        if($request->hasFile('image_1')) {
            $old_image = $scategory->image_1;
            if($old_image){
                removeFile('uploads/service/category/'.$old_image);
            }
            $newName = fileUpload($request, 'image_1', 'uploads/service/category');
            $scategory->image_1 = $newName;
        }
        if($request->hasFile('icon_image')) {
            $old_image = $scategory->icon_image;
            if($old_image){
                removeFile('uploads/service/category/icon'.$old_image);
            }
            $newName = fileUpload($request, 'icon_image', 'uploads/service/category/icon');
            $scategory->icon_image = $newName;
        }
        $scategory->slug = $slug;
        $scategory->updated_by = Auth::guard('admin')->user()->id;
        $scategory->save();

        if($scategory) {
            return redirect('backend/service-category')->with('success', trans('Service Category Updated Successfully!'));
        } else {
            return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function serviceCategoryDestroy($id)
    {
        $id = Crypt::decrypt($id);
        $constraint_array = array(
            array('table' => 'model', 'column' => 'carbrand_id')
        );
        $is_delete = checkDeleteConstrainnt($constraint_array, $id);
        if($is_delete) {
            $scategory = ServiceCategory::where('id', $id)->first();
            $old_image = $scategory->image;
            $old_icon_img = $scategory->icon_image; 
            if($old_image){
                removeFile('uploads/service/category/'.$old_image);
            }
            if($old_icon_img){
                removeFile('uploads/service/category/icon/'.$old_icon_img);
            }
            $scategory = ServiceCategory::where('id', $id)->delete();
            if($scategory) {
                return redirect()->back()->with('success', trans('Service Category Deleted Successfully!'));
            } else {
                return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
            }
       } else {
           return redirect()->back()->with('error', trans('You can not delete this car brand! Somewhere this car brand information is added in system!'));
       }
    }
    public function serviceCategoryDatatable(request $request)
    {
        if($request->ajax()){
            $query = ServiceCategory::select('id', 'title', 'image', 'description', 'order_by', 'status')->where('is_archive', '=', Constant::NOT_ARCHIVE)->orderBy('id', 'DESC');
            $list = $query->get();

            return DataTables::of($list)
                ->addColumn('order_by', function($row) {
                    $html = "<input type='number' name='order_by' class='order_by' data-categoryid='".$row->id."' value='".$row->order_by."' style='width:40%' />";
                    return $html;
                })
                ->addColumn('image', function ($row) {
                    $image = $row->image ? "<img src='".url('uploads/service/category/'.$row->image)."' width='80px' height='80px'>" : '';
                    return $image;
                })
                ->addColumn('status', function ($row) {
                    $html = $row->status == Constant::ACTIVE ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
                    return $html;
                })
                ->addColumn('action', function ($row) {
                    $html = "";
                    $id = Crypt::encrypt($row->id);
                    $html .= "<span class='text-nowrap'>";
                    $html .= "<a href='".route('admin_service-category-edit',array($id))."' rel='tooltip' title='".trans('Edit')."' data-id='".$id."' class='btn btn-info btn-sm ajax-form'><i class='fas fa-pencil-alt'></i></a>&nbsp";
                    $html .= "<a href='javascript:void(0);' data-href='".route('admin_service-category-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                    if($row->status == Constant::ACTIVE) {
                        $html .= "<a href='javascript:void(0);' class='btn btn-warning btn-sm status' data-status='".Constant::INACTIVE."' data-id='".$id."' rel='tooltip' title='Inactive'><i class='far fa-fw fa-window-close'></i></a>&nbsp";
                    } else {
                        $html .= "<a href='javascript:void(0);' class='btn btn-success btn-sm status' data-status='".Constant::ACTIVE."' data-id='".$id."' title='Active'><i class='fas fa-check'></i></a>";
                    }
                    $html .= "</span>";
                    return $html;
                })
                ->rawColumns(['order_by', 'image','action','status'])
                ->make(true);
        } else {
            return redirect('backend/dashboard');
        }
    }
    
    public function changeServiceCategoryStatus(request $request){
        if($request->ajax()){
            $id = Crypt::decrypt($request->id);
            $message = $request->status == Constant::ACTIVE ? 'Service Category Activated Successfully!' : 'Service Category Inactivated Successfully!';
            ServiceCategory::where([['id', $id]])->update(array('status' => $request->status, 'updated_by' => Auth::guard('admin')->user()->id)); 
            echo json_encode(array('message' => $message));
            exit;
        } else {
            return redirect('backend/dashboard');
        }
    }

    public function scheduledPackageList()
    {
        $return_data = array();       
        $return_data['site_title'] = trans('Scheduled Packages');
        // $return_data['brands'] = CarBrand::select('id', 'title')->where([['is_archive', Constant::NOT_ARCHIVE], ['status', Constant::ACTIVE]])->get();
        // $return_data['models'] = CarModel::select('id', 'title')->where([['is_archive', Constant::NOT_ARCHIVE], ['status', Constant::ACTIVE]])->get();
        // $return_data['fuel_type'] = FuelType::select('id', 'title')->where([['is_archive', Constant::NOT_ARCHIVE], ['status', Constant::ACTIVE]])->get();
        $return_data['categories'] = ServiceCategory::select('id', 'title')->where([['is_archive', Constant::NOT_ARCHIVE], ['status', Constant::ACTIVE]])->get();
        return view('backend.service.package.list', array_merge($this->data, $return_data));
    }

    public function scheduledPackageCreate()
    {
        $return_data = array();
        // $return_data['brands'] = CarBrand::select('id', 'title')->where([['is_archive', Constant::NOT_ARCHIVE], ['status', Constant::ACTIVE]])->get();
        // $return_data['fuel_type'] = FuelType::select('id', 'title')->where([['is_archive', Constant::NOT_ARCHIVE], ['status', Constant::ACTIVE]])->get();
        $return_data['site_title'] = trans('Scheduled Package Create');
        $return_data['categories'] = ServiceCategory::select('id', 'title')->where([['is_archive', Constant::NOT_ARCHIVE], ['status', Constant::ACTIVE]])->get();
        return view('backend.service.package.form',array_merge($this->data,$return_data));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function scheduledPackageStore(Request $request)
    {
        $this->validate($request, [
            'title' => ['required'],
            'sc_id' => ['required'],
            'time_takes' => 'required_without:time_takes_day',
            'time_takes_day' => 'required_without:time_takes',
        ]);

        $slug = $request->title != '' ? slugify($request->title) : NULL;

        $spackage = new ScheduledPackage();
        $fields = array('sc_id', 'title', 'image', 'image_other', 'warrenty_info', 'note', 'recommended_info', 'time_takes','time_takes_day','time_takes_option','meta_title','meta_keywords','meta_description');
        foreach($fields as $field){
            $spackage->$field = isset($request->$field) && $request->$field != '' ? $request->$field : NULL;
        }
        if($request->hasFile('image')) {
            $newName = fileUpload($request, 'image', 'uploads/service/package');
            $spackage->image = $newName;
        }
        if($request->hasFile('image_other')) {
            $newName = fileUpload($request, 'image_other', 'uploads/service/package');
            $spackage->image_other = $newName;
        }
        $spackage->slug = $slug;
        $spackage->created_by = Auth::guard('admin')->user()->id;
        $spackage->save();

        if($spackage){
            $sp_id = $spackage->id;
            $specification = isset($request->specification) ? $request->specification : array();
            if($specification){
                foreach($specification as $sk => $sv){
                    if($sv){
                        $spec = new PackageSpecification();
                        $spec->sp_id = $sp_id;
                        $spec->specification = $sv;
                        $spec->save();
                    }
                }
            }
            return redirect('backend/scheduled-package')->with('success', trans('Scheduled Package Added Successfully!'));
        } else {
            return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function scheduledPackageEdit($id)
    {
        $id = Crypt::decrypt($id);
        $return_data = array();
        $packages = ScheduledPackage::find($id);
        $return_data['record'] = $packages;
        $return_data['site_title'] = trans('Scheduled Package Edit');
        $return_data['categories'] = ServiceCategory::select('id', 'title')->where([['is_archive', Constant::NOT_ARCHIVE], ['status', Constant::ACTIVE]])->get();
        $return_data['specifications'] = PackageSpecification::select('id', 'specification')->where([['sp_id', $id]])->get();
        // $return_data['brands'] = CarBrand::select('id', 'title')->where([['is_archive', Constant::NOT_ARCHIVE], ['status', Constant::ACTIVE]])->get();
        // $return_data['fuel_type'] = FuelType::select('id', 'title')->where([['is_archive', Constant::NOT_ARCHIVE], ['status', Constant::ACTIVE]])->get();
        return view('backend.service.package.form', array_merge($this->data, $return_data));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function scheduledPackageUpdate(Request $request, $id)
    {

        $id = Crypt::decrypt($id);
        $this->validate($request, [
            'title' => ['required'],
            'sc_id' => ['required'],
            'time_takes' => 'required_without:time_takes_day',
            'time_takes_day' => 'required_without:time_takes',
        ]);

        $slug = $request->title != '' ? slugify($request->title) : NULL;

        $spackage = ScheduledPackage::find($id);
        $fields = array('sc_id', 'title', 'image','image_other', 'warrenty_info', 'recommended_info', 'note', 'time_takes','time_takes_day','time_takes_option','meta_title','meta_keywords','meta_description');
        foreach($fields as $field){
            $spackage->$field = isset($request->$field) && $request->$field != '' ? $request->$field : NULL;
        }
        if($request->hasFile('image')) {
            $old_image = $spackage->image;
            if($old_image){
                removeFile('uploads/service/package/'.$old_image);
            }
            $newName = fileUpload($request, 'image', 'uploads/service/package');
            $spackage->image = $newName;
        }
        if($request->hasFile('image_other')) {
            $old_image = $spackage->image_other;
            if($old_image){
                removeFile('uploads/service/package/'.$old_image);
            }
            $newName = fileUpload($request, 'image_other', 'uploads/service/package');
            $spackage->image_other = $newName;
        }
        $spackage->slug = $slug;
        $spackage->updated_by = Auth::guard('admin')->user()->id;
        if($request->time_takes_option=="Hour") {
            $spackage->time_takes_day = NULL;
        } elseif($request->time_takes_option=="Day") {
            $spackage->time_takes = NULL;
        }
        $spackage->save();
        if($spackage) {
            $sp_id = $spackage->id;
            $specification = isset($request->specification) ? $request->specification : array();
            $sid = isset($request->sid) ? $request->sid : array();
            if($specification){
                foreach($specification as $sk => $sv){
                    if($sv){
                        if(isset($sid[$sk]) && $sid[$sk]){
                            $spec = PackageSpecification::find($sid[$sk]);
                        } else {
                            $spec = new PackageSpecification();
                        }
                        $spec->sp_id = $sp_id;
                        $spec->specification = $sv;
                        $spec->save();
                    }
                }
            }
            return redirect('backend/scheduled-package')->with('success', trans('Scheduled Package Updated Successfully!'));
        } else {
            return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function scheduledPackageDestroy($id)
    {
        $id = Crypt::decrypt($id);
        $service_img = ScheduledPackage::where('id', $id)->first();
        $old_image_other = $service_img->image_other;
        if($old_image_other){
            removeFile('uploads/service/package/'.$old_image_other);
        }
        $old_image = $service_img->image;
        if($old_image){
            removeFile('uploads/service/package/'.$old_image);
        }
        $page = ScheduledPackage::where('id', $id)->delete();
        if($page) {

            $package_specification = PackageSpecification::where('sp_id', $id)->delete();
            return redirect('backend/scheduled-package')->with('success', trans('Scheduled Package Deleted Successfully!'));
        } else {
            return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
        }
    }
    public function scheduledPackageDatatable(request $request)
    {
        if($request->ajax()){
            $query = ScheduledPackage::with('categoryDetail', 'brandDetail', 'modelDetail', 'fuelTypeDetail')->select('id', 'sc_id', 'title', 'image', 'warrenty_info', 'recommended_info', 'note', 'time_takes', 'time_takes_day', 'time_takes_option')->where('is_archive', '=', Constant::NOT_ARCHIVE)->orderBy('id', 'DESC');

            if($request->serviceCategory!='all') {
                if($request->serviceCategory!='') {
                    $query->whereHas('categoryDetail', function($q) use ($request) {
                        $q->where([['sc_id', '=', $request->serviceCategory]]);
                    });
                }
            }
            // if($request->brand!='all') {
            //     if($request->brand!='') {
            //         $query->whereHas('brandDetail', function($q) use ($request) {
            //             $q->where([['brand_id', '=', $request->brand]]);
            //         });
            //     }
            // }
            // if($request->carModel!='all') {
            //     if($request->carModel!='') {
            //         $query->whereHas('modelDetail', function($q) use ($request) {
            //             $q->where([['model_id', '=', $request->carModel]]);
            //         });
            //     }
            // }
            // if($request->fuelType!='all') {
            //     if($request->fuelType!='') {
            //         $query->whereHas('fuelTypeDetail', function($q) use ($request) {
            //             $q->where([['fuel_type_id', '=', $request->fuelType]]);
            //         });
            //     }
            // }

            $list = $query->get();

            return DataTables::of($list)
                ->addColumn('image', function ($row) {
                    $image = $row->image ? "<img src='".url('uploads/service/package/'.$row->image)."' width='80px' height='80px'>" : '';
                    return $image;
                })
                ->addColumn('category', function($row){
                    $category = isset($row->categoryDetail->title) ? $row->categoryDetail->title : NULL;
                    return $category;
                })
                // ->addColumn('car_detail', function($row){
                //     $brand = isset($row->brandDetail->title) ? $row->brandDetail->title : NULL;
                //     $model = isset($row->modelDetail->title) ? $row->modelDetail->title : NULL;
                //     $fuel_type = isset($row->fuelTypeDetail->title) ? $row->fuelTypeDetail->title : NULL;
                //     return $brand.' - '.$model.' - '.$fuel_type;
                // })
                ->addColumn('time_takes', function($row){
                    // $time = isset($row->time_takes) && $row->time_takes ? $row->time_takes.' Hrs' : NULL;
                    $time = ($row->time_takes_option=="Hour") ? $row->time_takes." Hr(s)" : $row->time_takes_day." Day(s)";
                    return $time;
                })
                ->addColumn('action', function ($row) {
                    $html = "";
                    $id = Crypt::encrypt($row->id);
                    $html .= "<span class='text-nowrap'>";
                    $html .= "<a href='".route('admin_scheduled-package-edit', array($id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";
                    $html .= "<a href='javascript:void(0);' data-href='".route('admin_scheduled-package-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                    $html .= "<a href='".route('admin_scheduled-package-detail',array($id))."' rel='tooltip' title='".trans('Price Detail')."' class='btn btn-info btn-sm'>Price Detail</a>";
                    $html .= "</span>";
                    return $html;
                })
                ->rawColumns(['image', 'category', 'time_takes', 'action'])
                ->make(true);
        } else {
            return redirect('backend/dashboard');
        }
    }

    public function priceDetailList(request $request,$id)
    {
        $return_data = array();       
        $return_data['site_title'] = trans('Sheduled Package Detail');
        $id = Crypt::decrypt($id);
        $detail = ScheduledPackage::find($id);
        if(!isset($detail->id)){
            return redirect()->back()->with('error', 'Something went wrong, please try again later!');
        }
        $return_data['detail'] = $detail;
        return view('backend.service.package.price_detail', array_merge($this->data, $return_data));
    }
    public function priceDetailDataTable(Request $request)
    {
        if($request->ajax()){
            $query = ScheduledPackageDetail::with('brandDetail', 'modelDetail', 'fuelTypeDetail')->select('id', 'sp_id', 'brand_id', 'model_id', 'fuel_type_id', 'price')->where('sp_id',$request->sheduled_package_id);

            $list = $query->get();
            return DataTables::of($list)
                ->addColumn('brand_id', function ($row) {
                    $brand_id = isset($row->brandDetail->title) ? $row->brandDetail->title : NULL;
                    return $brand_id;
                })
                ->addColumn('model_id', function($row){
                    $model_id = isset($row->modelDetail->title) ? $row->modelDetail->title : NULL;
                    return $model_id;
                })
                ->addColumn('fuel_type_id', function($row){
                    $fuel_type = isset($row->fuelTypeDetail->title) ? $row->fuelTypeDetail->title : NULL;
                    return $fuel_type;
                })
                // ->addColumn('action', function ($row) {
                //     $html = "";
                //     $id = Crypt::encrypt($row->id);
                //     $html .= "<span class='text-nowrap'>";
                //     // $html .= "<a href='".route('admin_scheduled-package-edit', array($id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";
                //     // $html .= "<a href='javascript:void(0);' data-href='".route('admin_scheduled-package-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                //     // $html .= "<a href='' rel='tooltip' title='".trans('Price Detail')."' class='btn btn-info btn-sm'>Price Detail</a>";
                //     $html .= "</span>";
                //     return $html;
                // })
                ->rawColumns(['brand_id', 'model_id', 'fuel_type_id'])
                ->make(true);
        } else {
            return redirect('backend/dashboard');
        }
    }

    public function specificationDelete(request $request){
        if($request->ajax()){
            PackageSpecification::where('id', $request->id)->delete();
        } else {
            return redirect('backend/dashboard');
        }
    }

    public function getModelFromBrand(request $request){
        if($request->ajax()){
            $brand_id = $request->brand_id;
            $models = CarModel::where([['carbrand_id', $brand_id], ['is_archive', '=', Constant::NOT_ARCHIVE], ['status', Constant::ACTIVE]])->get();
            // print_r($brand_id);
            $return_data = array();
            $html = '<option value="">--select--</option>';
            if($models->count()){
                foreach($models as $value){
                    $html .= '<option value="'.$value->id.'">'.$value->title.'</option>';
                }
            }
            $return_data['html'] = $html;
            echo json_encode($return_data);exit;
        } else {
            return redirect('backend/dashboard');
        }
    }

    public function getModelFromMaker(request $request){
        if($request->ajax()){
            $maker_id = $request->brand;
            $models = CarModel::where([['carbrand_id', $maker_id], ['is_archive', '=', Constant::NOT_ARCHIVE], ['status', Constant::ACTIVE]])->get();
            $return_data = array();
            $html = '<option value="">--select--</option>';
            if($models->count()){
                foreach($models as $value){
                    $html .= '<option value="'.$value->id.'">'.$value->title.'</option>';
                }
            }
            $return_data['html'] = $html;
            echo json_encode($return_data);exit;
        } else {
            return redirect('backend/dashboard');
        }
    }

    public function getFuelFromModel(request $request){
        if($request->ajax()){
            $maker_id = $request->brand;
            $model_id = $request->model_id;
            $fuel = ScheduledPackageDetail::select('fuel_type_id','brand_id','model_id')->with('fuelTypeDetail')->where([['brand_id', $maker_id],['model_id', $model_id]])->orderBy('id')->get();
            // print_r($fuel);
            $return_data = array();
            $html = '<option value="">--select--</option>';
            if($fuel->count()){
                foreach($fuel->unique('fuel_type_id') as $value){
                    $html .= '<option value="'.$value->fuel_type_id.'">'.$value->fuelTypeDetail->title.'</option>';
                }
            }
            $return_data['html'] = $html;
            echo json_encode($return_data);exit;
        } else {
            return redirect('backend/dashboard');
        }
    }

    public function bookedServices(request $request){
        $return_data = array();       
        $return_data['site_title'] = trans('Booked Services');
        $return_data['packages'] = ScheduledPackage::select('id', 'title')->where([['is_archive', Constant::NOT_ARCHIVE], ['status', Constant::ACTIVE]])->get();
        $return_data['brands'] = CarBrand::select('id', 'title')->where([['is_archive', Constant::NOT_ARCHIVE], ['status', Constant::ACTIVE]])->get();
        // $brand = CarBrand::select('id', 'title')->where([['is_archive', Constant::NOT_ARCHIVE], ['status', Constant::ACTIVE]])->first();
        $return_data['models'] = CarModel::select('id', 'title')->where([['is_archive', Constant::NOT_ARCHIVE], ['status', Constant::ACTIVE]])->get();
        $return_data['fuel_type'] = FuelType::select('id', 'title')->where([['is_archive', Constant::NOT_ARCHIVE], ['status', Constant::ACTIVE]])->get();
        $return_data['od_id'] = $request->get('od_id') ? Crypt::decrypt($request->get('od_id')) : NULL;
        $aslots = PickUpSlotSetting::select('id', 'time', 'slot')->where('slot', Constant::AFTERNOON)->orderBy('id')->get();
        $eslots = PickUpSlotSetting::select('id', 'time', 'slot')->where('slot', Constant::EVENING)->orderBy('id')->get();
        $mslots = PickUpSlotSetting::select('id', 'time', 'slot')->where('slot', Constant::MORNING)->orderBy('id')->get();
        $return_data['aslots'] = $aslots;
        $return_data['eslots'] = $eslots;
        $return_data['mslots'] = $mslots;
        return view('backend.service.booked', array_merge($this->data, $return_data));
    }

    public function bookedServicesDatatable(request $request)
    {
        if($request->ajax()){
            $query = BookedSlot::with('userDetail', 'order', 'packageDetail')->select('id', 'user_id', 'order_id', 'order_detail_id', 'service_id', 'slot_date', 'pick_up_time1', 'pick_up_time2', 'time_type', 'time_takes')->orderBy('id', 'DESC');

            if($request->od_id){
                $query->where('order_detail_id', $request->od_id);
            }

            $query->whereHas('order', function($q) use ($request) {
                $q->where('is_complete', '!=', '2');
            });
            if($request->package != 'all'){
                $query->whereHas('packageDetail', function($q) use ($request) {
                    $q->whereHas('packageDetail', function($qq) use ($request) {
                        $qq->where([['id', '=', $request->package]]);
                    });
                });
            }
            if($request->brand != 'all'){
                $query->whereHas('packageDetail', function($q) use ($request) {
                    $q->whereHas('brandDetail', function($qq) use ($request) {
                        $qq->where([['id', '=', $request->brand]]);
                    });
                });
            }
            // if($request->model_id != 'all'){
            //     $query->whereHas('packageDetail', function($q) use ($request) {
            //         $q->whereHas('modelDetail', function($qq) use ($request) {
            //             $qq->where([['id', '=', $request->model_id]]);
            //         });
            //     });
            // }

            if($request->model_id){
                $query->whereHas('packageDetail', function($q) use ($request) {
                    $q->whereHas('modelDetail', function($qq) use ($request) {
                        $qq->where([['id', '=', $request->model]]);
                    });
                });
            }

            // if($request->fuel_type != 'all'){
            //     $query->whereHas('packageDetail', function($q) use ($request) {
            //         $q->whereHas('fuelTypeDetail', function($qq) use ($request) {
            //             $qq->where([['id', '=', $request->fuel_type]]);
            //         });
            //     });
            // }
                if($request->fuel_type_id){
                    $query->whereHas('packageDetail', function($q) use ($request) {
                        $q->whereHas('fuelTypeDetail', function($qq) use ($request) {
                            $qq->where([['id', '=', $request->fuel_type]]);
                        });
                    });
                }
            $list = $query->get();

            return DataTables::of($list)
                ->addColumn('order_no', function ($row){
                    $invoice_no = isset($row->order->invoice_no) ? $row->order->invoice_no : NULL;
                    $order_id = isset($row->order_id) && $row->order_id ? Crypt::encrypt($row->order_id) : NULL;
                    $html = "<span class='text-nowrap'>";
                    $html .= $order_id ? "<a href='".route('admin_order-detail', array($order_id))."' target='blank'>#".$invoice_no."</a>" : "";
                    $html .= "</span>";
                    return $html;
                })
                ->addColumn('user', function ($row) {
                    $user_id = $row->user_id ? Crypt::encrypt($row->user_id) : NULL;
                    
                    $user = isset($row->order->name) ? $row->order->name : '';
                    $html = $user_id ? "<a href='".route('admin_user-detail', array($user_id)).">' target='_blank'>".$user."</a>" : $user;
                    return $html;
                })
                ->addColumn('phone', function($row){
                    $phone = isset($row->order->phone) ? $row->order->phone : '';
                    return $phone;
                })
                ->addColumn('service', function($row){
                    $scheduled_title = isset($row->packageDetail->packageDetail->title) ? $row->packageDetail->packageDetail->title : NULL;
                    $brand = isset($row->packageDetail->brandDetail->title) ? $row->packageDetail->brandDetail->title : NULL;
                    $model = isset($row->packageDetail->modelDetail->title) ? $row->packageDetail->modelDetail->title : NULL;
                    $fuel_type = isset($row->packageDetail->fuelTypeDetail->title) ? $row->packageDetail->fuelTypeDetail->title : NULL;
                    return "<span class='text-nowrap'>".$scheduled_title."</br>".$brand.' - '.$model.' - '.$fuel_type."</span>";
                })
                ->addColumn('booked_date', function($row){
                    $html = "<span class='text-nowrap'>";
                    $html .= isset($row->slot_date) && $row->slot_date ? date('d/m/Y', strtotime($row->slot_date)) : NULL;
                    $html .= "</span>";
                    return $html;
                })
                ->addColumn('time', function($row){
                    $html = "<span class='text-nowrap'>";
                    $html .= $row->pick_up_time1.' - '.$row->pick_up_time2;
                    $html .= $row->time_type == '0' ? 'AM' : 'PM';
                    $html .= "</span>";
                    return $html;
                })
                ->addColumn('time_takes', function($row){
                    $time = isset($row->time_takes) && $row->time_takes ? $row->time_takes.' Hrs' : NULL;
                    return $time;
                })
                ->addColumn('action', function ($row) {
                    $html = "";
                    $id = Crypt::encrypt($row->id);
                    $order_status = isset($row->order->is_complete) ? $row->order->is_complete : NULL;
                    $html .= "<span class='text-nowrap'>";
                    if($order_status == '0'){
                        $html .= "<a class='badge bg-primary me-1 my-1 change_slot' href='javascript:void(0);' data-id='".$row->id."'>Change Slot Time</a>";
                    } else {
                        $html .= "<h6 class='text-success'>Order Completed</h6>";
                    }
                    $html .= "</span>";
                    
                    return $html;
                })
                ->rawColumns(['order_no', 'user', 'phone', 'service', 'booked_date', 'time', 'time_takes', 'action'])
                ->make(true);
        } else {
            return redirect('backend/dashboard');
        }
    }

    public function changeServiceSlot(request $request){
        if(isset($request->booking_id) && $request->booking_id){
            $slot_time = $request->slot_time;
            $slot_time = str_replace(' ', '', $slot_time);
            $slotarray = explode('-', $slot_time);
            $slot2 = isset($slotarray[1]) ? $slotarray[1] : NULL;
            $time_type = 1;
            if( $slot2 && strpos( $slot2, "AM" ) !== false) {
                $time_type = 0;
            }
            $slot2 = str_replace('AM', '', $slot2);
            $slot2 = str_replace('PM', '', $slot2);

            $slot = BookedSlot::find($request->booking_id);
            $slot->slot_date = $request->slot_date;
            $slot->pick_up_time1 = isset($slotarray[0]) ? $slotarray[0] : NULL;
            $slot->pick_up_time2 = $slot2;
            $slot->time_type = $time_type;
            $slot->save();

            if($slot){

                // Send email for Time Rearrange - Start
                $serviceInfo = BookedSlot::with('order')->select('*')->where('id', $request->booking_id)->first();
                $user = isset($serviceInfo->order->name) && $serviceInfo->order->name ? $serviceInfo->order->name : NULL;
                $invoice_no = isset($serviceInfo->order->invoice_no) && $serviceInfo->order->invoice_no ? $serviceInfo->order->invoice_no : NULL;
                $email = isset($serviceInfo->order->email) && $serviceInfo->order->email ? $serviceInfo->order->email : NULL;
                $date = $request->slot_date ? date('d/m/Y', strtotime($request->slot_date)) : NULL;

                $templateStr = array('[USER]', '[INVOICE-NO]', '[DATE]', '[TIME]');
                $data = array($user, $invoice_no, $date, $request->slot_time);
                $ndata = EmailTemplates::select('template')->where('label', 'time_rearrange')->first();
                $html = isset($ndata->template) ? $ndata->template : NULL;
                $mailHtml = str_replace($templateStr, $data, $html);
//                print_r($mailHtml);exit;
//                \Mail::to($email)->send(new \App\Mail\CommonMail($mailHtml, 'Time Rearrange - '.$this->data['site_name']));
                // Send email for Time Rearrange - End
                return redirect('backend/booked-services')->with('success', 'Slot Information updated successfully!');
            } else {
                return redirect()->back()->with('error', 'Something went wrong, please try again later!');
            }
        } else {
            return redirect()->back()->with('error', 'Something went wrong, please try again later!');
        }
    }

    public function importSchedulePackage(request $request){
        if (!file_exists($_FILES['myfile']['tmp_name']) || !is_readable($_FILES['myfile']['tmp_name'])){
            return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
        }
        $header = null;
        $data = array();
        if (($handle = fopen($_FILES['myfile']['tmp_name'], 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = $row;
            }
            fclose($handle);
        }

        $header = isset($data[0]) && $data[0] ? $data[0] : array();
        foreach($data as $key => $value){
            if($key != 0){
                $brand_id = $model_id = $fuel_type_id = '';
                foreach($value as $k => $v){
                     //carbrand
                    if($k == 0){
                        $carbrand = CarBrand::where('title', $v)->first();
                        if ($carbrand) {
                            $brand_id = $carbrand->id;

                        } else {
                        $brand_id = $v;
                        }

                    }
                    //model
                    if($k == 1){
                        $carmodel=CarModel::where('title',$v)->first();
                        if($carmodel){
                            $model_id = $carmodel->id;
                        }else{
                            $model_id = $v;
                        }
                       
                    }
                    //fule type
                    if($k == 2){
                        $fuletype=FuelType::where('title',$v)->first();
                        if($fuletype){
                            $fuel_type_id = $fuletype->id;
                        }else{
                            $fuel_type_id = $v;    
                        }
                         
                    }
                    if($k > 2 & $v != ""){
                        $sp_id = isset($header[$k]) ? $header[$k] : NULL;
                        $price = $v;

                        $spdetail = ScheduledPackageDetail::select('id')->where([['sp_id', $sp_id], ['brand_id', $brand_id], ['model_id', $model_id], ['fuel_type_id', $fuel_type_id]])->first();
                        $spd_id = isset($spdetail->id) ? $spdetail->id : NULL;
                        if($spd_id){
                            $package_detail = ScheduledPackageDetail::find($spd_id);
                        } else {
                            $package_detail = new ScheduledPackageDetail();
                            $package_detail->sp_id = $sp_id;
                            $package_detail->brand_id = $brand_id;
                            $package_detail->model_id = $model_id;
                            $package_detail->fuel_type_id = $fuel_type_id;
                        }
                        $package_detail->price = $price;
                        $package_detail->save();
                    }
                }
            }
        }
        return redirect()->back()->with('success', trans('Scheduled Pacakge Detail Uploaded Successfully!'));
    }

    public function serviceCategoryOrderBy(Request $request)
    {
        $service_category_fields = array('order_by'=>$request->order_by);
        ServiceCategory::where([['id', '=', $request->category_id]])->update($service_category_fields);
        echo json_encode(array('success'=>true, 'message' => "Service Category order updated successfully."));
        exit;
    }
}
