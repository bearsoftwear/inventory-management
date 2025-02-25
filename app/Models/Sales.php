<?php

namespace App\Models;

use App\Models\Pivot\ProductSales;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sales extends Model
{
    /** @use HasFactory<\Database\Factories\SalesFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'invoice_number',
        'sale_date',
        'total_amount',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)
                    ->using(ProductSales::class)
                    ->withPivot('quantity', 'sale_price')
                    ->withTimestamps()
                    ->withTrashed(); // if you want to show the deleted products
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /*
    Sales Record
    Purpose:

    Record when you sell stock to a customer.
    Decrease the inventory levels.
    Key Attributes:

    product_id: References the product being sold.
    customer: Identifies the buyer or customer.
    quantity: Number of items sold.
    sale_price: Selling price per unit.
    sale_date (created_at): Timestamp when the sale occurred.
    Additional fields (optional): Invoice number, payment method, discount, etc.
    Business Logic:

    Stock Update: When a sales record is created, the system decreases the product’s stock.
    Reporting: Enables analysis of revenue, profit margins, sales trends, and customer behavior.
    */
}
