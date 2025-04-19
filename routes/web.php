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
    return view('TurboParts.Login');
})->name('login');

Route::get('/dashboard', function(){
    return view('TurboParts.Dashboard');
})->name('dashboard');

Route::get('/products', function(){
    return view('TurboParts.Products');
})->name('products');

Route::get('/customers', function () {
    return view('TurboParts.Customers');
})->name('customers');

Route::get('/invetory', function () {
    return view('TurboParts.Inventory');
})->name('inventory');

Route::get('/supplier', function () {
    return view('TurboParts.Supplier');
})->name('supplier');
 
Route::get('/sales', function () {
    return view('TurboParts.Sales');
})->name('sales');

Route::get('/archives', function () {
    return view('TurboParts.Archives');
})->name('archives');

Route::get('/settings', function(){
    return view('TurboParts.Settings');
})->name('settings');

Route::post('/', [AuthController::class, 'logout']
)->name('logout');
