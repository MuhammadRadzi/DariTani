<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bookmark extends Model
{
    protected $table = 'bookmark';
    protected $primaryKey = 'id_bookmark';
    public $timestamps = false;

    protected $fillable = [
        'id_customer',
        'id_farm',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id_customer');
    }

    public function farm(): BelongsTo
    {
        return $this->belongsTo(Farm::class, 'id_farm', 'id_farm');
    }
}
