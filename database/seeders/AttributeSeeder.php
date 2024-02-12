<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributes = [
            ['name_en' => 'Material', 'name_ar' => 'المادة'],
            ['name_en' => 'Gender', 'name_ar' => 'الجنس'],
            ['name_en' => 'Weight', 'name_ar' => 'الوزن'],
            ['name_en' => 'Dimensions', 'name_ar' => 'الأبعاد'],
            ['name_en' => 'Capacity', 'name_ar' => 'السعة'],
            ['name_en' => 'Volume', 'name_ar' => 'الحجم'],
            ['name_en' => 'Model', 'name_ar' => 'الموديل'],
            ['name_en' => 'Screen Size', 'name_ar' => 'حجم الشاشة'],
            ['name_en' => 'Storage Capacity', 'name_ar' => 'سعة التخزين'],
            ['name_en' => 'RAM', 'name_ar' => 'ذاكرة الوصول العشوائي'],
            ['name_en' => 'Processor Type', 'name_ar' => 'نوع المعالج'],
            ['name_en' => 'Operating System', 'name_ar' => 'نظام التشغيل'],
            ['name_en' => 'Battery Life', 'name_ar' => 'عمر البطارية'],
            ['name_en' => 'Fit', 'name_ar' => 'المقاس'],
            ['name_en' => 'Closure Type', 'name_ar' => 'نوع الإغلاق'],
            ['name_en' => 'Sleeve Length', 'name_ar' => 'طول الكم'],
            ['name_en' => 'Neckline Type', 'name_ar' => 'نوع الياقة'],
            ['name_en' => 'Pattern', 'name_ar' => 'النمط'],
            ['name_en' => 'Wattage', 'name_ar' => 'القوة الكهربائية'],
            ['name_en' => 'Scent', 'name_ar' => 'الرائحة'],
            ['name_en' => 'Skin Type', 'name_ar' => 'نوع البشرة'],
            ['name_en' => 'SPF', 'name_ar' => 'معامل الحماية من الشمس'],
        ];

        foreach ($attributes as $attribute) {
            Attribute::updateOrCreate($attribute);
        }
    }
}
