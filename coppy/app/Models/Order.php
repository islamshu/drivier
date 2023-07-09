<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Rating;
class Order extends Model
{
    protected $table = 'orders';



    protected $fillable = [
        'order_id' , 
        'customer_id',
        'company_id', 
        'name',
        'phone',
        'vehicle_id',
        'cod_amount', 
        'box_count', 
        'region' ,
        'city_id' ,
        'approx_time',
        'approx_km',
        'type',
        'upload',
        'isAccept',
        'payment',
        'status',
        'from_lat',
        'from_long',
        'to_lat',
        'to_long',
        'delivery_fees',
        'delivery_time',
        'approx_weight',
        'goods_type',
        'is_scanned',
        'payment_type',
        'driver_id',
        'another_time',
        'invoice',
        'place_image',
        'change_by_user',
        'canceled_at',
        'canceled_after',
        'created_at',
    ];
    

    protected $hidden = [ 'payment' , 'security_code','delivery_fees'];
    
    
    public function company() {
        return $this->belongsTo('App\Models\Company' , 'company_id');
    }

    public function customer() {
        return $this->belongsTo('App\Customer');
    }


    public function vehicle() {
        return $this->belongsTo('App\Models\Vehicle');
    }
   
    public function ratings() {
        return $this->hasMany('App\Models\Rating' , 'order_id');
    }

   

    public function logs() {
        return $this->hasMany('App\Models\OrderLog');
    }

    public function alerts() {
        return $this->hasMany('App\Models\Alert');
    }

    public function driver() {
        return $this->belongsTo('App\Driver');
    }


    public function city() {
        return $this->belongsTo('App\Models\City');
    }


}
