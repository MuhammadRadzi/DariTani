<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Farm extends Model
{
    protected $table = 'farm';
    protected $primaryKey = 'id_farm';
    public $timestamps = false;

    protected $fillable = [
        'id_farmer',
        'name_farm',
        'location',
        'photo_farm',
    ];

    public function farmer(): BelongsTo
    {
        return $this->belongsTo(Farmer::class, 'id_farmer', 'id_farmer');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'id_farm', 'id_farm');
    }
}
