<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Staff;
class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('customer_staff', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staff_id');
            $table->unsignedBigInteger('customer_id');
            $table->timestamps();
            $table->foreign('customer_id')
                ->references('id')->on('customers')
                ->onDelete('cascade');
        });


        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('desc')->nullable()->default(null);
            $table->timestamps();
        });

        Staff::insert([
            [
                "name" => 'super',
                'desc' => 'الحساب الرئيسي للشركة',
            ],
            [
                'name' => 'branch',
                'desc' => 'فرع للشركة او المطعم',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
}
