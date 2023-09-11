<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/404', function () {
    abort(404);
});
Route::get('/clear-cache', function() {
   $exitCode = Artisan::call('cache:clear');
   // return what you want
});
Route::get('/clear-optimize', function() {
   $exitCode = Artisan::call('optimize:clear');
   // return what you want
});
Route::get('/clear-view', function() {
   $exitCode = Artisan::call('view:clear');
   // return what you want
});
Route::group(['prefix' => 'backend','as' => 'admin_'], function() {
    Route::get('login', [App\Http\Controllers\Backend\Auth\LoginController::class, 'showLoginForm'])->name('login')->middleware('XSS');
    Route::post('checkedlogin', [App\Http\Controllers\Backend\Auth\LoginController::class, 'login'])->name('checkedlogin')->middleware('XSS');
    Route::get('logout/', [App\Http\Controllers\Backend\Auth\LoginController::class, 'logout'])->name('logout')->middleware('XSS');
    Route::get('/', [App\Http\Controllers\Backend\Auth\LoginController::class, 'showLoginForm'])->name('login')->middleware('XSS');

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/dashboard', [App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard')->middleware('XSS');

        Route::get('change-password', [App\Http\Controllers\Backend\DashboardController::class, 'showchangePasswordForm'])->name('change-password')->middleware('XSS');
        Route::post('change-password', [App\Http\Controllers\Backend\DashboardController::class, 'changePassword'])->name('change-password')->middleware('XSS');

        Route::get('site-settings', [\App\Http\Controllers\Backend\SettingsController::class, 'index'])->name('site-settings');
        Route::post('site-settings', [\App\Http\Controllers\Backend\SettingsController::class, 'update'])->name('site-settings');
        Route::get('pick-up-slot-settings', [\App\Http\Controllers\Backend\SettingsController::class, 'pickUpSlotSetting'])->name('pick-up-slot-settings');
        Route::post('pick-up-slot-settings', [\App\Http\Controllers\Backend\SettingsController::class, 'pickUpSlotSettingUpdate'])->name('pick-up-slot-settings');
        Route::post('pick-up-slot-delete', [\App\Http\Controllers\Backend\SettingsController::class, 'pickUpSlotDelete'])->name('pick-up-slot-delete');

        Route::get('email-templates', [\App\Http\Controllers\Backend\EmailTemplatesController::class, 'index'])->name('email-templates');
        Route::post('email-templates', [\App\Http\Controllers\Backend\EmailTemplatesController::class, 'update'])->name('email-templates');

        Route::get('pages',[App\Http\Controllers\Backend\PageController::class, 'index'])->name('pages');
        Route::get('page-create',[App\Http\Controllers\Backend\PageController::class, 'create'])->name('page-create');
        Route::post('page-store',[App\Http\Controllers\Backend\PageController::class, 'store'])->name('page-store');
        Route::get('page-edit/{id}',[App\Http\Controllers\Backend\PageController::class, 'edit'])->name('page-edit');
        Route::post('page-update/{id}',[App\Http\Controllers\Backend\PageController::class, 'update'])->name('page-update');
        Route::get('page-delete/{id}', [App\Http\Controllers\Backend\PageController::class, 'destroy'])->name('page-delete');
        Route::post('page-datatable', [App\Http\Controllers\Backend\PageController::class, 'pagesDatatable'])->name('page-datatable');

        Route::get('compnycms',[App\Http\Controllers\Backend\CompnyCmsPageController::class, 'index'])->name('compnycms');
        Route::get('compnycms-create',[App\Http\Controllers\Backend\CompnyCmsPageController::class, 'create'])->name('compnycms-create');
        Route::post('compnycms-store',[App\Http\Controllers\Backend\CompnyCmsPageController::class, 'store'])->name('compnycms-store');
        Route::get('compnycms-edit/{id}',[App\Http\Controllers\Backend\CompnyCmsPageController::class, 'edit'])->name('compnycms-edit');
        Route::post('compnycms-update/{id}',[App\Http\Controllers\Backend\CompnyCmsPageController::class, 'update'])->name('compnycms-update');
        Route::get('compnycms-delete/{id}', [App\Http\Controllers\Backend\CompnyCmsPageController::class, 'destroy'])->name('compnycms-delete');
        Route::post('compnycms-datatable', [App\Http\Controllers\Backend\CompnyCmsPageController::class, 'CompnyCmsPageDatatable'])->name('compnycms-datatable');

        Route::get('car-brand',[App\Http\Controllers\Backend\CarBrandController::class, 'index'])->name('car-brand')->middleware('XSS');
        Route::post('ajax-edit-brand-html',[App\Http\Controllers\Backend\CarBrandController::class, 'ajaxEditCarBrandHtml'])->name('ajax-edit-brand-html')->middleware('XSS');
        Route::post('car-brand-datatable', [App\Http\Controllers\Backend\CarBrandController::class, 'carbrandsDatatable'])->name('car-brand-datatable')->middleware('XSS');
        Route::post('car-brand-store',[App\Http\Controllers\Backend\CarBrandController::class, 'store'])->name('car-brand-store')->middleware('XSS');
        Route::post('car-brand-update/{id}',[App\Http\Controllers\Backend\CarBrandController::class, 'update'])->name('car-brand-update')->middleware('XSS');
        Route::get('car-brand-delete/{id}', [App\Http\Controllers\Backend\CarBrandController::class, 'destroy'])->name('car-brand-delete')->middleware('XSS');
        Route::post('change-car-brand-status', [App\Http\Controllers\Backend\CarBrandController::class, 'changeCarBrandStatus'])->name('change-car-brand-status')->middleware('XSS');
        Route::post('car-brand-import', [App\Http\Controllers\Backend\CarBrandController::class, 'import'])->name('car-brand-import');
        Route::get('car-brand-import-add', [App\Http\Controllers\Backend\CarBrandController::class, 'importAdd'])->name('car-brand-import-add');
        Route::get('car-brand-csv-export', [App\Http\Controllers\Backend\CarBrandController::class, 'export'])->name('car-brand-csv-export');

        Route::get('car-model',[App\Http\Controllers\Backend\CarModelController::class, 'index'])->name('car-model')->middleware('XSS');
        Route::post('ajax-edit-model-html',[App\Http\Controllers\Backend\CarModelController::class, 'ajaxEditModelHtml'])->name('ajax-edit-model-html')->middleware('XSS');
        Route::post('car-model-datatable', [App\Http\Controllers\Backend\CarModelController::class, 'carmodelsDatatable'])->name('car-model-datatable')->middleware('XSS');
        Route::post('car-model-store',[App\Http\Controllers\Backend\CarModelController::class, 'store'])->name('car-model-store')->middleware('XSS');
        Route::post('car-model-update/{id}',[App\Http\Controllers\Backend\CarModelController::class, 'update'])->name('car-model-update')->middleware('XSS');
        Route::get('car-model-delete/{id}', [App\Http\Controllers\Backend\CarModelController::class, 'destroy'])->name('car-model-delete')->middleware('XSS');
        Route::post('change-car-model-status', [App\Http\Controllers\Backend\CarModelController::class, 'changeCarModelStatus'])->name('change-car-model-status')->middleware('XSS');
        Route::post('car-model-import', [App\Http\Controllers\Backend\CarModelController::class, 'import'])->name('car-model-import');
        Route::get('car-model-import-add', [App\Http\Controllers\Backend\CarModelController::class, 'importAdd'])->name('car-model-import-add');
        Route::get('car-model-csv-export', [App\Http\Controllers\Backend\CarModelController::class, 'export'])->name('car-model-csv-export');

        Route::get('fuel-type',[App\Http\Controllers\Backend\FuelTypeController::class, 'index'])->name('fuel-type')->middleware('XSS');
        Route::post('ajax-edit-fuel-html',[App\Http\Controllers\Backend\FuelTypeController::class, 'ajaxEditFuelHtml'])->name('ajax-edit-fuel-html')->middleware('XSS');
        Route::post('fuel-type-datatable', [App\Http\Controllers\Backend\FuelTypeController::class, 'fueltypeDatatable'])->name('fuel-type-datatable')->middleware('XSS');
        Route::post('fuel-type-store',[App\Http\Controllers\Backend\FuelTypeController::class, 'store'])->name('fuel-type-store')->middleware('XSS');
        Route::post('fuel-type-update/{id}',[App\Http\Controllers\Backend\FuelTypeController::class, 'update'])->name('fuel-type-update')->middleware('XSS');
        Route::get('fuel-type-delete/{id}', [App\Http\Controllers\Backend\FuelTypeController::class, 'destroy'])->name('fuel-type-delete')->middleware('XSS');
        Route::post('change-fuel-type-status', [App\Http\Controllers\Backend\FuelTypeController::class, 'changeFuelTypeStatus'])->name('change-fuel-type-status')->middleware('XSS');

        Route::get('service-category',[App\Http\Controllers\Backend\ServiceController::class, 'serviceCategoryList'])->name('service-category')->middleware('XSS');
        Route::get('service-category-create',[App\Http\Controllers\Backend\ServiceController::class, 'serviceCategorycreate'])->name('service-category-create')->middleware('XSS');
        Route::post('service-category-datatable', [App\Http\Controllers\Backend\ServiceController::class, 'serviceCategoryDatatable'])->name('service-category-datatable')->middleware('XSS');
        Route::post('service-category-store',[App\Http\Controllers\Backend\ServiceController::class, 'serviceCategoryStore'])->name('service-category-store');
        Route::get('service-category-edit/{id}',[App\Http\Controllers\Backend\ServiceController::class, 'serviceCategoryedit'])->name('service-category-edit');
        Route::post('service-category-update/{id}',[App\Http\Controllers\Backend\ServiceController::class, 'serviceCategoryUpdate'])->name('service-category-update');
        Route::get('service-category-delete/{id}', [App\Http\Controllers\Backend\ServiceController::class, 'serviceCategoryDestroy'])->name('service-category-delete')->middleware('XSS');
        Route::post('change-service-category-status', [App\Http\Controllers\Backend\ServiceController::class, 'changeServiceCategoryStatus'])->name('change-service-category-status')->middleware('XSS');
        Route::get('booked-services', [App\Http\Controllers\Backend\ServiceController::class, 'bookedServices'])->name('booked-services');
        Route::post('booked-service-datatable', [App\Http\Controllers\Backend\ServiceController::class, 'bookedServicesDatatable'])->name('booked-service-datatable');
        Route::post('change-service-slot', [App\Http\Controllers\Backend\ServiceController::class, 'changeServiceSlot'])->name('change-service-slot');
        Route::post('service-category-order-by', [App\Http\Controllers\Backend\ServiceController::class, 'serviceCategoryOrderBy'])->name('service-category-order-by');

        Route::get('products',[App\Http\Controllers\Backend\ProductController::class, 'index'])->name('products');
        Route::get('product-create',[App\Http\Controllers\Backend\ProductController::class, 'create'])->name('product-create');
        Route::post('product-store',[App\Http\Controllers\Backend\ProductController::class, 'store'])->name('product-store');
        Route::get('product-edit/{id}',[App\Http\Controllers\Backend\ProductController::class, 'edit'])->name('product-edit');
        Route::post('product-update/{id}',[App\Http\Controllers\Backend\ProductController::class, 'update'])->name('product-update');
        Route::get('product-delete/{id}', [App\Http\Controllers\Backend\ProductController::class, 'destroy'])->name('product-delete');
        Route::post('product-datatable', [App\Http\Controllers\Backend\ProductController::class, 'productsDatatable'])->name('product-datatable');
        Route::post('change-product-status', [App\Http\Controllers\Backend\ProductController::class, 'changeProductStatus'])->name('change-product-status')->middleware('XSS');
        Route::post('product-image-ajax-html', [\App\Http\Controllers\Backend\ProductController::class, 'imageAjaxHtml'])->name('product-image-ajax-html');
        Route::post('product-image-delete', [\App\Http\Controllers\Backend\ProductController::class, 'imageDelete'])->name('product-image-delete');
        Route::post('make-product-slug', [\App\Http\Controllers\Backend\ProductController::class, 'makeSlug'])->name('make-product-slug');
        Route::get('product-detail/{id?}', [\App\Http\Controllers\Backend\ProductController::class, 'productDetail'])->name('product-detail');
        Route::post('product-import', [App\Http\Controllers\Backend\ProductController::class, 'import'])->name('product-import');
        Route::get('product-import-add', [App\Http\Controllers\Backend\ProductController::class, 'importAdd'])->name('product-import-add');
        Route::get('product-csv-export', [App\Http\Controllers\Backend\ProductController::class, 'export'])->name('product-csv-export');

        Route::get('home-page-content', [\App\Http\Controllers\Backend\HomePageSettingController::class, 'index'])->name('home-page-content');
        Route::post('home-page-content-update', [\App\Http\Controllers\Backend\HomePageSettingController::class, 'update'])->name('home-page-content-update');
        Route::get('brand-logo-slider',[App\Http\Controllers\Backend\HomePageSettingController::class, 'brandLogoSlider'])->name('brand-logo-slider');
        Route::post('brand-logo-slider',[App\Http\Controllers\Backend\HomePageSettingController::class, 'slideupdate'])->name('brand-logo-slider')->middleware('XSS');
        Route::post('brand-logo-slider-delete', [\App\Http\Controllers\Backend\HomePageSettingController::class, 'slideDelete'])->name('brand-logo-slider-delete');

        Route::get('offer-slider',[App\Http\Controllers\Backend\OfferSliderController::class, 'index'])->name('offer-slider');
        Route::post('offer-slider',[App\Http\Controllers\Backend\OfferSliderController::class, 'slideupdate'])->name('offer-slider')->middleware('XSS');
        Route::post('offer-slider-delete', [\App\Http\Controllers\Backend\OfferSliderController::class, 'offerSliderDelete'])->name('offer-slider-delete');

        Route::get('scheduled-package',[App\Http\Controllers\Backend\ServiceController::class, 'scheduledPackageList'])->name('scheduled-package')->middleware('XSS');
        Route::get('scheduled-package-create',[App\Http\Controllers\Backend\ServiceController::class, 'scheduledPackageCreate'])->name('scheduled-package-create')->middleware('XSS');
        Route::post('scheduled-package-store',[App\Http\Controllers\Backend\ServiceController::class, 'scheduledPackageStore'])->name('scheduled-package-store')->middleware('XSS');;
        Route::get('scheduled-package-edit/{id}',[App\Http\Controllers\Backend\ServiceController::class, 'scheduledPackageEdit'])->name('scheduled-package-edit')->middleware('XSS');
        Route::post('scheduled-package-update/{id}',[App\Http\Controllers\Backend\ServiceController::class, 'scheduledPackageUpdate'])->name('scheduled-package-update')->middleware('XSS');;
        Route::get('scheduled-package-delete/{id}', [App\Http\Controllers\Backend\ServiceController::class, 'scheduledPackageDestroy'])->name('scheduled-package-delete')->middleware('XSS');
        Route::post('scheduled-package-datatable', [App\Http\Controllers\Backend\ServiceController::class, 'scheduledPackageDatatable'])->name('scheduled-package-datatable')->middleware('XSS');
        Route::post('specification-delete', [App\Http\Controllers\Backend\ServiceController::class, 'specificationDelete'])->name('specification-delete')->middleware('XSS');
        Route::post('get-model-from-brand', [App\Http\Controllers\Backend\ServiceController::class, 'getModelFromBrand'])->name('get-model-from-brand')->middleware('XSS');
        Route::post('import-schedule-package', [App\Http\Controllers\Backend\ServiceController::class, 'importSchedulePackage'])->name('import-schedule-package')->middleware('XSS');

        Route::get('scheduled-package-detail/{id?}',[App\Http\Controllers\Backend\ServiceController::class, 'priceDetailList'])->name('scheduled-package-detail');
        Route::post('scheduled-package-pricedatatable', [App\Http\Controllers\Backend\ServiceController::class, 'priceDetailDataTable'])->name('scheduled-package-pricedatatable');

        Route::get('smtp', [App\Http\Controllers\Backend\SMTPController::class, 'index'])->name('smtp')->middleware('XSS');
        Route::post('smtp_update', [App\Http\Controllers\Backend\SMTPController::class, 'update'])->name('smtp_update')->middleware('XSS');

        Route::get('shop-category',[App\Http\Controllers\Backend\ShopCategoryController::class, 'index'])->name('shop-category')->middleware('XSS');
        Route::post('ajax-edit-shopcategory-html',[App\Http\Controllers\Backend\ShopCategoryController::class, 'ajaxEditShopCategoryHtml'])->name('ajax-edit-shopcategory-html')->middleware('XSS');
        Route::post('shop-category-datatable', [App\Http\Controllers\Backend\ShopCategoryController::class, 'shopcategoriesDatatable'])->name('shop-category-datatable')->middleware('XSS');
        Route::post('shop-category-store',[App\Http\Controllers\Backend\ShopCategoryController::class, 'store'])->name('shop-category-store')->middleware('XSS');
        Route::post('shop-category-update/{id}',[App\Http\Controllers\Backend\ShopCategoryController::class, 'update'])->name('shop-category-update')->middleware('XSS');
        Route::get('shop-category-delete/{id}', [App\Http\Controllers\Backend\ShopCategoryController::class, 'destroy'])->name('shop-category-delete')->middleware('XSS');
        Route::post('change-shop-category-status', [App\Http\Controllers\Backend\ShopCategoryController::class, 'changeShopCategoryStatus'])->name('change-shop-category-status')->middleware('XSS');

        Route::get('faq',[App\Http\Controllers\Backend\FaqController::class, 'index'])->name('faq')->middleware('XSS');
        Route::get('faq-create',[App\Http\Controllers\Backend\FaqController::class, 'create'])->name('faq-create');
        Route::post('faq-store',[App\Http\Controllers\Backend\FaqController::class, 'store'])->name('faq-store');
        Route::get('faq-edit/{id}',[App\Http\Controllers\Backend\FaqController::class, 'edit'])->name('faq-edit');
        Route::post('faq-update/{id}',[App\Http\Controllers\Backend\FaqController::class, 'update'])->name('faq-update');
        Route::get('faq-delete/{id}', [App\Http\Controllers\Backend\FaqController::class, 'destroy'])->name('faq-delete');
        Route::post('faq-datatable', [App\Http\Controllers\Backend\FaqController::class, 'faqDatatable'])->name('faq-datatable');

        Route::get('service-center-detail', [\App\Http\Controllers\Backend\ServiceCenterDetailController::class, 'index'])->name('service-center-detail');
        Route::post('service-center-detail-update', [\App\Http\Controllers\Backend\ServiceCenterDetailController::class, 'update'])->name('service-center-detail-update');
        Route::post('service-center-delete', [App\Http\Controllers\Backend\ServiceCenterDetailController::class, 'serviceCenterDelete'])->name('service-center-delete');

        Route::get('enquiry',[App\Http\Controllers\Backend\EnquiryController::class, 'index'])->name('enquiry')->middleware('XSS');
        Route::post('enquiry-datatable', [App\Http\Controllers\Backend\EnquiryController::class, 'enquiryDatatable'])->name('enquiry-datatable');
        Route::get('enquiry-delete/{id}', [App\Http\Controllers\Backend\EnquiryController::class, 'destroy'])->name('enquiry-delete');

        Route::get('user',[App\Http\Controllers\Backend\UserController::class, 'index'])->name('user')->middleware('XSS');
        Route::post('user-datatable', [App\Http\Controllers\Backend\UserController::class, 'userDatatable'])->name('user-datatable');
        Route::get('user-delete/{id}', [App\Http\Controllers\Backend\UserController::class, 'destroy'])->name('user-delete');
        Route::get('user-detail/{id}', [\App\Http\Controllers\Backend\UserController::class, 'detail'])->name('user-detail');
        Route::get('user-address/{user_id?}', [App\Http\Controllers\Backend\UserController::class, 'address'])->name('user-address');
        Route::post('user-address-datatable', [App\Http\Controllers\Backend\UserController::class, 'userAddressDatatable'])->name('user-address-datatable');
        Route::get('user-address-delete/{id}', [App\Http\Controllers\Backend\UserController::class, 'addressDestroy'])->name('user-address-delete');

        Route::get('order',[App\Http\Controllers\Backend\OrderController::class, 'index'])->name('order')->middleware('XSS');
        Route::post('order-datatable', [App\Http\Controllers\Backend\OrderController::class, 'orderDatatable'])->name('order-datatable');
        Route::get('order-delete/{id}', [App\Http\Controllers\Backend\OrderController::class, 'destroy'])->name('order-delete');
        Route::get('order-detail/{id?}', [App\Http\Controllers\Backend\OrderController::class, 'detail'])->name('order-detail');
        Route::post('order-detail-datatable', [App\Http\Controllers\Backend\OrderController::class, 'orderDetailDatatable'])->name('order-detail-datatable');
        Route::get('order-detail-delete/{id}', [App\Http\Controllers\Backend\OrderController::class, 'detailDestroy'])->name('order-detail-delete');
        Route::post('order-complete', [App\Http\Controllers\Backend\OrderController::class, 'orderComplete'])->name('order-complete')->middleware('XSS');
    });
});
Route::group(['as' => 'front_', 'middleware' => 'XSS'], function() {
    Route::get('/', [\App\Http\Controllers\Front\HomeController::class, 'index'])->name('/');
    Route::post('appointment-store',[App\Http\Controllers\Front\HomeController::class, 'appointmentStore'])->name('appointment-store');
    Route::get('reviews', [App\Http\Controllers\Front\HomeController::class, 'getReviews'])->name('reviews');

    Route::get('register', [\App\Http\Controllers\Front\Auth\RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [\App\Http\Controllers\Front\Auth\RegisterController::class, 'register'])->name('register');
    Route::get('login', [\App\Http\Controllers\Front\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [\App\Http\Controllers\Front\Auth\LoginController::class, 'login'])->name('login');
    Route::get('logout', [\App\Http\Controllers\Front\Auth\LoginController::class, 'logout'])->name('logout');
    Route::get('forgot-password', [\App\Http\Controllers\Front\Auth\LoginController::class, 'showForgetForm'])->name('forgot-password');
    Route::post('forgot-password', [\App\Http\Controllers\Front\Auth\LoginController::class, 'sendForgetLink'])->name('forgot-password');
    Route::get('reset-password/{token?}', [\App\Http\Controllers\Front\Auth\LoginController::class, 'showResetPasswordForm'])->name('reset-password');
    Route::post('set-new-password', [\App\Http\Controllers\Front\Auth\LoginController::class, 'resetPassword'])->name('set-new-password');

    Route::get('shopping', [App\Http\Controllers\Front\ProductController::class, 'shopping'])->name('shopping');
    Route::post('search-shopping-ajax', [App\Http\Controllers\Front\ProductController::class, 'searchAjax'])->name('search-shopping-ajax');
    /** product-detail route start **/
    $products = Cache::remember('products', 10, function() { 
                return DB::table('products')->select('id', 'slug')
                ->get();
            });
            
    if(!empty($products)) {
        foreach ($products as $product) {
            Route::get('shopping/'.$product->slug, [App\Http\Controllers\Front\ProductController::class, 'detail'])->name('shopping/'.$product->slug)->middleware('XSS');
        }
    }
    /** product detail route end **/

    Route::post('search-brand', [\App\Http\Controllers\Front\SearchController::class, 'brands'])->name('search-brand');
    Route::post('search-model-from-brand-modal', [\App\Http\Controllers\Front\SearchController::class, 'modelFromBrandModal'])->name('model-from-brand-modal');
    Route::post('search-fuel-from-model', [\App\Http\Controllers\Front\SearchController::class, 'fuelFromModel'])->name('search-fuel-from-model');
    Route::post('appoitment-number-modal', [\App\Http\Controllers\Front\SearchController::class, 'appoitmentNumberModel'])->name('appoitment-number-modal');
    Route::get('search', [\App\Http\Controllers\Front\SearchController::class, 'search'])->name('search');

    /** product-detail route start **/
    $scategories = Cache::remember('service_categories', 10, function() { 
                return DB::table('service_categories')->select('id', 'slug')
                ->get();
            });
            
    if(!empty($scategories)) {
        foreach ($scategories as $scategory) {
            Route::get($scategory->slug.'/{brand?}/{model?}/{fuel?}', [App\Http\Controllers\Front\ServiceController::class, 'detail'])->name($scategory->slug.'/{brand_model?}/{fuel?}')->middleware('XSS');
        }
    }
    /** product detail route end **/

    Route::post('add-to-cart', [App\Http\Controllers\Front\CartController::class, 'add'])->name('add-to-cart');
    Route::post('cart-item-count', [App\Http\Controllers\Front\CartController::class, 'itemCount'])->name('cart-item-count');
    Route::post('update-cart', [App\Http\Controllers\Front\CartController::class, 'update'])->name('update-cart');
    Route::post('remove-from-cart', [App\Http\Controllers\Front\CartController::class, 'remove'])->name('remove-from-cart');
    Route::get('checkout', [App\Http\Controllers\Front\CheckoutController::class, 'index'])->name('checkout');
    Route::post('cart-ajax-html', [App\Http\Controllers\Front\CheckoutController::class, 'cartAjaxHtml'])->name('cart-ajax-html');
    Route::post('create-order', [\App\Http\Controllers\Front\CheckoutController::class, 'createOrder'])->name('create-order');
    Route::post('get-available-slot', [\App\Http\Controllers\Front\CheckoutController::class, 'getAvailableSlot'])->name('get-available-slot');
    Route::get('thank-you', [\App\Http\Controllers\Front\CheckoutController::class, 'thankYou'])->name('thank-you');

    Route::post('send-otp', [\App\Http\Controllers\Front\OtpController::class, 'send'])->name('send-otp');
    Route::post('verify-otp', [\App\Http\Controllers\Front\OtpController::class, 'verify'])->name('verify-otp');
    Route::post('resend-otp', [\App\Http\Controllers\Front\OtpController::class, 'resend'])->name('resend-otp');

    Route::get('our-services', [App\Http\Controllers\Front\ServiceController::class, 'services'])->name('our-services');
    Route::get('contact-us', [App\Http\Controllers\Front\ContactController::class, 'index'])->name('contact-us');
    Route::get('service-center', [App\Http\Controllers\Front\ServiceCenterConroller::class, 'index'])->name('service-center');
    Route::get('faqs', [App\Http\Controllers\Front\FaqController::class, 'index'])->name('faqs');
    Route::get('about-us', [App\Http\Controllers\Front\CmsPagesController::class, 'aboutUs'])->name('about-us');

    /** cms pages route start **/
    $pages = Cache::remember('pages', 10, function() { 
                return DB::table('pages')
                ->get();
            });

    if(!empty($pages)) {
        foreach ($pages as $page) {
            Route::get($page->slug, [App\Http\Controllers\Front\CmsPagesController::class, 'index'])->name($page->slug)->middleware('XSS');
        }
    }
    /** cms pages route end **/
    
    /**compny  cms pages route start **/
    $compnycms = Cache::remember('compny_cms_page', 10, function() { 
        return DB::table('compny_cms_page')
        ->get();
            });

        if(!empty($compnycms)) {
        foreach ($compnycms as $page) {
            Route::get($page->slug, [App\Http\Controllers\Front\CmsPagesController::class, 'cmsPage'])->name($page->slug);
        }
    }
    Route::post('compny-store',[App\Http\Controllers\Front\CmsPagesController::class, 'compnyStore'])->name('compny-store');
    // Route::get('company-cms-page', [App\Http\Controllers\Front\CmsPagesController::class, 'cmsPage'])->name('company-cms-page');
    /**compny  cms pages route start **/

    Route::group(['middleware' => 'auth:user'], function () {
        Route::get('my-profile', [\App\Http\Controllers\Front\UserController::class, 'myprofile'])->name('my-profile')->middleware('XSS');
        Route::post('my-profile-update', [\App\Http\Controllers\Front\UserController::class, 'myprofileUpdate'])->name('my-profile-update')->middleware('XSS');
        Route::post('address-delete', [\App\Http\Controllers\Front\UserController::class, 'addressDelete'])->name('address-delete')->middleware('XSS');
        Route::get('my-orders', [App\Http\Controllers\Front\OrderController::class, 'list'])->name('my-orders')->middleware('XSS');
        Route::get('cancel-order/{id?}', [App\Http\Controllers\Front\OrderController::class, 'cancel'])->name('cancel-order');
        Route::post('change-service-slot', [App\Http\Controllers\Front\OrderController::class, 'changeSlot'])->name('change-service-slot');
    });
});
