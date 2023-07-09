<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questionair extends Model
{
    

    protected $table = 'questionairs';


    protected $fillable = [
        'question_en' , 'question_ar'
    ];


    
}
