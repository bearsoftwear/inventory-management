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
            $table->foreignId('product_id')->constrained()->cascadeOnDelete(); // product sold
            $table->string('customer'); // customer who bought the product
            $table->integer('quantity'); // quantity of the product
            $table->decimal('sell_price', 10, 2); // price of the product
            $table->timestamps(); // purchase_date
            $table->softDeletes(); // hidden timestamp for soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
