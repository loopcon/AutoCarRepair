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

        Route::get('email-templates', [\App\Http\Controllers\Backend\EmailTemplatesController::class, 'index'])->name('email-templates');
        Route::post('email-templates', [\App\Http\Controllers\Backend\EmailTemplatesController::class, 'update'])->name('email-templates');

        Route::get('pages',[App\Http\Controllers\Backend\PageController::class, 'index'])->name('pages');
        Route::get('page-create',[App\Http\Controllers\Backend\PageController::class, 'create'])->name('page-create');
        Route::post('page-store',[App\Http\Controllers\Backend\PageController::class, 'store'])->name('page-store');
        Route::get('page-edit/{id}',[App\Http\Controllers\Backend\PageController::class, 'edit'])->name('page-edit');
        Route::post('page-update/{id}',[App\Http\Controllers\Backend\PageController::class, 'update'])->name('page-update');
        Route::get('page-delete/{id}', [App\Http\Controllers\Backend\PageController::class, 'destroy'])->name('page-delete');
        Route::post('page-datatable', [App\Http\Controllers\Backend\PageController::class, 'pagesDatatable'])->name('page-datatable');

        Route::get('car-brand',[App\Http\Controllers\Backend\CarBrandController::class, 'index'])->name('car-brand')->middleware('XSS');
        Route::post('ajax-edit-brand-html',[App\Http\Controllers\Backend\CarBrandController::class, 'ajaxEditCarBrandHtml'])->name('ajax-edit-brand-html')->middleware('XSS');
        Route::post('car-brand-datatable', [App\Http\Controllers\Backend\CarBrandController::class, 'carbrandsDatatable'])->name('car-brand-datatable')->middleware('XSS');
        Route::post('car-brand-store',[App\Http\Controllers\Backend\CarBrandController::class, 'store'])->name('car-brand-store')->middleware('XSS');
        Route::post('car-brand-update/{id}',[App\Http\Controllers\Backend\CarBrandController::class, 'update'])->name('car-brand-update')->middleware('XSS');
        Route::get('car-brand-delete/{id}', [App\Http\Controllers\Backend\CarBrandController::class, 'destroy'])->name('car-brand-delete')->middleware('XSS');
        Route::post('change-car-brand-status', [App\Http\Controllers\Backend\CarBrandController::class, 'changeCarBrandStatus'])->name('change-car-brand-status')->middleware('XSS');

        Route::get('car-model',[App\Http\Controllers\Backend\CarModelController::class, 'index'])->name('car-model')->middleware('XSS');
        Route::post('ajax-edit-model-html',[App\Http\Controllers\Backend\CarModelController::class, 'ajaxEditModelHtml'])->name('ajax-edit-model-html')->middleware('XSS');
        Route::post('car-model-datatable', [App\Http\Controllers\Backend\CarModelController::class, 'carmodelsDatatable'])->name('car-model-datatable')->middleware('XSS');
        Route::post('car-model-store',[App\Http\Controllers\Backend\CarModelController::class, 'store'])->name('car-model-store')->middleware('XSS');
        Route::post('car-model-update/{id}',[App\Http\Controllers\Backend\CarModelController::class, 'update'])->name('car-model-update')->middleware('XSS');
        Route::get('car-model-delete/{id}', [App\Http\Controllers\Backend\CarModelController::class, 'destroy'])->name('car-model-delete')->middleware('XSS');
        Route::post('change-car-model-status', [App\Http\Controllers\Backend\CarModelController::class, 'changeCarModelStatus'])->name('change-car-model-status')->middleware('XSS');

        Route::get('fuel-type',[App\Http\Controllers\Backend\FuelTypeController::class, 'index'])->name('fuel-type')->middleware('XSS');
        Route::post('ajax-edit-fuel-html',[App\Http\Controllers\Backend\FuelTypeController::class, 'ajaxEditFuelHtml'])->name('ajax-edit-fuel-html')->middleware('XSS');
        Route::post('fuel-type-datatable', [App\Http\Controllers\Backend\FuelTypeController::class, 'fueltypeDatatable'])->name('fuel-type-datatable')->middleware('XSS');
        Route::post('fuel-type-store',[App\Http\Controllers\Backend\FuelTypeController::class, 'store'])->name('fuel-type-store')->middleware('XSS');
        Route::post('fuel-type-update/{id}',[App\Http\Controllers\Backend\FuelTypeController::class, 'update'])->name('fuel-type-update')->middleware('XSS');
        Route::get('fuel-type-delete/{id}', [App\Http\Controllers\Backend\FuelTypeController::class, 'destroy'])->name('fuel-type-delete')->middleware('XSS');
        Route::post('change-fuel-type-status', [App\Http\Controllers\Backend\FuelTypeController::class, 'changeFuelTypeStatus'])->name('change-fuel-type-status')->middleware('XSS');

        Route::get('service-category',[App\Http\Controllers\Backend\ServiceController::class, 'serviceCategoryList'])->name('service-category')->middleware('XSS');
        Route::post('ajax-edit-service-category-html',[App\Http\Controllers\Backend\ServiceController::class, 'ajaxEditServiceCategoryHtml'])->name('ajax-edit-service-category-html')->middleware('XSS');
        Route::post('service-category-datatable', [App\Http\Controllers\Backend\ServiceController::class, 'serviceCategoryDatatable'])->name('service-category-datatable')->middleware('XSS');
        Route::post('service-category-store',[App\Http\Controllers\Backend\ServiceController::class, 'serviceCategoryStore'])->name('service-category-store')->middleware('XSS');
        Route::post('service-category-update/{id}',[App\Http\Controllers\Backend\ServiceController::class, 'serviceCategoryUpdate'])->name('service-category-update')->middleware('XSS');
        Route::get('service-category-delete/{id}', [App\Http\Controllers\Backend\ServiceController::class, 'serviceCategoryDestroy'])->name('service-category-delete')->middleware('XSS');
        Route::post('change-service-category-status', [App\Http\Controllers\Backend\ServiceController::class, 'changeServiceCategoryStatus'])->name('change-service-category-status')->middleware('XSS');

        Route::get('products',[App\Http\Controllers\Backend\ProductController::class, 'index'])->name('products');
        Route::get('product-create',[App\Http\Controllers\Backend\ProductController::class, 'create'])->name('product-create');
        Route::post('product-store',[App\Http\Controllers\Backend\ProductController::class, 'store'])->name('product-store');
        Route::get('product-edit/{id}',[App\Http\Controllers\Backend\ProductController::class, 'edit'])->name('product-edit');
        Route::post('product-update/{id}',[App\Http\Controllers\Backend\ProductController::class, 'update'])->name('product-update');
        Route::get('product-delete/{id}', [App\Http\Controllers\Backend\ProductController::class, 'destroy'])->name('product-delete');
        Route::post('product-datatable', [App\Http\Controllers\Backend\ProductController::class, 'productsDatatable'])->name('product-datatable');
        Route::post('change-product-status', [App\Http\Controllers\Backend\ProductController::class, 'changeProductStatus'])->name('change-product-status')->middleware('XSS');

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

        Route::get('enquiry',[App\Http\Controllers\Backend\EnquiryController::class, 'index'])->name('enquiry')->middleware('XSS');
        Route::post('enquiry-datatable', [App\Http\Controllers\Backend\EnquiryController::class, 'enquiryDatatable'])->name('enquiry-datatable');
        Route::get('enquiry-delete/{id}', [App\Http\Controllers\Backend\EnquiryController::class, 'destroy'])->name('enquiry-delete');
    });
});
Route::group(['as' => 'front_', 'middleware' => 'XSS'], function() {
    Route::get('/', [\App\Http\Controllers\Front\HomeController::class, 'index'])->name('/');
    Route::get('register', [\App\Http\Controllers\Front\Auth\RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [\App\Http\Controllers\Front\Auth\RegisterController::class, 'register'])->name('register');
    Route::get('login', [\App\Http\Controllers\Front\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [\App\Http\Controllers\Front\Auth\LoginController::class, 'login'])->name('login');
    Route::get('logout', [\App\Http\Controllers\Front\Auth\LoginController::class, 'logout'])->name('logout');
    Route::get('forgot-password', [\App\Http\Controllers\Front\Auth\LoginController::class, 'showForgetForm'])->name('forgot-password');
    Route::post('forgot-password', [\App\Http\Controllers\Front\Auth\LoginController::class, 'sendForgetLink'])->name('forgot-password');
    Route::get('reset-password/{token?}', [\App\Http\Controllers\Front\Auth\LoginController::class, 'showResetPasswordForm'])->name('reset-password');
    Route::post('set-new-password', [\App\Http\Controllers\Front\Auth\LoginController::class, 'resetPassword'])->name('set-new-password');

});
