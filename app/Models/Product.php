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
        'meta',
        'category_id',
        'store_id',
        'discount',
    ];

    protected $casts = [
        'price' => 'float',
        'discount' => 'float',
        'meta' => 'json',
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

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function branches()
    {
        return $this->belongsToMany(Branch::class)->withPivot('in_stock');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class)->withPivot('extra_price', 'in_stock');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class)->withPivot('extra_price', 'in_stock');
    }

    public function attributes()
    {
        return $this->belongsToMany(AttributeValue::class)->withPivot('extra_price', 'in_stock');
    }

    public function addons()
    {
        return $this->hasMany(ProductAddon::class);
    }

    public function hasOffer(): Attribute
    {
        return Attribute::make(get: function () {
            return $this->offers()->active()->exists();
        });
    }

    public function offers()
    {
        return $this->belongsToMany(Offer::class);
    }

    public function scopeTopSelling($query)
    {
        return $query->with('store', 'categories', 'media')->take(12);
    }
}
