<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'id_product';
    public $timestamps = false;

    protected $fillable = [
        'id_farm',
        'id_category',
        'product_image',
        'product_name',
        'price_per_kg',
        'stock_qty',
        'harvest_date',
        'description',
        'is_available',
        'type_product',
        'rating',
    ];

    protected $casts = [
        'price_per_kg' => 'decimal:2',
        'stock_qty' => 'decimal:2',
        'rating' => 'decimal:1',
        'is_available' => 'boolean',
        'harvest_date' => 'date',
    ];

    public function farm(): BelongsTo
    {
        return $this->belongsTo(Farm::class, 'id_farm', 'id_farm');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'id_category', 'id_category');
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class, 'id_product', 'id_product');
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'id_product', 'id_product');
    }

    public function bookmarks(): HasMany
    {
        return $this->hasMany(Bookmark::class, 'id_product', 'id_product');
    }
}
