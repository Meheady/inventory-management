<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\supplier\SupplierController;
use App\Http\Controllers\customer\CustomerController;
use App\Http\Controllers\unit\UnitController;
use App\Http\Controllers\category\CategoryController;
use App\Http\Controllers\product\ProductController;
use App\Http\Controllers\purchase\PurchaseController;
use App\Http\Controllers\ajax\AjaxController;
use App\Http\Controllers\invoice\InvoiceController;
use App\Http\Controllers\stock\StockController;
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
    return view('auth.login');
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
            Route::get('/customer/credit','customerCredit')->name('customer.credit');
            Route::get('/customer/credit/pdf','customerCreditPdf')->name('customer.credit.pdf');
            Route::get('/customer/invoice/edit/{invoice_id}','customerInvoiceEdit')->name('customer.invoice.edit');
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
            Route::post('/purchase/store','purchaseStore')->name('purchase.store');
            Route::get('/purchase/approve/{id}','purchaseApprove');
            Route::get('/purchase/pending','purchasePending')->name('purchase.pending');
            Route::get('/purchase/delete/{id}','purchaseDelete');
            Route::get('/purchase/report/daily','purchaseReportDaily')->name('daily.purchase.report');
            Route::get('/purchase/report/daily/pdf','purchaseReportDailyPdf')->name('daily.purchase.report.pdf');
        });
    });
    Route::controller(AjaxController::class)->group(function (){
        Route::prefix('admin')->group(function (){
            Route::get('/get-category','getCategory')->name('get-category');
            Route::get('/get-product','getproduct')->name('get-product');
            Route::get('/get-product-stock','getProductStock')->name('get-product-stock');
        });
    });
    Route::controller(InvoiceController::class)->group(function (){
        Route::prefix('admin')->group(function (){
            Route::get('/invoice/all','InvoiceAll')->name('invoice.all');
            Route::get('/invoice/add','InvoiceAdd')->name('invoice.add');
            Route::post('/invoice/store','InvoiceStore')->name('invoice.store');
            Route::get('/invoice/pending','InvoicePending')->name('invoice.pending');
            Route::get('/invoice/delete/{id}','InvoiceDelete');
            Route::get('/invoice/approve/{id}','InvoiceApprove')->name('invoice.approve');
            Route::post('/invoice/approve/store/{id}','InvoiceApproveStore')->name('invoice.approve.store');
            Route::get('/invoice/print','InvoicePrint')->name('invoice.print');
            Route::get('/print/invoice/{id}','printInvoice')->name('print.invoice');
            Route::get('/invoice/report/daily','dailyInvoiceReport')->name('daily.invoice.report');
            Route::get('/invoice/report/get/pdf','dailyInvoiceReportGet')->name('daily.invoice.report.get');
            Route::get('/profit/loss/report','ProfitLossReport')->name('profit.loss.report');
            Route::get('/profit/loss/report/pdf','ProfitLossReportPdf')->name('profit.loss.report.pdf');
        });
    });

    Route::controller(StockController::class)->group(function (){
        Route::prefix('admin')->group(function (){
            Route::get('/stock/report','stockReport')->name('stock.report');
            Route::get('/stock/report/pdf','stockReportPdf')->name('stock.report.pdf');
            Route::get('/stock/supplier/product','stockSupplier')->name('supplier.wise.stock.report');
            Route::get('/stock/supplier/pdf','stockSupplierPdf')->name('supplier.wise.pdf');
            Route::get('/stock/product/pdf','stockProductPdf')->name('product.wise.pdf');
          });
    });
});


require __DIR__.'/auth.php';
