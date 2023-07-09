<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'regions';


    protected $fillable = ['name'];

    
    public function city() {
        return $this->belongsTo('App\Models\City');
    }
}
