<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Company extends Model
{
    protected $table = 'companies';


    protected $fillable = [
        'company_id','company_type' ,'company_name',
        'company_address','company_phone' , 
        'company_logo',
        'city_id', 'status',
        'company_lat' , 'company_long' , 
        'company_Num','company_taxNum',
        'company_carType','company_comType',
        'contract_image' , 'delivery_type','workings_day',
        'bank_name' ,'bank_iban' , 'bank_accountNum' , 'bank_person','bank_phone','bank_email',
        'contact_name','contact_phone','contact_email','contact_job',
        
        'fee_fast','fee_goods',
        'km_fast','km_goods',
        'km_fee_fast','km_fee_goods',
    ];


    protected $hidden = [
        'delivery_type'
    ];


    public function users() {
        return $this->hasMany('App\Customer' , 'company_id');
    }

    public function city() {
        return $this->belongsTo('App\Models\City');
    }
}
