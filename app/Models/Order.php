<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'id_order';
    public $timestamps = false;

    protected $fillable = [
        'id_customer',
        'order_date',
        'total_amount',
        'status',
        'delivery_address',
        'notes',
        'cancelled_at',
    ];

    protected $casts = [
        'order_date' => 'date',
        'total_amount' => 'decimal:2',
        'cancelled_at' => 'datetime',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id_customer');
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'id_order', 'id_order');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'id_order', 'id_order');
    }
}
