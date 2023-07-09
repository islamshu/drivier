<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model {
    protected $table = 'alerts';

    protected $fillable = ['order_id' , 'message' , 'read'];


    public function order() {
        return $this->belongsTo('App\Models\Order');
    }
}
