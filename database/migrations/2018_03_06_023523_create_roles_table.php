<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Admin;
use App\Role;
class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('desc')->nullable()->default(null);
            $table->timestamps();
        });

        Role::insert([
            [
                "name" => 'super',
                "desc" => 'لديه كافة صلاحيات النظام',
            ],
            [
                'name' => 'accounting',
                'desc' => 'الإطلاع على قسم المحاسبة و التقارير فقط',
            ],
            [
                'name' => 'drivers',
                'desc' => 'التحكم بالسائقيين ',
                
            ],
            [
                'name' => 'orders',
                'desc' => 'التحكم بالطلبات',
            ],
            [
                'name' => 'orders_editing',
                'desc' => 'تعديل الطلبات و حالة الطلب',
            ],
            [
                'name' => 'manage_stores',
                'desc' => 'التحكم بالشركات و حساباتهم ',
            ],
            [
                'name' => 'manage_cities',
                'desc' => 'التحكم بالمدن و الإحياء',
            ],
        ]);

        $admin = Admin::create([
            'name' => 'Admin' , 
            'email' => 'admin@admin.com',
            'password' => bcrypt('120110220'),
            'city_id'  => 0,
        ]);
        $admin->roles()->sync([1]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
