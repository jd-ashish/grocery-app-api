<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MediaController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' =>'media', 'middleware' => ['auth']], function(){
    Route::post('/upload', [MediaController::class, 'upload'])->name('media.upload');
    Route::post('/library', [MediaController::class, 'getMediaLibrary'])->name('media.library');
    Route::post('/delete', [MediaController::class, 'delete'])->name('media.delete');
    Route::post('/update/alt', [MediaController::class, 'update_alt'])->name('media.update.alt');
});

// Error page
Route::get('/404', function(){
    return view('error.404');
})->name('404');
