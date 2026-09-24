<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin Toko',
            'email' => 'admin@toko.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $buyer = User::create([
            'name' => 'Budi Pembeli',
            'email' => 'buyer@toko.test',
            'password' => Hash::make('password'),
            'role' => 'pembeli',
        ]);

        $sembako = Category::create(['name' => 'Sembako']);
        $minuman = Category::create(['name' => 'Minuman']);

        $products = [
            ['category_id' => $sembako->id, 'sku' => 'SKU-001', 'name' => 'Beras 5kg', 'price' => 65000, 'stock' => 40],
            ['category_id' => $sembako->id, 'sku' => 'SKU-002', 'name' => 'Minyak Goreng 1L', 'price' => 18000, 'stock' => 30],
            ['category_id' => $sembako->id, 'sku' => 'SKU-003', 'name' => 'Gula Pasir 1kg', 'price' => 14000, 'stock' => 4],
            ['category_id' => $minuman->id, 'sku' => 'SKU-004', 'name' => 'Air Mineral 600ml', 'price' => 3000, 'stock' => 100],
            ['category_id' => $minuman->id, 'sku' => 'SKU-005', 'name' => 'Teh Botol', 'price' => 5000, 'stock' => 2],
        ];

        foreach ($products as $p) {
            Product::create($p);
        }
    }
}
