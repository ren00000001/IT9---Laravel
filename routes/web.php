<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Controllers\AuthController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::post('/login', [AuthController::class, 'login']);

Route::prefix('TurboParts')->group(function() {

    Route::prefix('Admin')->group(function(){

        Route::get('/dashboard', function(){
            return view('TurboParts.Admin.Dashboard');
        })->name('admin.dashboard');
    
        Route::get('/products', function(){
            return view('TurboParts.Admin.Products');
        })->name('admin.products');
    
        Route::get('/customers', function () {
            return view('TurboParts.Admin.Customers');
        })->name('admin.customers');
        
        Route::get('/invetory', function () {
            return view('TurboParts.Admin.Inventory');
        })->name('admin.inventory');
        
        Route::get('/supplier', function () {
            return view('TurboParts.Admin.Supplier');
        })->name('admin.supplier');
         
        Route::get('/sales', function () {
            return view('TurboParts.Admin.Sales');
        })->name('admin.sales');
        
        Route::get('/archives', function () {
            return view('TurboParts.Admin.Archives');
        })->name('admin.archives');
        
        Route::get('/settings', function(){
            return view('TurboParts.Admin.Settings');
        })->name('admin.settings');
    
    });
    
    Route::prefix('Staff')->group(function(){
        
        Route::get('/dashboard', function(){
            return view('TurboParts.Cashier.Dashboard');
        })->name('cashier.dashboard');
    });     

});

Route::post('/', [AuthController::class, 'logout']
)->name('logout');

