<?php

use function Livewire\Volt\{with};

with(fn () => ['datas' => \App\Models\Category::all()]);

?>

<div>
    {{-- @dd($datas) --}}
    @foreach ($datas as $data)
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                <h1>{{ $data->name }}</h1>
            </div>
        </div>
    @endforeach
</div>
