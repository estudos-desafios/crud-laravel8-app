<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Tag;

class ProductTagTableSeeder extends Seeder
{
    public function run()
    {
        $laptop = Product::where('name', 'Laptop')->first();
        $smartphone = Product::where('name', 'Smartphone')->first();
        $tablet = Product::where('name', 'Tablet')->first();
        $headphones = Product::where('name', 'Headphones')->first();
        $keyboard = Product::where('name', 'Keyboard')->first();

        $electronics = Tag::where('name', 'Electronics')->first();
        $mobile = Tag::where('name', 'Mobile')->first();
        $accessories = Tag::where('name', 'Accessories')->first();
        $computing = Tag::where('name', 'Computing')->first();
        $audio = Tag::where('name', 'Audio')->first();

        $laptop->tags()->sync([$electronics->id, $computing->id]);
        $smartphone->tags()->sync([$electronics->id, $mobile->id]);
        $tablet->tags()->sync([$electronics->id, $mobile->id, $computing->id]);
        $headphones->tags()->sync([$electronics->id, $audio->id, $accessories->id]);
        $keyboard->tags()->sync([$computing->id, $accessories->id]);
    }
}
