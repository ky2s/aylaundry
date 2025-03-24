<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('services')->insert([
            [
                'service_name' => 'Cuci Kering',
                'description' => 'Layanan cuci dan kering lengkap.',
                'price_per_kg' => 15000,
                'price_per_item' => null,
                'estimated_time' => 24,
                'category_id' => 1,
                'is_active' => true,
                'image_url' => 'https://example.com/images/cuci-kering.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'service_name' => 'Setrika Saja',
                'description' => 'Hanya setrika pakaian.',
                'price_per_kg' => 8000,
                'price_per_item' => null,
                'estimated_time' => 12,
                'category_id' => 1,
                'is_active' => true,
                'image_url' => 'https://example.com/images/setrika.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'service_name' => 'Cuci Sepatu',
                'description' => 'Layanan khusus cuci sepatu.',
                'price_per_kg' => null,
                'price_per_item' => 25000,
                'estimated_time' => 48,
                'category_id' => 2,
                'is_active' => true,
                'image_url' => 'https://example.com/images/cuci-sepatu.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
