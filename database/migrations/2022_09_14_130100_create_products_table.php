<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->mediumText('description')->nullable();
            $table->string('feature_image')->default('assets/theme/img/default/528-default-product.jpg');
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('sale_price');
            $table->unsignedBigInteger('discount_amount')->nullable();
            $table->string('discount_type')->nullable();
            $table->timestamp('discount_from')->nullable();
            $table->timestamp('discount_to')->nullable();
            $table->unsignedBigInteger('stock')->nullable();
            $table->boolean('is_new')->default(0)->comment('1 is New, 0 is Old');
            $table->boolean('status')->default(1)->comment('1 is Active, 0 is Unactive');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
