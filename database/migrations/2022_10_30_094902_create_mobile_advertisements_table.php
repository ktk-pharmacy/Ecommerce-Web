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
        Schema::create('mobile_advertisements', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('reference_id');
            $table->string('reference_type')->comment('product, category');
            $table->string('image_url')->default('assets/theme/img/default/528-default-product.jpg');
            $table->string('type')->default('product')->comment('slider, sidebar');
            $table->unsignedBigInteger('sorting')->nullable();
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
        Schema::dropIfExists('mobile_advertisements');
    }
};
