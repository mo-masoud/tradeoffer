<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name_en',
        'name_ar',
        'description_en',
        'description_ar',
        'price',
        'category_id',
        'branch_id',
        'discount',
        'in_stock',
    ];

    protected $appends = ['name', 'description'];

    public function name(): Attribute
    {
        return new Attribute(function ($value) {
            return app()->getLocale() == 'ar' ? $this->name_ar : $this->name_en;
        });
    }

    public function description(): Attribute
    {
        return new Attribute(function ($value) {
            return app()->getLocale() == 'ar' ? $this->description_ar : $this->description_en;
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function offers()
    {
        return $this->belongsToMany(Offer::class);
    }

    public function scopeMostSelling($query)
    {
        return $query;
    }
}
