<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create Admin
        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@luxury.com',
            'password' => Hash::make('password'),
        ]);

        // Create Categories
        $cat1 = Category::create([
            'name' => 'منظمات المكتب',
            'slug' => 'office-organizers',
            'is_active' => true,
        ]);

        $cat2 = Category::create([
            'name' => 'محطات الشحن',
            'slug' => 'charging-stations',
            'is_active' => true,
        ]);

        $cat3 = Category::create([
            'name' => 'اكسسوارات فاخرة',
            'slug' => 'luxury-accessories',
            'is_active' => true,
        ]);

        // Create Products
        Product::create([
            'category_id' => $cat1->id,
            'name' => 'منظم مكتب خشبي ملكي',
            'slug' => 'royal-wooden-organizer',
            'description' => 'منظم مكتب مصنوع من خشب الجوز الفاخر مع مساحات متعددة للأقلام والأوراق.',
            'price' => 250.00,
            'stock' => 10,
            'is_featured' => true,
        ]);

        Product::create([
            'category_id' => $cat2->id,
            'name' => 'محطة شحن خشبية ذكية',
            'slug' => 'smart-charging-station',
            'description' => 'محطة شحن لاسلكية مدمجة في قاعدة خشبية أنيقة تناسب جميع أنواع الهواتف.',
            'price' => 380.00,
            'stock' => 5,
            'is_featured' => true,
        ]);

        Product::create([
            'category_id' => $cat3->id,
            'name' => 'طقم أقلام خشب الصندل',
            'slug' => 'sandalwood-pen-set',
            'description' => 'طقم أقلام فاخر مصنوع يدوياً من خشب الصندل العطري في علبة خشبية مبطنة.',
            'price' => 120.00,
            'stock' => 20,
            'is_featured' => true,
        ]);

        // Create Dummy Orders
        Order::create([
            'order_number' => 'ORD-TEST1',
            'full_name' => 'سارة محمد',
            'phone_number' => '0551122334',
            'city' => 'الرياض',
            'address' => 'حي الملقا',
            'total_amount' => 630.00,
            'status' => 'completed',
        ]);

        Order::create([
            'order_number' => 'ORD-TEST2',
            'full_name' => 'فهد العتيبي',
            'phone_number' => '0566778899',
            'city' => 'جدة',
            'address' => 'حي الروضة',
            'total_amount' => 250.00,
            'status' => 'pending',
        ]);

        Order::create([
            'order_number' => 'ORD-TEST3',
            'full_name' => 'نورة القحطاني',
            'phone_number' => '0500112233',
            'city' => 'الدمام',
            'address' => 'حي الشاطئ',
            'total_amount' => 380.00,
            'status' => 'completed',
        ]);
    }
}
