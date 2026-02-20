<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        $products = [
            ['name' => 'Laptop'],
            ['name' => 'Smartphone'],
            ['name' => 'Tablet'],
            ['name' => 'Headphones'],
            ['name' => 'Keyboard'],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
