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
            $table->string('product_name',255)->unique();
            $table->string('slug',255)->unique();
            $table->unsignedBigInteger('cat_id');
            $table->unsignedBigInteger('brand_id')->default(0);
            $table->string('image')->nullable();
            $table->double('price');
            $table->text('description')->nullable();
            $table->boolean('is_on_sale')->default(false);
            $table->double('sale_price')->default(0);
            $table->integer('views')->default(0);
            $table->unsignedInteger('qty')->default(0);
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->softDeletes('deleted_at');
            $table->unsignedInteger('status')->default(1);
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
