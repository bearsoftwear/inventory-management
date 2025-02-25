<?php

namespace App\Models\Pivot;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductSales extends Pivot
{
    use SoftDeletes;

    protected $table = 'product_sales';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'sales_id',
        'product_id',
        'quantity',
        'sale_price',
    ];
}
