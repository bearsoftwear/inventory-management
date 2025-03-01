<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth'])->group(function () {
    Volt::route('categories', 'pages.categories.index')->name('categories');
    Volt::route('customers', 'pages.customers.index')->name('customers');
    Volt::route('products', 'pages.products.index')->name('products');
    Volt::route('purchases', 'pages.purchases.index')->name('purchases');
    Volt::route('sales', 'pages.sales.index')->name('sales');
    Volt::route('suppliers', 'pages.suppliers.index')->name('suppliers');
    Volt::route('users', 'pages.users.index')->name('users');
});

require __DIR__ . '/auth.php';

// https://chatgpt.com/c/67b00cb2-fd48-800a-a98d-fa6142d44677
// DONE database
// DONE spatie setting
// DONE Category model crud
// DONE customer model crud
// todo learn about livewire volt
