<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Cashflow extends Model
{
    //description, amount, type, date, fixed, status, user_id
    protected $guarded = [];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'fixed' => 'boolean',
            'date' => 'datetime:d/m/Y',
        ];
    }
}
