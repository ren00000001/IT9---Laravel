<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

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

 Route::post('/cashier/process-order', [OrderController::class, 'store'])
        ->name('cashier.process-order');

Route::get('/orders/{order}/receipt', [OrderController::class, 'showReceipt'])
        ->name('orders.receipt');


Route::prefix('TurboParts')->group(function() {

    Route::prefix('Admin')->group(function(){

        Route::get('/dashboard', function(){
            return view('TurboParts.Admin.Dashboard');
        })->name('admin.dashboard');
    
        Route::get('/products', function(){
            return view('TurboParts.Admin.Products');
        })->name('admin.products');
        
        Route::get('/inventory', [CategoryController::class, 'adminIndex'])
        ->name('admin.inventory');
         
        Route::get('/sales', function () {
            return view('TurboParts.Admin.Sales');
        })->name('admin.sales');
        
        Route::get('/archives', function () {
            return view('TurboParts.Admin.Archives');
        })->name('admin.archives');

        Route::get('/settings', [UserController::class, 'index'])
            ->name('admin.settings');

            Route::post('/users', [UserController::class, 'store'])
            ->name('admin.users.store');

            Route::get('/users/{user}/edit', [UserController::class, 'edit'])
            ->name('admin.users.edit');

            Route::put('/users/{user}', [UserController::class, 'update'])
            ->name('admin.users.update');

            Route::delete('/users/{user}', [UserController::class, 'destroy'])
            ->name('admin.users.destroy'); 
    });
    
    Route::prefix('Cashier')->group(function(){
        
        Route::get('/pos', function(){
            return view('TurboParts.Cashier.POS');
        })->name('cashier.pos');

        Route::get('/sales', function(){
            return view('TurboParts.Cashier.Sales');
        })->name('cashier.sales');

        Route::get('/sales/history', [OrderController::class, 'index'])
        ->name('cashier.viewhistory');

        Route::get('/Inventory', function(){
            return view('TurboParts.Cashier.Inventory');
        })->name('cashier.inventory');
        
    });    
    
    Route::prefix('Staff')->group(function(){

//Products---------------------------------------------------------------
        Route::get('Products', [ProductController::class, 'index'])
        ->name('staff.products');

        Route::get('Products/low-stock', [ProductController::class, 'lowStock'])
        ->name('staff.products.low-stock');

        Route::post('/products', [ProductController::class, 'store'])
        ->name('staff.products.store');

        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
        ->name('staff.products.edit');

        Route::put('/products/{product}', [ProductController::class, 'update'])
        ->name('staff.products.update');

        Route::delete('/products/{product}', [ProductController::class, 'destroy'])
        ->name('staff.products.destroy');
//Products---------------------------------------------------------------

//Inventory---------------------------------------------------------------      
        Route::get('Inventory', [InventoryController::class, 'index'])
        ->name('staff.inventory');

        Route::get('/inventories/{inventory}/edit', [InventoryController::class, 'edit'])
        ->name('staff.inventory.edit');

        Route::put('/inventories/{inventory}', [InventoryController::class, 'update'])
        ->name('staff.inventory.update');

        Route::post('/categories', [CategoryController::class, 'store'])
        ->name('staff.categories.store');

        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])
        ->name('staff.categories.edit');

        Route::put('/categories/{category}', [CategoryController::class, 'update'])
        ->name('staff.categories.update');

        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
        ->name('staff.categories.destroy');
    });
//Inventory---------------------------------------------------------------

});
