<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Controllers\AuthController;

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
    return view('MotoPOS.Login');
})->name('login');

Route::get('/dashboard', function(){
    return view('MotoPOS.Dashboard');
})->name('dashboard');

Route::get('/products', function(){
    return view('MotoPOS.Products');
})->name('products');

Route::get('/customers', function () {
    return view('MotoPOS.Customers');
})->name('customers');

Route::get('/invetory', function () {
    return view('MotoPOS.Inventory');
})->name('inventory');

Route::get('/supplier', function () {
    return view('MotoPOS.Supplier');
})->name('supplier');
 
Route::get('/sales', function () {
    return view('MotoPOS.Sales');
})->name('sales');

Route::get('/archives', function () {
    return view('MotoPOS.Archives');
})->name('archives');

Route::get('/settings', function(){
    return view('MotoPOS.Settings');
})->name('settings');

Route::post('/', [AuthController::class, 'logout']
)->name('logout');
