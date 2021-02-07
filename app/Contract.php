<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'property_id',
        'owner_id',
        'customer_id',
        'start_day',
        'end_day',
        'administrative_fee',
        'rent_amount',
        'condominium_amount',
        'iptu_amount'
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function monthly_payments()
    {
        return $this->hasMany(MonthlyPayment::class);
    }

}
