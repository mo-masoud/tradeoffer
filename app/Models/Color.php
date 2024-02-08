<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $fillable = ['color'];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('extra_price', 'in_stock');
    }
}
