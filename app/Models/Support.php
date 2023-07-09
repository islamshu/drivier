<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $table = 'supports';

    protected $fillable = [
        'company_id','customer_id','order_id','message',
    ];


    public function order() {
        return $this->belongsTo('App\Models\Order');
    }
    public function company() {
        return $this->belongsTo('App\Models\Company');
    }
    public function customer() {
        return $this->belongsTo('App\Customer');
    }
    
    public function replies() {
        return $this->hasMany('App\Models\Reply');
    }
}
