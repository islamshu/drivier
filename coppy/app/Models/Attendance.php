<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendances';


    protected $fillable = ['driver_id' , 'panishment_id' ];


    public function driver() {
        return $this->hasMany('App\Driver');
    }

    public function panishment() {
        return $this->belongsTo('App\Models\Panishment');
    }
}
