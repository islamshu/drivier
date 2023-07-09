<?php

namespace App;

use App\Notifications\Driver\DriverResetPassword;
use App\Notifications\Driver\DriverVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder;
class Driver extends Authenticatable
{

    
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'driver_id',
        'fname', 
        'lname', 
        'email', 
        'password',

        'phone',
        'api_token',
        'device_token',
        'state_num' , 
        'bank_num' ,
        'bank_name',

        'person_name', 
        'license_num',
        'country_id' , 
        'birthdate_hijri',
        'birthdate', 
        
        'driver_lon', 
        'driver_lat',
        'state_expire_date',
        'license_expire_date',
        
        'language', 
        'city_id',
        'vehicle_id' , 
        'online', 
        'active' , 

        'type' , 
        'salary' , 

        'license_type',
        'driver_image',
        'license_image',
        'car_image',
        'state_image' ,
        'insurance_image', 
        'car_isemara',
        'bank_card' , 
        'account_number_image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function ratings() {
        return $this->hasMany('App\Models\Rating');
    }

    public function attendances() {
        return $this->hasMany('App\Models\Attendance');
    }

    public function vehicle() {
        return $this->belongsTo('App\Models\Vehicle');
    }
    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new DriverResetPassword($token));
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new DriverVerifyEmail);
    }


    public function city() {
        return $this->belongsTo('App\Models\City');
    }

    public function country() {
        return $this->belongsTo('App\Models\Country');
    }


    public function driverworks() {
        return $this->hasMany('App\Models\DriverWorks');
    }

    
    public function scopeFreeDriver($builder) {
        $builder->whereHas('orders' , function($query) {
            $query->whereNotIn('orders.status' , ['assign_to_driver' , 'to_be_delivered']);
        });
    }
    
    
    public function orders() {
        return $this->hasMany('App\Models\Order');
    }




    public function scopeActive($builder) {
        $builder->where('active' ,1);
    }
    
    public function scopePending($builder) {
        $builder->where('active' ,2);
    }
    
    public function scopeBlock($builder) {
        $builder->where('active' ,3);
    }


}
