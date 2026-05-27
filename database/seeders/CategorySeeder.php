<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $categories = ['Elektronik', 'Fashion', 'Kuliner', 'Otomotif', 'Kesehatan'];
    foreach ($categories as $cat) {
        \App\Models\Category::create([
            'name' => $cat,
            'description' => 'Kategori untuk produk ' . $cat
        ]);
    }
}
}
