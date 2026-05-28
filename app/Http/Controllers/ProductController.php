<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Query Lanjutan 1: 5 produk dengan harga tertinggi beserta nama kategorinya
        $top_products = Product::with('category')
            ->orderBy('price', 'desc')
            ->take(5)
            ->get();

        // Query Lanjutan 2: Jumlah produk per kategori
        $categories_with_count = Category::withCount('products')->get();

        // Query Lanjutan 3: Semua produk yang memiliki tag 'promo' dan stok > 0
        $promo_products = Product::whereHas('tags', function($query) {
            $query->where('name', 'promo');
        })->where('stock', '>', 0)->get();

        // Data statistik tambahan untuk dashboard
        $total_stock = Product::sum('stock');
        $avg_price = Product::avg('price');
        $products = Product::with(['category', 'tags'])->paginate(10);

        return view('admin.products.index', compact(
            'top_products', 
            'categories_with_count', 
            'promo_products', 
            'total_stock', 
            'avg_price',
            'products'
        ));
    }
}
