<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'ratings';

    protected $fillable = [
        'order_id','questionair_id','rating'
    ];


    public function question() {
        return $this->belongsTo('App\Models\Questionair' , 'questionair_id');
    }
}
