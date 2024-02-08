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
                'name_en' => 'Butchery',
                'name_ar' => 'جزارة',
            ],
            [
                'name_en' => 'Bakery',
                'name_ar' => 'مخبز',
            ],
            [
                'name_en' => 'Pharmacy',
                'name_ar' => 'صيدلية',
            ],
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
        ];

        foreach ($categories as $i => $category) {
            Category::updateOrCreate([
                'name_en' => $category['name_en'],
                'name_ar' => $category['name_ar'],
                'image' => $category['name_en'] . '.png',
                'order' => $i + 1,
            ]);
        }

        $electronics = Category::where('name_en', 'Electronics')->first();

        $electronics->children()->create([
            'name_en' => 'Mobiles & Tablets',
            'name_ar' => 'الهواتف المحمولة والأجهزة اللوحية',
            'image' => 'Mobiles & Tablets.png',
            'order' => 1
        ]);
        $electronics->children()->create([
            'name_en' => 'Laptops & Computers',
            'name_ar' => 'أجهزة الكمبيوتر المحمولة والكمبيوترات',
            'image' => 'Laptops & Computers.png',
            'order' => 2
        ]);
    }
}
