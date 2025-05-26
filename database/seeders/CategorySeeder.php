<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Laravel', 'PHP', 'VueJS', 'JavaScript', 'MySQL'];

        foreach ($categories as $title) {
            Category::create([
                'title' => $title,
                'slug' => Str::slug($title),
            ]);
        }
    }
}
