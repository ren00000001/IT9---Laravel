<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->string('product_name', 50);
             $table->string('product_image')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->integer('product_quantity')->default(0);
            $table->decimal('product_price', 10, 2);
            $table->tinyInteger('product_status')->nullable()->default(1);
            $table->text('product_description')->nullable();
            $table->timestamps();


            $table->foreign('category_id')
                ->references('category_id')
                ->on('categories')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
