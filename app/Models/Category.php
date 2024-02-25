<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_ar',
        'image_en',
        'image_ar',
        'parent_id',
        'order',
        'is_active',
    ];

    protected $appends = ['name'];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function name(): Attribute
    {
        return Attribute::make(get: function ($value) {
            return app()->getLocale() == 'ar' ? $this->name_ar : $this->name_en;
        });
    }

    public function image(): Attribute
    {
        return Attribute::make(get: function ($value) {
            return app()->getLocale() == 'ar' ? $this->image_ar : $this->image_en;
        });
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function scopeForHome(Builder $query)
    {
        return $query->when(request('children') == 1, fn($q) => $q->with('children'))
            ->active()
            ->whereNull('parent_id')
            ->orderBy('order');
    }
}
