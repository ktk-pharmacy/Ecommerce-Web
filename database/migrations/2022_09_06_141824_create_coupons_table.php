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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('amount');
            $table->string('type');
            $table->bigInteger('limit_per_coupon')->default(null)->nullable();
            $table->bigInteger('limit_per_user')->default(null)->nullable();
            $table->bigInteger('min_amount')->default(0);
            $table->dateTime('from')->nullable();
            $table->dateTime('to')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamp('deleted_at')->default(null)->nullable();
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
        Schema::dropIfExists('coupons');
    }
};
