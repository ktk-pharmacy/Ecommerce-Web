<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('image_url', 100)->nullable();
            $table->string('file_name', 50)->nullable();
            $table->string('file_path', 50)->nullable();
            $table->string('file_type', 50)->nullable();
            $table->string('file_size', 50)->nullable();
            $table->unsignedBigInteger('mediable_id')->nullable();
            $table->string('mediable_type')->nullable();
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
        Schema::dropIfExists('media');
    }
}
