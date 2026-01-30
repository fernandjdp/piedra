<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Cashflow extends Model
{
    //description, amount, type, date, fixed, category, user_id
    protected $guarded = [];
}
