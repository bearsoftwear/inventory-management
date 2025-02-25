<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id'); // customer who bought the product
            $table->string('invoice_number'); // fixed typo
            $table->date('sale_date'); // date of the sale
            $table->decimal('total_amount', 10, 2); // total amount of the sale
            $table->timestamps(); // purchase_date
            $table->softDeletes(); // hidden timestamp for soft deletes
        });

        Schema::create('product_sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sales_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('quantity'); // quantity of the product sold
            $table->decimal('sale_price', 10, 2); // sale price of the product
            $table->timestamps(); // created_at, updated_at
            $table->softDeletes(); // hidden timestamp for soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
        Schema::dropIfExists('product_sales');
    }
};
