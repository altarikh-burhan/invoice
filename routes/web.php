<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ExampleController;
use App\Models\City;
use App\Models\District;

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

Route::view('/', 'welcome');
Route::get('example/', [ExampleController::class, 'index'])->name('example');
Route::middleware('auth')->group(function() {
	Route::get('/getCity/{id}', function($id) {
    $city = City::where('province_id', $id)->get();
    return response()->json($city);
	});

	Route::get('/getDistrict/{id}', function($id) {
	    $district = App\Models\District::where('city_id', $id)->get();
	    return response()->json($district);
	});
	Route::view('/dashboard', 'dashboard')->middleware(['auth'])->name('dashboard');
	Route::prefix('product')->group(function () {
		Route::get('/', [ProductController::class, 'index'])->name('product');
		Route::get('create', [ProductController::class, 'create'])->name('product.create');
		Route::post('store', [ProductController::class, 'store'])->name('product.store');
		Route::get('edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
		Route::put('update/{product}', [ProductController::class, 'update'])->name('product.update');
		Route::delete('delete/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
	});

	Route::prefix('customer')->group(function () {
		Route::get('/', [CustomerController::class, 'index'])->name('customer');
		Route::get('create', [CustomerController::class, 'create'])->name('customer.create');
		Route::post('store', [CustomerController::class, 'store'])->name('customer.store');
		Route::get('edit/{customer}', [CustomerController::class, 'edit'])->name('customer.edit');
		Route::put('update/{product}', [CustomerController::class, 'update'])->name('customer.update');
		Route::delete('delete/{customer}', [CustomerController::class, 'destroy'])->name('customer.destroy');
	});
	
	Route::prefix('invoice')->group(function () {
		Route::get('index', [InvoiceController::class, 'index'])->name('invoice.index');
		Route::get('/', [InvoiceController::class, 'create'])->name('invoice.create');
		Route::post('/', [InvoiceController::class, 'store'])->name('invoice.store');
		Route::get('/{id}', [InvoiceController::class, 'edit'])->name('invoice.edit');
		Route::put('/{id}', [InvoiceController::class, 'update'])->name('invoice.update');
		Route::delete('product/{id}', [InvoiceController::class, 'deleteProduct'])->name('invoice.deleteProduct');
		Route::delete('/{id}/delete', [InvoiceController::class, 'destroy'])->name('invoice.destroy');
		Route::get('/{id}/print', [InvoiceController::class, 'generateInvoice'])->name('invoice.print');
	});
});



require __DIR__.'/auth.php';
