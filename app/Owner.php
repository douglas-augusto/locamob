<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'transfer_day'
    ];

    public function properties()
    {
        return $this->HasMany(Property::class);
    }

    public function contracts()
    {
        return $this->HasMany(Contract::class);
    }
}
