<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Farmer extends Model
{
    protected $table = 'farmer';
    protected $primaryKey = 'id_farmer';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'farm_name',
        'location',
        'address',
        'whatsapp_number',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function farms(): HasMany
    {
        return $this->hasMany(Farm::class, 'id_farmer', 'id_farmer');
    }

    /**
     * Semua produk milik petani ini, ditelusuri lewat farm
     * (product tidak punya kolom id_farmer langsung).
     */
    public function products(): HasManyThrough
    {
        return $this->hasManyThrough(
            Product::class,
            Farm::class,
            'id_farmer', // FK di Farm -> Farmer
            'id_farm',   // FK di Product -> Farm
            'id_farmer', // PK lokal di Farmer
            'id_farm'    // PK lokal di Farm
        );
    }
}
