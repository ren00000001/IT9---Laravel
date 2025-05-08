<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\Inventory;
use Illuminate\Support\ServiceProvider;

class ProductInventoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Product::created(function($product){
          $product->inventory()->create(['stocks_quantity'=>0]);
        });

        Inventory::updated(function($inventory){
            $inventory->product->updateQuietly([
                'product_quantity' => $inventory->stocks_quantity
            ]);
        });
    }
}
