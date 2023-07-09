<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Vehicle extends Model
{
    protected $table = "vehicles";


    protected $fillable = ['city_id','car_id','carName','carType', 'body_type','color','year','reg_number','capacity' , 'active'];


    public function driver() {
        return $this->belongsTo('App\Driver');
    }
    

    public function scopeActive($builder) {
        $builder->where('active' ,0);
    }

    public function scopeDeactive($builder) {
        $builder->where('active' ,1);
    }
}
