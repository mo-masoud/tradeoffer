<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory;

    public static array $defaultRelations = [
        'items' => [
            'product' => [
                'media',
                'store',
                'categories.parent',
                'colors',
                'sizes',
                'offers',
                'attributes.attribute',
                'addons',
            ],
            'size',
            'color',
            'attributeValue' => [
                'attribute'
            ],
            'addons' => [
                'addon'
            ]
        ]
    ];
    protected $fillable = [
        'user_id',
        'total_price'
    ];

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
