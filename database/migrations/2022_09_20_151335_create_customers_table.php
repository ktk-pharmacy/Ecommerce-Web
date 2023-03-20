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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('provider_id')->nullable();
            $table->string('provider')->nullable();
            $table->date('birthday')->nullable();
            $table->string('gender')->nullable();
            $table->string('contact_phone_no')->nullable();
            $table->string('profile_image')->nullable();
            $table->text('billing_address')->nullable();
            $table->text('shipping_address')->nullable();
            $table->unsignedBigInteger('child_location_id')->nullable();
            $table->foreign('child_location_id')->references('id')->on('locations')->onDelete('set null');
            $table->text('order_note')->nullable();
            $table->boolean('status')->default(1)->comment('1 is Active, 0 is Unactive');
            $table->timestamp('verified_at')->nullable();
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
        Schema::dropIfExists('customers');
    }
};
