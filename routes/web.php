<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\supplier\SupplierController;
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


//admin all route
Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/logout',[AdminController::class,'destroy'])->name('admin.logout');
    Route::get('/admin/profile',[AdminController::class,'profile'])->name('admin.profile');
    Route::get('/admin/edit-profile',[AdminController::class,'editProfile'])->name('edit.profile');
    Route::post('/admin/store-profile',[AdminController::class,'storeProfile'])->name('store.profile');
    Route::get('/admin/change-password',[AdminController::class,'changePassword'])->name('change.password');
    Route::post('/admin/update-password',[AdminController::class,'updatePassword'])->name('update.password');
    //supplier route
    Route::controller(SupplierController::class)->group(function (){
        Route::prefix('admin')->group(function (){
            Route::get('/supplier/all','supplierAll')->name('supplier.all');
            Route::post('/supplier/store','supplierStore')->name('supplier.store');
            Route::post('/supplier/update','supplierUpdate')->name('supplier.update');
            Route::get('/supplier/edit/{id}','supplierEdit');
        });
    });
});


require __DIR__.'/auth.php';
