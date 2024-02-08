<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Branch;
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
                'description_en' => 'Ragab\'s Sons is grocery store that sells all kinds of groceries and food.',
                'description_ar' => 'اولاد رجب هو متجر بقالة يبيع جميع أنواع البقالة والطعام.',
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
                [
                    'name_en' => 'Roma',
                    'name_ar' => 'روما',
                    'description_en' => 'Roma is a clothing store that sells all kinds of clothes and accessories.',
                    'description_ar' => 'روما هو متجر ملابس يبيع جميع أنواع الملابس والاكسسوارات.',
                    'branches' => [
                        [
                            'name_en' => 'Roma - Amman - Abdoun',
                            'name_ar' => 'روما - عمان - عبدون',
                            'address_en' => 'Abdoun, Amman, Jordan',
                            'address_ar' => 'عبدون، عمان، الأردن',
                            'phone' => '+962 6 464 2266',
                            'location' => new Point(31.9513, 35.9336),
                            'with_manager' => true,
                        ],
                        [
                            'name_en' => 'Roma - Amman - Al-Swefieh',
                            'name_ar' => 'روما - عمان - الصويفية',
                            'address_en' => 'Al-Swefieh, Amman, Jordan',
                            'address_ar' => 'الصويفية، عمان، الأردن',
                            'phone' => '+962 6 464 2266',
                            'location' => new Point(31.9513, 35.9336),
                            'with_manager' => true,
                        ],
                    ],
                ],
            ],
            [
                'name_en' => 'Al-Madina',
                'name_ar' => 'المدينة',
                'description_en' => 'Al-Madina is a grocery store that sells all kinds of groceries and food.',
                'description_ar' => 'المدينة هو متجر بقالة يبيع جميع أنواع البقالة والطعام.',
                'branches' => [
                    [
                        'name_en' => 'Al-Madina - Amman - Al-Weibdeh',
                        'name_ar' => 'المدينة - عمان - الويبده',
                        'address_en' => 'Al-Weibdeh, Amman, Jordan',
                        'address_ar' => 'الويبده، عمان، الأردن',
                        'phone' => '+962 6 464 2266',
                        'location' => new Point(31.9513, 35.9336),
                        'with_manager' => false,
                    ],
                ],
            ]
        ];

        // Create stores and branches
        foreach ($stores as $i => $store) {
            // create store manager
            $user = User::factory()->create([
                'name' => $store['name_en'] . " Manager",
                'email' => strtolower($store['name_en']) . "@manager.com",
            ]);

            $user->assignRole(RoleEnum::StoreManager->value);

            $storeModel = Store::updateOrCreate([
                'name_en' => $store['name_en'],
                'name_ar' => $store['name_ar'],
            ], [
                'description_en' => $store['description_en'],
                'description_ar' => $store['description_ar'],
                'image' => 'store' . ($i + 1) . '.png',
                'user_id' => $user->id,
            ]);

            foreach ($store['branches'] as $branch) {

                if ($branch['with_manager']) {
                    $branchManager = User::factory()->create([
                        'name' => $branch['name_en'] . " Manager",
                        'email' => strtolower($branch['name_en']) . "@manager.com",
                    ]);
                    $branchManager->assignRole(RoleEnum::BranchManager->value);
                }

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

                $branchManager = null;
            }
        }
    }
}
