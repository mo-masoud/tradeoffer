<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductAddon;
use App\Models\Size;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Seeder;
use MatanYadaev\EloquentSpatial\Objects\Point;

class StoreBranchesAndProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stores = [
            [
                'name_en' => 'SigmaTech',
                'name_ar' => 'سيجما تك',
                'description_en' => 'SigmaTech is a electronics store that sells all kinds of electronics and gadgets.',
                'description_ar' => 'سيجما تك هو متجر إلكترونيات يبيع جميع أنواع الإلكترونيات والأجهزة.',
                'products' => [
                    [
                        'name_en' => 'HAVIT HV-G92 Gamepad',
                        'name_ar' => 'هافيت HV-G92 جيم باد',
                        'description_en' => 'HAVIT HV-G92 Gamepad is a gamepad that is compatible with PC and PS3.',
                        'description_ar' => 'هافيت HV-G92 جيم باد هو جيم باد متوافق مع الكمبيوتر و PS3.',
                        'price' => 15.99,
                        'discount' => 0,
                        'category' => 'Games & Consoles',
                        'meta' => [
                            'brand' => 'HAVIT',
                            'model' => 'HV-G92',
                            'compatibility' => 'PC, PS3',
                        ],
                        'images' => [
                            'HAVIT HV-G92 Gamepad.png',
                            'HAVIT HV-G92 Gamepad 2.png',
                            'HAVIT HV-G92 Gamepad 3.png',
                        ],
                        'sizes' => [],
                        'colors' => [
                            '#000000' => [
                                'extra_price' => 0.99,
                                'in_stock' => true,
                            ],
                            '#FFFFFF' => [],
                            '#FF0000' => [
                                'extra_price' => 1.99,
                                'in_stock' => true,
                            ],
                            '#00FF00' => [
                                'extra_price' => 1.99,
                                'in_stock' => true,
                            ]
                        ]
                    ],
                    [
                        'name_en' => 'AK-900 Wired Keyboard',
                        'name_ar' => 'أيه كيه-900 لوحة مفاتيح سلكية',
                        'description_en' => 'AK-900 Wired Keyboard is a wired keyboard that is compatible with PC and Laptops.',
                        'description_ar' => 'أيه كيه-900 لوحة مفاتيح سلكية هي لوحة مفاتيح سلكية متوافقة مع الكمبيوتر والكمبيوتر المحمول.',
                        'price' => 9.99,
                        'discount' => 0,
                        'category' => 'Laptops & Computers',
                        'meta' => [
                            'brand' => 'AK',
                            'model' => '900',
                            'compatibility' => 'PC, Laptops',
                        ],
                        'sizes' => [],
                        'images' => [
                            'AK-900 Wired Keyboard.png'
                        ],
                        'colors' => []
                    ],
                    [
                        'name_en' => 'IPS LCD Gaming Monitor',
                        'name_ar' => 'شاشة العرض للألعاب IPS LCD',
                        'description_en' => 'IPS LCD Gaming Monitor is a 24-inch gaming monitor with 144Hz refresh rate.',
                        'description_ar' => 'شاشة العرض للألعاب IPS LCD هي شاشة عرض ألعاب بحجم 24 بوصة بمعدل تحديث 144 هرتز.',
                        'price' => 199.99,
                        'discount' => 0,
                        'category' => 'Laptops & Computers',
                        'meta' => [
                            'brand' => 'IPS',
                            'model' => 'LCD Gaming Monitor',
                            'size' => '24-inch',
                            'refresh_rate' => '144Hz',
                        ],
                        'sizes' => [],
                        'images' => [
                            'IPS LCD Gaming Monitor.png'
                        ],
                        'colors' => []
                    ],
                    [
                        'name_en' => 'RGB liquid CPU Cooler',
                        'name_ar' => 'مبرد سائل لوحدة المعالجة المركزية RGB',
                        'description_en' => 'RGB liquid CPU Cooler is a liquid cooler for CPU with RGB lighting.',
                        'description_ar' => 'مبرد سائل لوحدة المعالجة المركزية RGB هو مبرد سائل لوحدة المعالجة المركزية مع إضاءة RGB.',
                        'price' => 79.99,
                        'discount' => 0,
                        'category' => 'Laptops & Computers',
                        'meta' => [
                            'brand' => 'RGB',
                            'model' => 'liquid CPU Cooler',
                            'lighting' => 'RGB',
                        ],
                        'sizes' => [],
                        'images' => [
                            'RGB liquid CPU Cooler.png'
                        ],
                        'colors' => []
                    ],
                    [
                        'name_en' => 'CANON EOS DSLR Camera',
                        'name_ar' => 'كاميرا CANON EOS DSLR',
                        'description_en' => 'CANON EOS DSLR Camera is a professional camera with 24.1MP sensor.',
                        'description_ar' => 'كاميرا CANON EOS DSLR هي كاميرا احترافية بمستشعر 24.1 ميجابكسل.',
                        'price' => 499.99,
                        'discount' => 0,
                        'category' => 'Laptops & Computers',
                        'meta' => [
                            'brand' => 'CANON',
                            'model' => 'EOS DSLR Camera',
                            'sensor' => '24.1MP',
                        ],
                        'sizes' => [],
                        'images' => [
                            'CANON EOS DSLR Camera.png'
                        ],
                        'colors' => []
                    ],
                    [
                        'name_en' => 'ASUS FHD Gaming Laptop',
                        'name_ar' => 'كمبيوتر محمول للألعاب ASUS FHD',
                        'description_en' => 'ASUS FHD Gaming Laptop is a 15.6-inch or 17.3 gaming laptop with 8GB RAM and 512GB SSD.',
                        'description_ar' => 'كمبيوتر محمول للألعاب ASUS FHD هو كمبيوتر محمول للألعاب بحجم 15.6 بوصة او 17.3 مع 8 جيجابايت من ذاكرة الوصول العشوائي و 512 جيجابايت من وحدة التخزين الصلبة.',
                        'price' => 899.99,
                        'discount' => 0,
                        'category' => 'Laptops & Computers',
                        'meta' => [
                            'brand' => 'ASUS',
                            'model' => 'FHD Gaming Laptop',
                            'ram' => '8GB',
                            'storage' => '512GB SSD',
                        ],
                        'sizes' => [
                            '15.6' => [],
                            '17.3' => [
                                'extra_price' => 100,
                                'in_stock' => true,
                            ],
                        ],
                        'images' => [
                            'ASUS FHD Gaming Laptop.png'
                        ],
                        'colors' => []
                    ],
                    [
                        'name_en' => 'GP11 Shooter USB Gamepad',
                        'name_ar' => 'GP11 شوتر جيم باد USB',
                        'description_en' => 'GP11 Shooter USB Gamepad is a gamepad that is compatible with PC and PS4.',
                        'description_ar' => 'GP11 شوتر جيم باد USB هو جيم باد متوافق مع الكمبيوتر و PS4.',
                        'price' => 19.99,
                        'discount' => 0,
                        'category' => 'Games & Consoles',
                        'meta' => [
                            'brand' => 'GP11',
                            'model' => 'Shooter USB Gamepad',
                            'compatibility' => 'PC, PS4',
                        ],
                        'sizes' => [],
                        'images' => [
                            'GP11 Shooter USB Gamepad.png'
                        ],
                        'colors' => [
                            '#000000' => [],
                            '#FFFFFF' => [],
                            '#FF0000' => [
                                'extra_price' => 1.99,
                                'in_stock' => true,
                            ],
                            '#00FF00' => [
                                'extra_price' => 1.99,
                                'in_stock' => true,
                            ]
                        ],
                    ],
                    [
                        'name_en' => 'PlayStation 5',
                        'name_ar' => 'بلايستيشن 5',
                        'description_en' => 'PlayStation 5 is a gaming console with 8K support and 3D audio.',
                        'description_ar' => 'بلايستيشن 5 هو جهاز ألعاب بدعم 8K وصوت ثلاثي الأبعاد.',
                        'price' => 499.99,
                        'discount' => 0,
                        'category' => 'Games & Consoles',
                        'meta' => [
                            'brand' => 'Sony',
                            'models' => 'slim / pro',
                        ],
                        'sizes' => [],
                        'images' => [
                            'PlayStation 5.png'
                        ],
                        'colors' => [
                            '#000000' => [],
                            '#FFFFFF' => [],
                        ],
                    ]
                ],
                'branches' => [
                    [
                        'name_en' => 'SigmaTech - Amman - 1st Circle',
                        'name_ar' => 'سيجما تك - عمان - الدوار الأول',
                        'address_en' => '1st Circle, Amman, Jordan',
                        'address_ar' => 'الدوار الأول، عمان، الأردن',
                        'phone' => '+962 6 464 2266',
                        'location' => new Point(31.9513, 35.9336),
                        'covered_zone' => 7,
                        'with_manager' => true,
                    ],
                    [
                        'name_en' => 'SigmaTech - Amman - 7th Circle',
                        'name_ar' => 'سيجما تك - عمان - الدوار السابع',
                        'address_en' => '7th Circle, Amman, Jordan',
                        'address_ar' => 'الدوار السابع، عمان، الأردن',
                        'phone' => '+962 6 464 2266',
                        'location' => new Point(31.9513, 35.9336),
                        'covered_zone' => 7,
                        'with_manager' => true,
                    ],
                ],
            ],
            [
                'name_en' => 'Ragab\'s Sons',
                'name_ar' => 'اولاد رجب',
                'description_en' => 'Ragab\'s Sons is hypermarket that sells all kinds of groceries, food and furniture.',
                'description_ar' => 'اولاد رجب هو هايبر ماركت يبيع جميع أنواع البقالة والطعام والأثاث.',
                'products' => [
                    [
                        'name_en' => 'Fresh Chicken',
                        'name_ar' => 'دجاج طازج',
                        'description_en' => 'Fresh Chicken is a whole chicken that is fresh and ready to cook.',
                        'description_ar' => 'الدجاج الطازج هو دجاج كامل طازج وجاهز للطهي.',
                        'price' => 3.99,
                        'discount' => 0,
                        'category' => 'Butchery',
                        'meta' => [
                            'type' => 'Whole Chicken',
                            'freshness' => 'Fresh',
                        ],
                        'sizes' => [],
                        'images' => [
                            'Fresh Chicken.png'
                        ],
                        'colors' => []
                    ],
                    [
                        'name_en' => 'Breed Dry Dog Food',
                        'name_ar' => 'طعام كلاب جاف بريد',
                        'description_en' => 'Breed Dry Dog Food is a dry food for dogs with different flavors.',
                        'description_ar' => 'طعام كلاب جاف بريد هو طعام جاف للكلاب بنكهات مختلفة.',
                        'price' => 19.99,
                        'discount' => 0,
                        'category' => 'Food & Groceries',
                        'meta' => [
                            'type' => 'Dry Food',
                            'flavors' => 'Chicken / Beef / Lamb',
                        ],
                        'sizes' => [],
                        'images' => [
                            'Breed Dry Dog Food.png',
                        ],
                        'colors' => [],
                    ],
                    [
                        'name_en' => 'Chicken Burger',
                        'name_ar' => 'برجر الدجاج',
                        'description_en' => 'Chicken Burger is a burger made of chicken meat with lettuce and mayonnaise.',
                        'description_ar' => 'برجر الدجاج هو برجر مصنوع من لحم الدجاج مع الخس والمايونيز.',
                        'price' => 2.99,
                        'discount' => 0,
                        'category' => 'Food & Groceries',
                        'meta' => [],
                        'sizes' => [
                            'Small' => [],
                            'Medium' => [],
                            'Large' => [
                                'extra_price' => 1,
                                'in_stock' => true,
                            ],
                        ],
                        'images' => [
                            'Chicken Burger.jpg',
                        ],
                        'colors' => [],
                        'addons' => [
                            [
                                'name_en' => 'Cheese',
                                'name_ar' => 'جبن',
                                'image' => 'Cheese.jpg',
                                'price' => 0.5,
                                'in_stock' => true,
                            ],
                            [
                                'name_en' => 'Fries',
                                'name_ar' => 'بطاطا مقلية',
                                'image' => 'Fries.jpg',
                                'price' => 1.5,
                                'in_stock' => true,
                            ],
                            [
                                'name_en' => 'Spiro Spathis',
                                'name_ar' => 'سبايرو سباثيس',
                                'image' => 'Spiro Spathis.jpg',
                                'price' => 2,
                                'in_stock' => true,
                            ]
                        ],
                    ],
                ],
                'branches' => [
                    [
                        'name_en' => 'Ragab\'s Sons - Amman - Abu Nseir',
                        'name_ar' => 'اولاد رجب - عمان - أبو نصير',
                        'address_en' => 'Abu Nseir, Amman, Jordan',
                        'address_ar' => 'أبو نصير، عمان، الأردن',
                        'phone' => '+962 6 464 2266',
                        'location' => new Point(31.9513, 35.9336),
                        'with_manager' => false,
                    ],
                    [
                        'name_en' => 'Ragab\'s Sons - Amman - Al-Weibdeh',
                        'name_ar' => 'اولاد رجب - عمان - الويبده',
                        'address_en' => 'Al-Weibdeh, Amman, Jordan',
                        'address_ar' => 'الويبده، عمان، الأردن',
                        'phone' => '+962 6 464 2266',
                        'location' => new Point(31.9513, 35.9336),
                        'with_manager' => false,
                    ]
                ],
            ],
        ];

        $categories = Category::all();

        $i = 1;
        array_map(function ($store) use (&$i, $categories) {
            // create store manager
            $user = User::factory()->create([
                'name' => $store['name_en'] . " Manager",
                'email' => strtolower($store['name_en']) . "@manager.com",
            ]);

            $user->assignRole(RoleEnum::StoreManager->value);

            // Create store
            $storeModel = Store::updateOrCreate([
                'name_en' => $store['name_en'],
                'name_ar' => $store['name_ar'],
            ], [
                'description_en' => $store['description_en'],
                'description_ar' => $store['description_ar'],
                'image' => "store$i.png",
                'user_id' => $user->id,
            ]);

            $productsIds = [];
            // Create products
            foreach ($store['products'] as $product) {
                $productModel = Product::updateOrCreate([
                    'name_en' => $product['name_en'],
                    'name_ar' => $product['name_ar'],
                ], [
                    'description_en' => $product['description_en'],
                    'description_ar' => $product['description_ar'],
                    'price' => $product['price'],
                    'meta' => $product['meta'],
                    'discount' => $product['discount'],
                    'store_id' => $storeModel->id,
                ]);

                $productModel->categories()->attach($categories->where('name_en', $product['category'])->first()->id);

                $productsIds[] = $productModel->id;

                foreach ($product['images'] as $image) {
                    $productModel->addMedia(storage_path("app/public/$image"))
                        ->preservingOriginal()
                        ->toMediaCollection('images');
                }

                foreach ($product['sizes'] as $size => $sizeData) {
                    $sizeModel = Size::updateOrCreate([
                        'size' => $size,
                    ]);

                    $productModel->sizes()->attach($sizeModel->id, [
                        'extra_price' => $sizeData['extra_price'] ?? 0,
                        'in_stock' => $sizeData['in_stock'] ?? true,
                    ]);
                }

                foreach ($product['colors'] as $color => $colorData) {
                    $colorModel = Color::updateOrCreate([
                        'color' => $color,
                    ]);

                    $productModel->colors()->attach($colorModel->id, [
                        'extra_price' => $colorData['extra_price'] ?? 0,
                        'in_stock' => $colorData['in_stock'] ?? true,
                    ]);
                }

                if (isset($product['addons'])) {
                    foreach ($product['addons'] as $addon) {
                        ProductAddon::updateOrCreate([
                            'name_en' => $addon['name_en'],
                            'name_ar' => $addon['name_ar'],
                            'product_id' => $productModel->id,
                        ], [
                            'image' => $addon['image'],
                            'price' => $addon['price'],
                            'in_stock' => $addon['in_stock'],
                        ]);
                    }
                }
            }

            // Create branches
            foreach ($store['branches'] as $branch) {
                if ($branch['with_manager']) {
                    $branchManager = User::factory()->create([
                        'name' => $branch['name_en'] . " Manager",
                        'email' => strtolower($branch['name_en']) . "@manager.com",
                    ]);
                    $branchManager->assignRole(RoleEnum::BranchManager->value);
                }

                // Create branch
                $branchModel = Branch::updateOrCreate([
                    'name_en' => $branch['name_en'],
                    'name_ar' => $branch['name_ar'],
                    'store_id' => $storeModel->id,
                ], [
                    'address_en' => $branch['address_en'],
                    'address_ar' => $branch['address_ar'],
                    'phone' => $branch['phone'],
                    'location' => $branch['location'],
                    'covered_zone' => $branch['covered_zone'] ?? 7,
                    'user_id' => $branchManager->id ?? null,
                ]);

                if (count($productsIds) > 0) {
                    $branchModel->products()->attach($productsIds, [
                        'in_stock' => true,
                    ]);
                }
            }

            $i++;
        }, $stores);
    }
}
