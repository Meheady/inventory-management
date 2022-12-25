<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
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
})->middleware(['auth','verified'])->name('dashboard');

Route::middleware(['auth','verified'])->group(function () {
    Route::get('/admin/logout',[AdminController::class,'destroy'])->name('admin.logout');
    Route::get('/admin/profile',[AdminController::class,'profile'])->name('admin.profile');
    Route::get('/admin/edit-profile',[AdminController::class,'editProfile'])->name('edit.profile');
    Route::post('/admin/store-profile',[AdminController::class,'storeProfile'])->name('store.profile');
    Route::get('/admin/change-password',[AdminController::class,'changePassword'])->name('change.password');
    Route::post('/admin/update-password',[AdminController::class,'updatePassword'])->name('update.password');
});


require __DIR__.'/auth.php';
