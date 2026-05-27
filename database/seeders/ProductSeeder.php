<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $faker = \Faker\Factory::create('id_ID'); // Menggunakan format data Indonesia
    $categories = \App\Models\Category::all();
    $tags = \App\Models\Tag::all();

    // Loop untuk membuat 20 produk secara otomatis
    for ($i = 1; $i <= 20; $i++) {
        $product = \App\Models\Product::create([
            'category_id' => $categories->random()->id, // Mengambil ID kategori acak dari 5 kategori
            'name' => 'Produk ' . $faker->words(2, true),
            'description' => $faker->sentence(),
            'price' => rand(5000, 500000), // Harga acak antara 5rb sampai 500rb
            'stock' => rand(1, 50),        // Stok acak antara 1 sampai 50
            'is_active' => true,
        ]);

        // Hubungkan ke tag secara random (mengambil 1 sampai 3 tag acak untuk tiap produk)
        $randomTags = $tags->random(rand(1, 3))->pluck('id');
        $product->tags()->attach($randomTags);
    }
}
}
