<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_id')->unique();
            $table->integer('company_type')->default(0); // العميل توصيل سريع او شحن بضائع
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_zipnum')->nullable();
            $table->string('company_phone')->nullable();
            $table->string('company_logo')->nullable()->default(null);
            $table->string('company_Num')->nullable()->default(null);
            $table->string('company_taxNum')->nullable()->default(null);
            $table->string('company_carType')->nullable()->default(null);
            $table->string('company_currency')->nullable()->default('ras');
            // $table->integer('company_comType')->nullable()->default(0);
            // $table->string('workings_day')->nullable()->default(null);
            $table->string('company_lat')->nullable()->default(null);
            $table->string('company_long')->nullable()->default(null);
            // accounting
            $table->string('fee_fast')->nullable()->default(0);
            $table->string('fee_goods')->nullable()->default(0);
            $table->string('km_fast')->nullable()->default(0);
            $table->string('km_goods')->nullable()->default(0);
            $table->string('km_fee_fast')->nullable()->default(1);
            $table->string('km_fee_goods')->nullable()->default(0);




            $table->string('orders_per_day')->nullable()->default(0);
            $table->string('delivery_type')->nullable()->default(0); // per order or Contract
            $table->string('contract_image')->nullable()->default(null);
            // $table->integer('car_typ')->default(0);
            $table->string('credit_amount')->nullable()->default(0);
            // مسؤول التواصل
            $table->string('contact_name')->nullable()->default(null);
            $table->string('contact_phone')->nullable()->default(null);
            $table->string('contact_email')->nullable()->default(null);
            $table->string('contact_job')->nullable()->default(null);
            // المدير المالي
            $table->string('bank_name')->nullable()->default(null);
            $table->string('bank_iban')->nullable()->default(null);
            $table->string('bank_accountNum')->nullable()->default(null);
            $table->string('bank_person')->nullable()->default(null);
            $table->string('bank_phone')->nullable()->default(null);
            $table->string('bank_email')->nullable()->default(null);

            $table->integer('status')->default(0);
            $table->unsignedBigInteger('city_id');
            $table->timestamps();
            $table->foreign('city_id')
                ->references('id')->on('cities')
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
        Schema::dropIfExists('companies');
    }
}
