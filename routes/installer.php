<?php

use App\Http\Controllers\InstallController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MediaController;
use Illuminate\Http\Request;

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
Route::get('/install/app', [InstallController::class, 'install'])->name('install.app');
Route::post('/install/validate', [InstallController::class, 'CodeValidate'])->name('install.validate');
Route::post('/install/start', [InstallController::class, 'InstallStart'])->name('install.start');
Route::post('/install/db/check', [InstallController::class, 'DbCheck'])->name('install.db.check');
Route::post('/install/db/create/account', [InstallController::class, 'CreateAccount'])->name('install.create.account');


//evtocode
//lrgmwwCzBsDfo4jWdC9cOMoTpEgMiRbs
