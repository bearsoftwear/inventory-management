<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    /** @use HasFactory<\Database\Factories\PurchaseFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'supplier_id',
        'invoice_number',
        'purchase_date',
        'total_amount',
    ];

    /*
    Purchases Record
    Purpose:

    Record when you acquire stock from a supplier.
    Increase the inventory levels.

    Additional fields (optional): Invoice number, payment terms, purchase order reference, etc.
    Business Logic:

    Stock Update: When a purchase record is created, the system increases the product’s stock.
    Reporting: Allows analysis of purchase costs, supplier performance, and trends in procurement.
    */
}
