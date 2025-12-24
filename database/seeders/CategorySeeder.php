<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // dd('CategorySeeder is running');
        $categories = [
            'Jelly',
            'Fluffy',
            'Truffle Chocolates',
            'Honey',
            'Stone & Gemes Chocolate',
            'Fruit Bars',
            'Fruit Filling Chocolates',
            'Tea',
            'Essential Oils',
            'Massage Oils',
            'Rose Water',
            'Cosmetics',
            'Premium Chocolates',
            'Health Products',
        ];

        foreach ($categories as $name) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'is_active' => true,
            ]);
        }
    }
}
