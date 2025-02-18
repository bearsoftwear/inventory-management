<?php

namespace App\Models\Pivot;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPurchase extends Pivot
{
    use SoftDeletes;

    protected $table = 'product_purchase';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'purchase_id',
        'product_id',
        'quantity',
        'cost_price',
    ];
}
