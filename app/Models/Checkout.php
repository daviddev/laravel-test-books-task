<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property int $id
 * @property int $user_id
 * @property int $book_id
 * @property string $checkout_date
 * @property string $return_date
 * @property-read Book $book
 */
class Checkout extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'checkouts';

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

    /**
     * Book model relation.
     *
     * @return BelongsTo
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
