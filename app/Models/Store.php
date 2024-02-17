<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed $name_ar
 * @property mixed $name_en
 * @property mixed $description_ar
 * @property mixed $description_en
 */
class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name_en',
        'name_ar',
        'description_en',
        'description_ar',
        'image',
        'featured',
        'is_active',
    ];

    protected $appends = ['name', 'description'];

    public function name(): Attribute
    {
        return new Attribute(function () {
            return app()->getLocale() == 'ar' ? $this->name_ar : $this->name_en;
        });
    }

    public function description(): Attribute
    {
        return new Attribute(function () {
            return app()->getLocale() == 'ar' ? $this->description_ar : $this->description_en;
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function branches(): HasMany
    {
        return $this->hasMany(Branch::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFilterByCategory($query, $category)
    {
        return $query->whereHas('products', function ($query) use ($category) {
            $query->whereHas('categories', function ($query) use ($category) {
                $query->where('id', $category);
            });
        });
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }
}
