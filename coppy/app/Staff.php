<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($staff) {
            if ($staff->customers()->count() > 0) {
                throw new \Exception('Can not delete, Role is assigned to Customer.');
            }
        });
    }

    protected $fillable = ['name'];

    public function customers()
    {
        return $this->belongsToMany(Customer::class);
    }

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = strtolower($name);
    }
}
