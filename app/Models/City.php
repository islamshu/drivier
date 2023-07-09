<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Region;
class City extends Model
{
    protected $table = 'cities';


    protected $fillable = [
        'name' , 'lat','lng'
    ];

    
    public function regions() {
        return $this->hasMany('App\Models\Region' , 'city_id');
    }
}
