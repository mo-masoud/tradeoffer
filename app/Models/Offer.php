<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @property mixed $description_en
 * @property mixed $description_ar
 * @property mixed $title_en
 * @property mixed $title_ar
 */
class Offer extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'store_id',
        'title_en',
        'title_ar',
        'description_en',
        'description_ar',
        'discount',
        'max_discount',
        'start_at',
        'end_at',
        'featured',
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    protected $appends = ['title', 'description'];

    public function scopeActive($query)
    {
        return $query->where('start_at', '<=', now())->where('end_at', '>=', now());
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function branches(): BelongsToMany
    {
        return $this->belongsToMany(Branch::class);
    }

    public function title(): Attribute
    {
        return new Attribute(function () {
            return app()->getLocale() == 'ar' ? $this->title_ar : $this->title_en;
        });
    }

    public function description(): Attribute
    {
        return new Attribute(function () {
            return app()->getLocale() == 'ar' ? $this->description_ar : $this->description_en;
        });
    }

    public function scopeFilterByCategory($query, $category)
    {
        return $query->where(function ($query) use ($category) {
            $query->whereHas('products',
                fn($query) => $query->whereHas('categories',
                    fn($query) => $query->where('id', $category)
                )
            )->orWhereHas('store',
                fn($query) => $query->whereHas('categories',
                    fn($query) => $query->where('id', $category)
                )
            );
        });
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeTop($query)
    {
        return $query
            ->with('media', 'store')
            ->active()
            ->featured(true)
            ->latest();
    }
}
