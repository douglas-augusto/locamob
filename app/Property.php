<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'owner_id',
        'street',
        'number',
        'complement',
        'district',
        'zip_code',
        'city',
        'uf'
    ];

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function contracts()
    {
        return $this->HasMany(Contract::class);
    }
}
