<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'id_cart';
    public $timestamps = true;

    protected $fillable = [
        'id_customer',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id_customer');
    }

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class, 'id_cart', 'id_cart');
    }
}
