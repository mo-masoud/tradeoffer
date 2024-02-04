<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::truncate();

        $categories = [
            [
                'name_en' => 'Food & Groceries',
                'name_ar' => 'الطعام والبقالة',
            ],
            [
                'name_en' => 'Electronics',
                'name_ar' => 'الإلكترونيات',
            ],
            [
                'name_en' => 'Fashion',
                'name_ar' => 'الموضة',
            ],
            [
                'name_en' => 'Health & Beauty',
                'name_ar' => 'الصحة والجمال',
            ],
            [
                'name_en' => 'Home & Lifestyle',
                'name_ar' => 'المنزل ونمط الحياة',
            ],
            [
                'name_en' => 'Kids & Babies',
                'name_ar' => 'الأطفال والرضع',
            ],
            [
                'name_en' => 'Books & Stationery',
                'name_ar' => 'الكتب والقرطاسية',
            ],
            [
                'name_en' => 'Sports & Outdoors',
                'name_ar' => 'الرياضة والهواء الطلق',
            ],
            [
                'name_en' => 'Automotive',
                'name_ar' => 'السيارات',
            ],
            [
                'name_en' => 'Pet Supplies',
                'name_ar' => 'لوازم الحيوانات الأليفة',
            ],
            [
                'name_en' => 'Hypermarket',
                'name_ar' => 'هايبر ماركت',
            ]
        ];

        foreach ($categories as $category) {
            Category::factory()->create([
                'name_en' => $category['name_en'],
                'name_ar' => $category['name_ar'],
            ]);
        }

        $electronics = Category::where('name_en', 'Electronics')->first();

        $electronics->children()->create([
            'name_en' => 'Mobiles & Tablets',
            'name_ar' => 'الهواتف المحمولة والأجهزة اللوحية',
            'image' => 'category.png'
        ]);
        $electronics->children()->create([
            'name_en' => 'Laptops & Computers',
            'name_ar' => 'أجهزة الكمبيوتر المحمولة والكمبيوترات',
            'image' => 'category.png'
        ]);
    }
}
