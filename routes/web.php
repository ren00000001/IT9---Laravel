<?php

use Illuminate\Support\Facades\Route;
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
})->name('login.show');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/', [AuthController::class, 'logout']
)->name('logout');

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
    
    Route::prefix('Cashier')->group(function(){
        
        Route::get('/pos', function(){
            return view('TurboParts.Cashier.POS');
        })->name('cashier.pos');

        Route::get('/sales', function(){
            return view('TurboParts.Cashier.Sales');
        })->name('cashier.sales');

        Route::get('/Full History', function(){
            return view('TurboParts.Cashier.FullHistory');
        })->name('cashier.viewhistory');

        Route::get('/Inventory', function(){
            return view('TurboParts.Cashier.Inventory');
        })->name('cashier.inventory');
    });    
    
    Route::prefix('Staff')->group(function(){

        Route::get('/Products', function(){
            return view('TurboParts.Staff.Products');
        })->name('staff.products');

        Route::get('Inventory', function(){
            return view('TurboParts.Staff.Inventory');
        })->name('staff.inventory');
    });

});

