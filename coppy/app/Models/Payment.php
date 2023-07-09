<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'customer_id','company_id','amount_id','paymentType','paymentBrand',
        'amount','currency','bin','last4Digits','expiryMonth','expiryYear','ip','ipCountry'
    ];
}
