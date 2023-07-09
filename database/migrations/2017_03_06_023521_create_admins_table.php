<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\City;
class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('cities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('lat')->nullable()->default(null);
            $table->string('lng')->nullable()->default(null);
            $table->timestamps();
        });

        City::insert([
            [
                'name' => 'الرياض',
                'lat'  => '24.7135517',
                'lng'  => '46.6752957',
            ],
            [
                'name' => 'جدة',
                'lat'  => '21.485811',
                'lng'  => '39.19250479999999',
            ],
            [
                'name' => 'المدينة',
                'lat'  => '24.5246542',
                'lng'  => '39.5691841',
            ],
            [
                'name' => 'مكة المكرمة',
                'lat'  => '21.5235584',
                'lng'  => '41.9196471',
            ],
            [
                'name' => 'الإحساء',
                'lat'  => '21.9113305',
                'lng'  => '49.36531489999999',
            ],
            [
                'name' => 'الدمام',
                'lat'  => '26.4206828',
                'lng'  => '50.0887943',
            ],
            [
                'name' => 'الطائف',
                'lat'  => '21.2840782',
                'lng'  => '40.4248192',
            ],
        ]);

        Schema::create('regions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('city_id');
            $table->string('name');
            $table->timestamps();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
        });


        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('active')->default(0);
            $table->unsignedBigInteger('city_id')->default(0);
            $table->rememberToken();
            $table->timestamps();
            // $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
