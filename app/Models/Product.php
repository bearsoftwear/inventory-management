<?php

namespace App\Models;

use App\Models\Pivot\CategoryProduct;
use App\Models\Pivot\ProductPurchase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'stock',
        'price',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class)
                    ->using(CategoryProduct::class)
                    ->withPivot('deleted_at')
                    ->withTimestamps()
                    ->withTrashed(); // if you want to show the deleted products
    }

    public function purchases()
    {
        return $this->belongsToMany(Purchase::class)
                    ->using(ProductPurchase::class)
                    ->withPivot('quantity', 'cost_price')
                    ->withTimestamps()
                    ->withTrashed(); // if you want to show the deleted products
    }
}


