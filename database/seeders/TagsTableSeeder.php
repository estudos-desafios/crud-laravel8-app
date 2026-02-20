<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagsTableSeeder extends Seeder
{
    public function run()
    {
        $tags = [
            ['name' => 'Electronics'],
            ['name' => 'Mobile'],
            ['name' => 'Accessories'],
            ['name' => 'Computing'],
            ['name' => 'Audio'],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}
