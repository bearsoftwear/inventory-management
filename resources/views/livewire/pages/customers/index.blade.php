<?php

use function Livewire\Volt\{state, layout, rules};

layout('layouts.app');

state([
    'customers' => \App\Models\Customer::withTrashed()->get(),
    'newCustomerName' => '',
    'newCustomerPhone' => '',
    'selectedCustomerId' => '',
    'editCustomerName' => '',
    'editCustomerPhone' => '',
]);

rules([
    'newCustomerName' => ['required', 'string'],
    'newCustomerPhone' => ['required', 'string', 'unique:'.\App\Models\Customer::class],
]);

$addCustomer = function (){
    $validated = $this->validate();
    \App\Models\Customer::create([
        'name' => $this->newCustomerName,
        'phone' => $this->newCustomerPhone
    ]);
    $this->customers = \App\Models\Customer::withTrashed()->get();
    $this->newCustomerName = '';
    $this->newCustomerPhone = '';
};

$editCustomer = function () {
    $validated = $this->validate([
        'editCustomerName' => ['required', 'string'],
        'editCustomerPhone' => ['required', 'string', 'unique:'.\App\Models\Customer::class.',phone,'.$this->selectedCustomerId],
    ]);
    $customer = \App\Models\Customer::find($this->selectedCustomerId);
    $customer->update([
        'name' => $this->editCustomerName,
        'phone' => $this->editCustomerPhone
    ]);
    $this->customers = \App\Models\Customer::withTrashed()->get();
    $this->editCustomerName = '';
    $this->editCustomerPhone = '';
    $this->selectedCustomerId = '';
    $this->dispatch('close-modal', 'edit-customer');
};

$deleteCustomer = function () { // Add this method
    $customer = \App\Models\Customer::find($this->selectedCustomerId);
    if ($customer) {
        $customer->delete();
        $this->customers = \App\Models\Customer::withTrashed()->get();
        $this->selectedCustomerId = '';
        $this->dispatch('close-modal', 'delete-customer');
        $this->dispatch('close-modal', 'edit-customer');
    }
};

?>

<div class="py-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <x-primary-button wire:click.prevent="$dispatch('open-modal', 'add-customer')">Add Customer</x-primary-button>
                <ul class="mt-4">
                    @foreach($customers as $customer)
                        <li class="flex justify-between items-center">
                            <span class="{{ $customer->trashed() ? 'line-through' : '' }}">
                                <a href="#" wire:click.prevent="$dispatch('open-modal', 'edit-customer'); $wire.set('selectedCustomerId', {{ $customer->id }}); $wire.set('editCustomerName', '{{ $customer->name }}'); $wire.set('editCustomerPhone', '{{ $customer->phone }}');"> {{ $customer->name }} === {{ $customer->phone }} </a>
                            </span>
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>

    {{-- Add Customer Modal --}}
    <x-modal name="add-customer">
        <form wire:submit="addCustomer" class="p-6">
            <h3 class="text-lg font-medium text-gray-900">
               Add new Customer
            </h3>
            <div class="mt-2">
                <x-text-input wire:model="newCustomerName" type="text" class="mt-1 block w-full" placeholder="Customer Name" />
                <x-input-error :messages="$errors->get('newCustomerName')" class="mt-2" />
            </div>

            <div class="mt-2">
                <x-text-input wire:model="newCustomerPhone" type="text" class="mt-1 block w-full" placeholder="Customer Phone" />
                <x-input-error :messages="$errors->get('newCustomerPhone')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ms-3">
                    {{ __('Save') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>

    {{-- Edit Customer Modal --}}
    <x-modal name="edit-customer">
        <form wire:submit="editCustomer" class="p-6">
            <h3 class="text-lg font-medium text-gray-900">
                Edit Customer
            </h3>
            <div class="mt-2">
                <x-text-input wire:model="editCustomerName" type="text" class="mt-1 block w-full" placeholder="Customer Name" />
                <x-input-error :messages="$errors->get('newCustomerName')" class="mt-2" />
            </div>

            <div class="mt-2">
                <x-text-input wire:model="editCustomerPhone" type="text" class="mt-1 block w-full" placeholder="Customer Phone" />
                <x-input-error :messages="$errors->get('newCustomerPhone')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-danger-button class="ms-3" wire:click.prevent="$dispatch('open-modal', 'delete-customer');">
                    {{ __('Delete') }}
                </x-danger-button>

                <x-secondary-button x-on:click="$dispatch('close')" class="ms-3">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ms-3">
                    {{ __('Save') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>

    {{-- Delete Customer Modal --}}
    <x-modal name="delete-customer">
        <form wire:submit="deleteCustomer" class="p-6">
            <h3 class="text-lg font-medium text-gray-900">
                Delete Customer
            </h3>
            <div class="mt-2">
                <p>Are you sure you want to delete this customer? This action cannot be undone.</p>
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')" class="ms-3">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Delete') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>

</div>

