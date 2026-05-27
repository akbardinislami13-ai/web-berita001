<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;

echo "--- Verifikasi Database & Relationship ---\n";

// 1. Cek Kategori & Produk
$category = Category::first();
echo "Kategori: " . $category->name . "\n";
echo "Jumlah Produk di Kategori ini: " . $category->products->count() . "\n";

// 2. Cek Produk & Kategori (BelongsTo)
$product = Product::first();
echo "Produk: " . $product->name . "\n";
echo "Kategori Produk ini: " . $product->category->name . "\n";

// 3. Cek Many to Many (Product & Tag)
echo "Tags Produk ini: " . $product->tags->pluck('name')->implode(', ') . "\n";

// 4. Cek Order & User
$user = User::first();
$order = Order::create([
    'user_id' => $user->id,
    'total_price' => 100000,
    'status' => 'pending'
]);
echo "Order created for user: " . $order->user->name . "\n";

// 5. Cek OrderItem
$orderItem = OrderItem::create([
    'order_id' => $order->id,
    'product_id' => $product->id,
    'quantity' => 2,
    'price' => $product->price
]);
echo "OrderItem created for product: " . $orderItem->product->name . " in order ID: " . $orderItem->order->id . "\n";

echo "--- Verifikasi Selesai ---\n";
