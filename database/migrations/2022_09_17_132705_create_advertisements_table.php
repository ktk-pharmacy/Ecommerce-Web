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
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slider_text1')->nullable();
            $table->string('slider_text2')->nullable();
            $table->string('image_url')->default('assets/theme/img/default/528-default-product.jpg');
            $table->string('type')->nullable()->comment('Ads type');
            $table->string('link')->default('#');
            $table->string('btn_txt')->default('View');
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
        Schema::dropIfExists('advertisements');
    }
};
