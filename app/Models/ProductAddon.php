<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAddon extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name_en',
        'name_ar',
        'image',
        'price',
        'in_stock',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
