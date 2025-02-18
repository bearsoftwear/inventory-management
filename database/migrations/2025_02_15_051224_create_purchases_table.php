<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained()->nullOnDelete(); // supplier of the product
            $table->string('invoice_number'); // invoice number of the product
            $table->date('purchase_date'); // date of the purchase
            $table->decimal('total_amount', 10, 2); // price of the product
            $table->timestamps();
            $table->softDeletes(); // hidden timestamp for soft deletes
        });

        Schema::create('product_purchase', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->integer('quantity')->default(1);
            $table->decimal('cost_price', 10, 2);
            $table->timestamps();
            $table->softDeletes(); // Adds the deleted_at column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
        Schema::dropIfExists('purchase_product');
    }
};
