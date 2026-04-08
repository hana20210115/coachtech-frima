<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories=['ファッション','家電','食品','生活雑貨','コスメ'];
        foreach ($categories as $category) {
            \App\Models\Category::create(['name' => $category]);
        }
    }
}   
