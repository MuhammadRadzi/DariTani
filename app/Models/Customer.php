<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Customer extends Model
{
    protected $table = 'customer';
    protected $primaryKey = 'id_customer';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'address',
        'phone',
        'profile_photo',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class, 'id_customer', 'id_customer');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'id_customer', 'id_customer');
    }

    public function bookmarks(): HasMany
    {
        return $this->hasMany(Bookmark::class, 'id_customer', 'id_customer');
    }
}
