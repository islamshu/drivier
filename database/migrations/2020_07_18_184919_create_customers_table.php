<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('city_id');
            $table->string('customer_id')->unique();
            $table->string('name');
            $table->string('branch_name')->nullable()->default(null);
            $table->string('branch_phone')->nullable()->default(null);
            $table->string('branch_address')->nullable()->default(null);
            $table->string('branch_lat')->nullable()->default(null);
            $table->string('branch_long')->nullable()->default(null);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('api_token')->nullable()->default(null);
            $table->string('device_token')->nullable()->default(null);
            $table->boolean('active')->default(0);
            $table->integer('amount')->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('city_id')
                ->references('id')->on('cities')
                ->onDelete('cascade');
            $table->foreign('company_id')
                ->references('id')->on('companies')
                ->onDelete('cascade');
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
}
