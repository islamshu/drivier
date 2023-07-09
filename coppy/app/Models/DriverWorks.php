<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DriverWorks extends Model
{
    protected $table = 'driver_works';


    protected $fillable = [
        'driver_id',
        'saturday',
        'sunday',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'from_time',
        'to_time',
    ];
}
