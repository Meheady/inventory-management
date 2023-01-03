<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\supplier\SupplierController;
use App\Http\Controllers\customer\CustomerController;
use App\Http\Controllers\unit\UnitController;
use App\Http\Controllers\category\CategoryController;
use App\Http\Controllers\product\ProductController;
use App\Http\Controllers\purchase\PurchaseController;
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
            Route::get('/supplier/delete/{id}','supplierDelete');
        });
    });
    Route::controller(CustomerController::class)->group(function (){
        Route::prefix('admin')->group(function (){
            Route::get('/customer/all','customerAll')->name('customer.all');
            Route::post('/customer/store','customerStore')->name('customer.store');
            Route::post('/customer/update','customerUpdate')->name('customer.update');
            Route::get('/customer/edit/{id}','customerEdit');
            Route::get('/customer/delete/{id}','customerDelete');
        });
    });
    Route::controller(UnitController::class)->group(function (){
        Route::prefix('admin')->group(function (){
            Route::get('/unit/all','unitAll')->name('unit.all');
            Route::post('/unit/store','unitStore')->name('unit.store');
            Route::post('/unit/update','unitUpdate')->name('unit.update');
            Route::get('/unit/edit/{id}','unitEdit');
            Route::get('/unit/delete/{id}','unitDelete');
        });
    });
    Route::controller(CategoryController::class)->group(function (){
        Route::prefix('admin')->group(function (){
            Route::get('/category/all','categoryAll')->name('category.all');
            Route::post('/category/store','categoryStore')->name('category.store');
            Route::post('/category/update/','categoryUpdate')->name('category.update');
            Route::get('/category/edit/{id}','categoryEdit');
            Route::get('/category/delete/{id}','categoryDelete');
        });
    });
    Route::controller(ProductController::class)->group(function (){
        Route::prefix('admin')->group(function (){
            Route::get('/product/all','productAll')->name('product.all');
            Route::get('/product/add','productAdd');
            Route::post('/product/store','productStore')->name('product.store');
            Route::post('/product/update/','productUpdate')->name('product.update');
            Route::get('/product/edit/{id}','productEdit');
            Route::get('/product/delete/{id}','productDelete');
        });
    });
    Route::controller(PurchaseController::class)->group(function (){
        Route::prefix('admin')->group(function (){
            Route::get('/purchase/all','purchaseAll')->name('purchase.all');
            Route::get('/purchase/add','purchaseNew')->name('purchase.add');
            Route::post('/product/store','productStore')->name('product.store');
            Route::post('/product/update/','productUpdate')->name('product.update');
            Route::get('/product/edit/{id}','productEdit');
            Route::get('/product/delete/{id}','productDelete');
        });
    });
});


require __DIR__.'/auth.php';
