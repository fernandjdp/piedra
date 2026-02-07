<?php

declare(strict_types=1);

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

final class Cashflow extends Model
{
    // description, amount, type, date, fixed, status, user_id
    protected $guarded = [];

    protected $dates = ['created_at', 'updated_at', 'date'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'fixed' => 'boolean',
            'date' => 'datetime',
        ];
    }
}
