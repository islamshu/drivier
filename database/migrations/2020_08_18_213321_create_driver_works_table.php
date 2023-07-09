<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_works', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('driver_id');
            $table->integer('saturday')->nullable()->default(0);
            $table->integer('sunday')->nullable()->default(0);
            $table->integer('monday')->nullable()->default(0);
            $table->integer('tuesday')->nullable()->default(0);
            $table->integer('wednesday')->nullable()->default(0);
            $table->integer('thursday')->nullable()->default(0);
            $table->integer('friday')->nullable()->default(0);
            $table->string('from_time')->nullable()->default(null);
            $table->string('to_time')->nullable()->default(null);
            $table->timestamps();
            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('driver_works');
    }
}
