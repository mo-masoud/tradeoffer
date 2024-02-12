<?php

namespace Database\Seeders;

use App\Models\Offer;
use App\Models\Store;
use Illuminate\Database\Seeder;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $offers = [
            [
                'store_id' => 1,
                'title_en' => 'Buy 1 Get 1 Free',
                'title_ar' => 'اشتري 1 واحصل على 1 مجاناً',
                'description_en' => 'Buy 1 Get 1 Free on all products',
                'description_ar' => 'اشتري 1 واحصل على 1 مجاناً على جميع المنتجات',
                'discount' => 20,
                'max_discount' => 100,
                'start_at' => now(),
                'end_at' => now()->addDays(7),
                'featured' => true,
            ],
            [
                'store_id' => 2,
                'title_en' => '50% Off',
                'title_ar' => 'خصم 50%',
                'description_en' => '50% Off on all products',
                'description_ar' => 'خصم 50% على جميع المنتجات',
                'discount' => 50,
                'max_discount' => 100,
                'start_at' => now(),
                'end_at' => now()->addDays(7),
                'featured' => true,
            ],
            [
                'store_id' => 3,
                'title_en' => '30% Off',
                'title_ar' => 'خصم 30%',
                'description_en' => '30% Off on all products',
                'description_ar' => 'خصم 30% على جميع المنتجات',
                'discount' => 30,
                'max_discount' => 0,
                'start_at' => now(),
                'end_at' => now()->addDays(7),
                'featured' => true,
            ],
            [
                'store_id' => 4,
                'title_en' => 'Buy 2 Get 1 Free',
                'title_ar' => 'اشتري 2 واحصل على 1 مجاناً',
                'description_en' => 'Buy 2 Get 1 Free on all products',
                'description_ar' => 'اشتري 2 واحصل على 1 مجاناً على جميع المنتجات',
                'discount' => 0,
                'max_discount' => 0,
                'start_at' => now(),
                'end_at' => now()->addDays(7),
                'featured' => true,
            ]
        ];

        foreach ($offers as $offer) {
            $offerModel = Offer::updateOrCreate([
                'title_en' => $offer['title_en'],
                'title_ar' => $offer['title_ar'],
            ], $offer);

            // attach images
            $offerModel->addMedia(storage_path("app/public/offer.png"))
                ->preservingOriginal()
                ->toMediaCollection('images');

            $store = Store::with('products', 'branches')->find($offer['store_id']);
            $offerModel->products()->attach($store->products->pluck('id')->toArray());
            $offerModel->branches()->attach($store->branches->pluck('id')->toArray());
        }
    }
}
