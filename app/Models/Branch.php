<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use MatanYadaev\EloquentSpatial\Objects\Point;
use Mostafaznv\NovaMapField\Traits\HasSpatialColumns;

class Branch extends Model
{
    use HasFactory, HasSpatialColumns;

    protected $fillable = [
        'name_en',
        'name_ar',
        'address_en',
        'address_ar',
        'phone',
        'location',
        'store_id',
        'user_id',
        'covered_zone',
        'is_active',
    ];

    protected $casts = [
        'location' => Point::class,
    ];

    protected $appends = ['name', 'address'];

    public function name(): Attribute
    {
        return new Attribute(function () {
            return app()->getLocale() == 'ar' ? $this->name_ar : $this->name_en;
        });
    }

    public function address(): Attribute
    {
        return new Attribute(function () {
            return app()->getLocale() == 'ar' ? $this->address_ar : $this->address_en;
        });
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('in_stock');
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function scopeOrderByDistanceWithinCoveredZone($query, $point)
    {
        try {
            $latitude = explode(',', $point)[0];
            $longitude = explode(',', $point)[1];

            return $query->select('*', DB::raw("ST_Distance_Sphere(location, ST_GeomFromText('POINT($longitude $latitude)')) as distance"))
                ->selectRaw("covered_zone * 1000 as covered_zone_in_meters")
                ->havingRaw("distance <= covered_zone_in_meters")
                ->orderBy('distance');
        } catch (Exception $e) {
            return $query;
        }
    }
}
