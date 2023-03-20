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
        Schema::create('logistics', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('myansan');
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('locations');
            $table->unsignedBigInteger('township_id');
            $table->foreign('township_id')->references('id')->on('locations');
            $table->text("area_description")->nullable();
            $table->unsignedBigInteger('min_order_total')->default(0)->comment('Minimum order total for delivery free');
            $table->unsignedBigInteger('delivery_fee')->default(0);
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
        Schema::dropIfExists('logistics');
    }
};
