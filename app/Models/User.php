<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    public $timestamps = false;

    protected $fillable = [
        'name_user',
        'email_user',
        'role',
        'is_active',
        'login_with',
        'password_hash',
    ];

    protected $hidden = [
        'password_hash',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
    ];

    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class, 'id_user', 'id_user');
    }

    public function farmer(): HasOne
    {
        return $this->hasOne(Farmer::class, 'id_user', 'id_user');
    }

    public function admin(): HasOne
    {
        return $this->hasOne(Admin::class, 'id_user', 'id_user');
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'id_user', 'id_user');
    }
}
