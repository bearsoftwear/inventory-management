<?php

namespace App\Models;

use App\Models\Pivot\CategoryProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)
                    ->using(CategoryProduct::class)
                    ->withPivot('deleted_at')
                    ->withTimestamps()
                    ->withTrashed(); // if you want to show the deleted products
    }
}
