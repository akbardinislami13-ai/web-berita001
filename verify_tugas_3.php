<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;

echo "--- JAWABAN TUGAS 3: QUERY ELOQUENT LANJUTAN ---\n\n";

// 1. Tampilkan 5 produk dengan harga tertinggi beserta nama kategorinya
echo "1. 5 Produk dengan harga tertinggi:\n";
$highestPriceProducts = Product::with('category')
    ->orderBy('price', 'desc')
    ->take(5)
    ->get();

foreach ($highestPriceProducts as $p) {
    echo "- Name: {$p->name} | Price: " . number_format($p->price) . " | Category: {$p->category->name}\n";
}
echo "\n";

// 2. Tampilkan jumlah produk per kategori
echo "2. Jumlah produk per kategori:\n";
$categoryCounts = Category::withCount('products')->get();
foreach ($categoryCounts as $c) {
    echo "- Category: {$c->name} | Total Products: {$c->products_count}\n";
}
echo "\n";

// 3. Tampilkan semua produk yang memiliki tag 'promo' dan stok > 0
echo "3. Produk dengan tag 'promo' dan stok > 0:\n";
$promoProducts = Product::whereHas('tags', function($query) {
    $query->where('name', 'promo');
})->where('stock', '>', 0)->get();

if ($promoProducts->isEmpty()) {
    echo "Tidak ada produk dengan tag 'promo' dan stok > 0.\n";
} else {
    foreach ($promoProducts as $p) {
        echo "- Name: {$p->name} | Stock: {$p->stock} | Tags: " . $p->tags->pluck('name')->implode(', ') . "\n";
    }
}

echo "\n--- SELESAI ---\n";
