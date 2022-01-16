<?php

use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartsController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ImageSliderController;
use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1/auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('login/verify', [AuthController::class, 'verify_login']);

    // Route::post('signup', 'Api\AuthController@signup');
    // Route::post('otp', 'Api\AuthController@sendOtp');
    // Route::post('verifyAccount', 'Api\AuthController@verifyAccount');
    // Route::post('social-login', 'Api\AuthController@socialLogin');
    // Route::get('forgot/otp_data/{otp_data}', 'Api\AuthController@OtpData');
    // Route::get('forgot/{otp_data}', 'Api\AuthController@OtpData');
    // Route::post('password/create', 'Api\PasswordResetController@create_new');
    // Route::middleware('auth:api')->group(function () {
    //     Route::get('logout', 'Api\AuthController@logout');
    //     Route::get('user', 'Api\AuthController@user');
    // });


});
Route::group(['prefix' =>'v1'], function(){
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('login/save_address', [AuthController::class, 'save_address']);
        // Route::get('user', 'Api\AuthController@user');

        Route::group(['prefix' =>'carts'], function(){
            Route::middleware('auth:sanctum')->group(function () {
                Route::post('add', [CartsController::class, 'store']);
                Route::post('get', [CartsController::class, 'index']);
                Route::post('update', [CartsController::class, 'changeQuantity']);
                Route::post('destroy/{id}', [CartsController::class, 'destroy']);
                // Route::get('user', 'Api\AuthController@user');
            });
        });
        Route::group(['prefix' =>'order/'], function(){
            Route::post('store', [OrderController::class, 'store']);
            Route::get('history/{status}', [OrderController::class,'orders_history']);
            Route::get('track/{id}', [OrderController::class,'orders_track']);
            Route::get('cancel/{id}', [OrderController::class,'orders_cancel']);
        });
        Route::group(['prefix' =>'user/'], function(){
            Route::post('get-address', [UserController::class, 'get_address']);
            Route::post('update-profile-pic', [UserController::class, 'update_profile_pic']);
            Route::post('get', [UserController::class, 'get_user_by_id']);
            Route::post('update-profile', [UserController::class, 'update_profile']);
            Route::get('deleteUserAddress/{id}', [UserController::class, 'deleteUserAddress']);
        });
        Route::group(['prefix' =>'notification/'], function(){
            Route::post('get', [NotificationController::class, 'get_api_notification']);
            Route::post('viewed', [NotificationController::class, 'viewed']);
        });
    });

    Route::group(['prefix' =>'products/'], function(){
        Route::get('products', [ProductController::class, 'admin']);
        Route::get('show/{id}', [ProductController::class, 'show']);
        Route::get('by/category/{id}', [ProductController::class, 'category'])->name('api.products.category');
        Route::get('bestSelling', [ProductController::class, 'bestSelling']);
        Route::post('variant/price', [ProductController::class, 'variantPrice']);
        Route::get('execlusive/offer', [ProductController::class, 'execlusive_offer']);

        // filter
        Route::get('filter/{id}/{price}/{date}', [ProductController::class, 'filter']);

        Route::get('search', [ProductController::class,'search']);
    });
    Route::group(['prefix' =>'offer/'], function(){
        Route::get('exclusive', [OfferController::class, 'get']);
        Route::get('exclusive-by-id/{id}', [OfferController::class, 'getById']);

    });

    Route::group(['prefix' =>'setting/'], function(){
        Route::get('image/slider', [ImageSliderController::class, 'index']);
        Route::get('get', [SettingController::class, 'get']);
    });
    Route::get('categories/{search}', [CategoryController::class, 'index']);

    // Route::get('products/admin', [ProductController::class, 'admin']);
    // Route::get('products/by/category/{id}', [ProductController::class, 'category'])->name('api.products.category');
    // Route::get('products/bestSelling', [ProductController::class, 'bestSelling']);
    // Route::get('categories/{search}', [CategoryController::class, 'index']);

});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::fallback(function() {
    return response()->json([
        'data' => [],
        'success' => false,
        'status' => 404,
        'message' => 'Invalid Route'
    ]);
});
