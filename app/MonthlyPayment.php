<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonthlyPayment extends Model
{
    protected $fillable = [
        'contract_id',
        'pay_day',
        'pay_value',
        'payed',
        'type'
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
