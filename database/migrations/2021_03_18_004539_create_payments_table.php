<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->default(0);
            $table->unsignedBigInteger('company_id')->default(0);
            $table->string('amount_id')->nullable()->default(null);
            $table->string('paymentType')->nullable()->default(null);
            $table->string('paymentBrand')->nullable()->default(null);
            $table->double('amount')->nullable()->default(null);
            $table->string('currency')->nullable()->default(null);
            $table->double('bin')->nullable()->default(null);
            $table->integer('last4Digits')->nullable()->default(null);
            $table->integer('expiryMonth')->nullable()->default(null);
            $table->integer('expiryYear')->nullable()->default(null);
            $table->string('ip')->nullable()->default(null);
            $table->string('ipCountry')->nullable()->default(null);
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
        Schema::dropIfExists('payments');
    }
}
