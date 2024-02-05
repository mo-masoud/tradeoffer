<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
