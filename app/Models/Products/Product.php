<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'bigcomm_prod_id',
        'name',
        'sku',
        'slug',
        'is_active',
        'price',
        'description',
        'category_id',
    ];
}
