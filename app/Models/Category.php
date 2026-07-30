<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'id_category';
    public $timestamps = false;

    protected $fillable = [
        'name_category',
        'description',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'id_category', 'id_category');
    }
}
