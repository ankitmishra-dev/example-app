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
            $table->id();
            $table->string('bigcomm_prod_id')->unique();
            $table->string('name')->nullable();
            $table->string('sku')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('is_active')->nullable()->default(false);
            $table->string('price')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('category_id')->nullable()->nullOnDelete();
            $table->timestamps();
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
