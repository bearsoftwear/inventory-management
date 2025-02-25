<?php

namespace Database\Seeders;

use App\Models\Purchase;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier; // add Supplier model
use App\Models\Sales; // add Sales model
use App\Models\Customer; // add Customer model
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    protected static ?string $password;
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Bear Softwear',
            'email' => 'bearsoftwear@gmail.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        $categories = Category::factory(10)->create();
        $products = Product::factory(50)->create();
        $products->each(function ($product) use ($categories) {
            $product->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        $suppliers = Supplier::factory(10)->create(); // call SupplierFactory
        $purchases = Purchase::factory(10)->create();
        $purchases->each(function ($purchase) use ($products) {
            $purchase->products()->attach(
                $products->random(rand(5, 15))->pluck('id')->toArray(),
                ['quantity' => rand(1, 15), 'cost_price' => rand(100, 1000)]
            );
        });

        $customers = Customer::factory(10)->create(); // call CustomerFactory
        $sales = Sales::factory(10)->create();
        $sales->each(function ($sale) use ($products) {
            $sale->products()->attach(
                $products->random(rand(5, 15))->pluck('id')->toArray(),
                ['quantity' => rand(1, 15), 'sale_price' => rand(100, 1000)]
            );
        });
    }
}
