<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_id')->unique();
            $table->unsignedBigInteger('company_id'); 
            $table->unsignedBigInteger('customer_id'); 
            $table->unsignedBigInteger('vehicle_id');

            $table->unsignedBigInteger('driver_id');
            $table->string('another_time')->nullable()->default(null);
            $table->longText('invoice')->nullable()->default(null);
            $table->longText('place_image')->nullable()->default(null);
            $table->string('change_by_user')->nullable()->default(null);

            $table->string('from_lat')->nullable()->default(null);
            $table->string('from_long')->nullable()->default(null);
            $table->string('to_lat')->nullable()->default(null);
            $table->string('to_long')->nullable()->default(null);
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('cod_amount')->nullable();
            $table->string('delivery_fees')->nullable()->default(null);
            $table->string('approx_time')->nullable()->default(null);
            $table->string('approx_km')->nullable()->default(null);
            $table->string('box_count')->nullable()->default(null);
            // $table->string('city')->nullable()->default(null);
            $table->unsignedBigInteger('city_id');
            $table->string('region')->nullable()->default(null);            
            $table->string('status')->nullable()->default('unassigned');
            $table->string('delivery_time')->nullable()->default(null);
            $table->string('approx_weight')->nullable()->default(null);
            $table->string('goods_type')->nullable()->default(null);
            $table->integer('is_scanned')->nullable()->default(0);
            $table->integer('payment')->nullable()->default(0);
            $table->string('security_code')->nullable()->default(null);
            $table->integer('payment_type')->nullable()->default(0);
            $table->integer('payment_status')->nullable()->default(0);
            $table->integer('type')->nullable()->default(0);
            $table->integer('upload')->default(0);
            $table->integer('isAccept')->nullable()->default(0);
            $table->timestamp('canceled_at')->nullable()->default(null);
            $table->string('canceled_after')->nullable()->default(null);
            $table->timestamps();
            // $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            // $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
