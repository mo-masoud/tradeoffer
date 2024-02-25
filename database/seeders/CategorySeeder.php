<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name_en' => 'Hypermarket',
                'name_ar' => 'هايبر ماركت',
            ],
            [
                'name_en' => 'Electronics',
                'name_ar' => 'الإلكترونيات',
            ],
            [
                'name_en' => 'Restaurants & Sweets',
                'name_ar' => 'المطاعم والحلويات',
            ],
            [
                'name_en' => 'Housewares & kitchen supplies',
                'name_ar' => 'أدوات المنزل ولوازم المطبخ',
            ]
        ];

        foreach ($categories as $i => $category) {
            Category::updateOrCreate([
                'name_en' => $category['name_en'],
                'name_ar' => $category['name_ar'],
                'image_en' => $category['name_en'] . '.png',
                'image_ar' => $category['name_en'] . '.png',
                'order' => $i + 1,
            ]);
        }

        $electronics = Category::where('name_en', 'Electronics')->first();

        $electronics->children()->create([
            'name_en' => 'Mobiles & Tablets',
            'name_ar' => 'الهواتف المحمولة والأجهزة اللوحية',
            'image_en' => 'Mobiles & Tablets.png',
            'image_ar' => 'Mobiles & Tablets.png',
            'order' => 1
        ]);

        $electronics->children()->create([
            'name_en' => 'Laptops & Computers',
            'name_ar' => 'أجهزة الكمبيوتر المحمولة والكمبيوترات',
            'image_en' => 'Laptops & Computers.png',
            'image_ar' => 'Laptops & Computers.png',
            'order' => 2
        ]);

        $electronics->children()->create([
            'name_en' => 'Games & Consoles',
            'name_ar' => 'ألعاب الفيديو وأجهزة الألعاب',
            'image_en' => 'Laptops & Computers.png',
            'image_ar' => 'Laptops & Computers.png',
            'order' => 3
        ]);

        $hypermarket = Category::where('name_en', 'Hypermarket')->first();

        $hypermarket->children()->create([
            'name_en' => 'Butchery',
            'name_ar' => 'الجزارة',
            'image_en' => 'Butchery.png',
            'image_ar' => 'Butchery.png',
            'order' => 1
        ]);

        $hypermarket->children()->create([
            'name_en' => 'Food & Groceries',
            'name_ar' => 'الطعام والبقالة',
            'image_en' => 'Food & Groceries.png',
            'image_ar' => 'Food & Groceries.png',
            'order' => 2
        ]);
    }
}
