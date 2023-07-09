<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyWorks extends Model
{
    protected $table = 'company_works';


    protected $fillable = [
        'company_id',
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
