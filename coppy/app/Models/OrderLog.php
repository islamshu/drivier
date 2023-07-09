<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderLog extends Model
{
    protected $table = 'order_logs';

    protected $fillable = [
        'order_id','change_by_user','note_en', 'note_ar'
    ];

    public function order() {
        return $this->belongsTo('App\Models\Order' , 'order_id');
    }
}
