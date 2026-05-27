<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * JAWABAN PERTANYAAN DISKUSI (BAGIAN E):
 * 1. $fillable digunakan untuk mass assignment protection. Tanpa ini, user bisa memanipulasi kolom sensitif.
 * 2. hasMany() di model induk (1 ke banyak), belongsTo() di model anak (banyak ke 1) yang punya foreign key.
 * 3. Eager Loading (with()) menghindari N+1 query problem, meningkatkan performa.
 * 4. onDelete('cascade') menghapus data terkait di tabel anak saat data induknya dihapus.
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'stock',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
        'stock' => 'integer',
    ];

    /**
     * Relasi ke model Category (Many to One)
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi ke model Tag (Many to Many)
     */
    public function tags(): BelongsToMany
    {
        // Di sini kita langsung kunci nama kolomnya ke standar Laravel yang benar ('product_id' & 'tag_id')
        return $this->belongsToMany(Tag::class, 'product_tag', 'product_id', 'tag_id');
    }

    /**
     * Relasi ke model OrderItem (One to Many)
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}