<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            for ($i = 1; $i <= 3; $i++) {

                Post::create([
                    'title' => $title,
                    'slug' => Str::slug($title),
                    'content' => 'This is testing purpose ',
                    'category_id' => $category->id,
                    'status' => $i % 2 === 0 ? 'draft' : 'published',
                    'thumbnail' => null,
                ]);
            }
        }
    }
}
