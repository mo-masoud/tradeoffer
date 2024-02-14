<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

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

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function branches()
    {
        return $this->belongsToMany(Branch::class)->where('store_id', $this->store_id);
    }

    public function title(): Attribute
    {
        return new Attribute(function ($value) {
            return app()->getLocale() == 'ar' ? $this->title_ar : $this->title_en;
        });
    }

    public function description(): Attribute
    {
        return new Attribute(function ($value) {
            return app()->getLocale() == 'ar' ? $this->description_ar : $this->description_en;
        });
    }

    public function scopeTop($query)
    {
        return $query
            ->with('media', 'store')
            ->active()
            ->whereFeatured(true)
            ->latest()
            ->take(8);
    }
}
