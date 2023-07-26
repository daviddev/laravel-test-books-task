<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Checkout extends Pivot
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'book_id',
        'checkout_date',
        'return_date',
    ];
}
