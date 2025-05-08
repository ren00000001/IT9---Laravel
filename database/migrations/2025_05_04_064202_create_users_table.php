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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('user_firstname', 50);
            $table->string('user_lastname', 50);
            $table->string('user_password', 255);
            $table->enum('user_role', ['admin', 'cashier', 'staff'])->default('admin');
            $table->boolean('is_active')->default(true);
            $table->timestamp('date_created')->useCurrent();
            $table->dateTime('last_login')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
