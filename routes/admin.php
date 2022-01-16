<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\RefundController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\MAIL\EmailController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\SMS\FastTwoSMSController;
use App\Http\Controllers\Admin\SmsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/admin/login', [HomeController::class,'login'])->name('admin.login');
Route::get('/login', [HomeController::class,'login'])->name('admin.login');
Route::get('/login', [HomeController::class,'login'])->name('login');
Route::post('/logout', [LoginController::class,'logout'])->name('logout');
Route::post('/login/admin', [HomeController::class, 'LoginAdmin'])->name('login.admin');

Route::post('/admin/login/by/phone', [HomeController::class,'PhoneLogin'])->name('admin.login.phone');
Route::post('/admin/login/by/phone/verify', [HomeController::class,'PhoneLoginVerify'])->name('admin.login.phone.verify');

Route::group(['prefix' =>'admin', 'middleware' => ['auth', 'admin']], function(){
    Route::get('/dashboard', [Dashboard::class, 'index'])->name('admin.dashboard');
    Route::get('/profile', [Dashboard::class, 'profile'])->name('admin.profile');
    Route::post('update/profile', [Dashboard::class, 'updateProfile'])->name('admin.profile.profile');
    Route::post('search', [Dashboard::class, 'search'])->name('dashboard.search');

    Route::group(['prefix' =>'chat-graph', 'middleware' => ['auth', 'admin']], function(){
        Route::post('year-wise',[Dashboard::class, 'yearWise'])->name('dashboard.yearwise');
    });
    Route::group(['prefix' =>'conf', 'middleware' => ['auth', 'admin']], function(){
        Route::get('sms',[SmsController::class, 'index'])->name('conf.sms');
        Route::get('email',[EmailController::class, 'index'])->name('conf.email');
    });
    Route::group(['prefix' =>'fast2SMS', 'middleware' => ['auth', 'admin']], function(){
        Route::get('check-details',[FastTwoSMSController::class, 'check'])->name('check.f2s');
        Route::post('save-saveF2s-config',[FastTwoSMSController::class, 'saveF2s'])->name('save.saveF2s-config');
        Route::post('is-f2s-install',[FastTwoSMSController::class, 'isF2sInstall'])->name('is.f2s.install');
    });
    Route::group(['prefix' =>'email', 'middleware' => ['auth', 'admin']], function(){
        Route::post('save-smtp-details',[EmailController::class, 'saveSmtp'])->name('save.saveSmtpEmail-config');
        Route::post('save-smtp-test-email',[EmailController::class, 'sendTestSmtpEmail'])->name('send.test.smtpEmail');
    });
    Route::group(['prefix' =>'cron-scheduler', 'middleware' => ['auth', 'admin']], function(){
        Route::get('scheduler',[SettingController::class, 'Cron'])->name('conf.cron');
    });
    //UserController
    Route::group(['prefix' =>'user', 'middleware' => ['auth', 'admin']], function(){
        Route::get('user-list',[UserController::class, 'user_list'])->name('dashboard.userlist');
        Route::get('details/{id}',[UserController::class, 'details'])->name('dashboard.user.details');
    });
    Route::group(['prefix' =>'products', 'middleware' => ['auth', 'admin']], function(){
        Route::get('category',[CategoryController::class, 'index'])->name('product.category');
        Route::get('category/create',[CategoryController::class, 'create'])->name('product.category.create');
        Route::post('category/store',[CategoryController::class, 'upload_category'])->name('product.category.store');
        Route::post('category/delete/{id}',[CategoryController::class, 'delete'])->name('product.category.delete');
    });
    Route::group(['prefix' =>'products', 'middleware' => ['auth', 'admin']], function(){
        Route::get('index',[ProductController::class, 'index'])->name('product.index');
        Route::get('create',[ProductController::class, 'create'])->name('product.create');
        Route::post('store',[ProductController::class, 'store'])->name('product.store');
        Route::post('sku_combination',[ProductController::class, 'sku_combination'])->name('products.sku_combination');
        Route::post('sku_combination_edit',[ProductController::class, 'sku_combination_edit'])->name('products.sku_combination_edit');
        Route::get('edit/{id}',[ProductController::class, 'edit'])->name('product.product.edit');
        Route::post('update/{id}',[ProductController::class, 'update'])->name('product.update');
        Route::get('duplicate/{id}',[ProductController::class, 'duplicate'])->name('product.duplicate');
        Route::post('category/delete/{id}',[CategoryController::class, 'delete'])->name('product.category.delete');
        Route::post('execlusive-offer',[ProductController::class, 'execlusive_offer'])->name('product.execlusive.offer');
    });
    Route::group(['prefix' =>'settings', 'middleware' => ['auth', 'admin']], function(){
        Route::get('image-slider',[SettingController::class, 'ImageSliderIndex'])->name('image.slider');
        Route::get('upload-slider-image',[SettingController::class, 'ImageSliderUpload'])->name('upload.slider-image');
        Route::post('upload-slider-image-db',[SettingController::class, 'ImageSliderUploadDb'])->name('upload.slider.image.db');
        Route::get('edit-slider-image/{id}',[SettingController::class, 'ImageSliderEdit'])->name('edit.slider.image');
        Route::post('update-slider-image',[SettingController::class, 'ImageSliderUpdate'])->name('update.slider.image');
        Route::post('delete-slider-image/{id}',[SettingController::class, 'ImageSliderDelete'])->name('delete.slider.image');
        Route::get('general-setting',[SettingController::class, 'GeneralSetting'])->name('general.setting');
        Route::post('general-setting-store',[SettingController::class, 'GeneralSettingStore'])->name('general.setting.store');
        Route::get('global-setting',[SettingController::class, 'GlobalSetting'])->name('global.setting');
        Route::post('global-setting-store',[SettingController::class, 'GlobalSettingStore'])->name('global.setting.store');
        Route::post('storage-driver-check',[SettingController::class, 'StorageDriverCheck'])->name('setting.storage.driver.check');
        Route::post('save-cloudinary-config',[SettingController::class, 'StorageDriverSaveCloudinaryConfig'])->name('save.cloudinary-config');
        Route::get('Currency',[CurrencyController::class, 'Currency'])->name('currency.index');

        Route::post('/currency/update',[CurrencyController::class, 'updateCurrency'])->name('currency.update');
        Route::post('/your-currency/update',[CurrencyController::class, 'updateYourCurrency'])->name('your_currency.update');
        Route::get('/currency/create',[CurrencyController::class, 'create'])->name('currency.create');
        Route::post('/currency/store',[CurrencyController::class, 'store'])->name('currency.store');
        Route::post('/currency/currency_edit',[CurrencyController::class, 'edit'])->name('currency.edit');
        Route::post('/currency/update_status',[CurrencyController::class, 'update_status'])->name('currency.update_status');

    });

    Route::group(['prefix' =>'order', 'middleware' => ['auth', 'admin']], function(){
        Route::get('order-list',[OrderController::class, 'admin_orders'])->name('order.list');
        Route::get('order-details/{id}',[OrderController::class, 'sales_show'])->name('order.details');
        Route::post('update_delivery_status',[OrderController::class, 'update_delivery_status'])->name('order.update_delivery_status');
        Route::post('update_payment_status',[OrderController::class, 'update_payment_status'])->name('orders.update_payment_status');
        Route::get('customer/invoice/download/{id}',[InvoiceController::class, 'customer_invoice_download'])->name('customer.invoice.download');
    });
    Route::group(['prefix' =>'offer', 'middleware' => ['auth', 'admin']], function(){
        Route::get('exclusive',[OfferController::class, 'index'])->name('offer.exclusive');
        Route::get('exclusive-create',[OfferController::class, 'create'])->name('offer.exclusive.create');
        Route::post('exclusive-store',[OfferController::class, 'store'])->name('offer.exclusive.store');
        Route::post('exclusive-store-status',[OfferController::class, 'status'])->name('offer.exclusive.status');
        Route::post('exclusive-delete/{id}',[OfferController::class, 'delete'])->name('offer.exclusive.delete');
        Route::get('exclusive-edit/{id}',[OfferController::class, 'edit'])->name('offer.exclusive.edit');
        Route::post('exclusive-update/{id}',[OfferController::class, 'update'])->name('offer.exclusive.update');
    });
    Route::group(['prefix' =>'refund', 'middleware' => ['auth', 'admin']], function(){
        Route::get('order-cancel-refund',[RefundController::class, 'order_cancel_refund'])->name('order.cancel.refund');
        Route::post('order-refund-payment-details',[RefundController::class, 'order_refund_payment_details'])->name('order.refund.payment.details');
    });
    Route::group(['prefix' =>'rzp', 'middleware' => ['auth', 'admin']], function(){
        Route::post('normal-refund',[RefundController::class, 'normal_refund'])->name('normal.refund');
        Route::post('cashfree-refund',[RefundController::class, 'cashfree_refund'])->name('cashfree.refund');
    });
    Route::group(['prefix' =>'policy', 'middleware' => ['auth', 'admin']], function(){
        Route::get('privacy-policy',[SettingController::class, 'privacy_policy_index'])->name('privacy.policy');
        Route::post('privacy-policy-save',[SettingController::class, 'privacy_policy'])->name('privacy.policy.save');
        Route::get('terms-conditions',[SettingController::class, 'TermsConditions'])->name('Terms.Conditions');
        Route::get('return-policy',[SettingController::class, 'returnPolicy'])->name('return.policy');
        Route::get('contact-us',[SettingController::class, 'contactUs'])->name('contact.us');
        Route::get('about-us',[SettingController::class, 'aboutUs'])->name('about.us');
    });
});


Route::fallback(function() {
    return response()->json([
        'data' => [],
        'success' => false,
        'status' => 404,
        'message' => 'Invalid Route'
    ]);
});
