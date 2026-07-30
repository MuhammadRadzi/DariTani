<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    protected $table = 'cart_item';
    protected $primaryKey = 'id_cart_item';
    public $timestamps = false;

    protected $fillable = [
        'id_cart',
        'id_product',
        'qty',
    ];

    protected $casts = [
        'qty' => 'decimal:2',
    ];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class, 'id_cart', 'id_cart');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'id_product', 'id_product');
    }
}
