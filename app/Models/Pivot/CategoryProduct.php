<?php

namespace App\Models\Pivot;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryProduct extends Pivot
{
    use SoftDeletes;

    protected $table = 'category_product';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'category_id',
        'product_id',
    ];
}
