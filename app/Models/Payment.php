<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $table = 'payment';
    protected $primaryKey = 'id_payment';
    public $timestamps = false;

    protected $fillable = [
        'id_order',
        'payment_proof',
        'status',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'id_order', 'id_order');
    }
}
