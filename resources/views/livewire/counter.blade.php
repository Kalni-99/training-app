<?php

use Livewire\Volt\Component;

new class extends Component {
    public $count = 0;

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }
};

?>

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">⚡ Volt Counter</h3>
            <div class="text-4xl font-bold text-blue-600">{{ $count }}</div>
        </div>
        
        <div class="flex gap-4 mt-4">
            <button wire:click="increment" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-lg transition">
                + Increment
            </button>
            <button wire:click="decrement" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded-lg transition">
                - Decrement
            </button>
        </div>
    </div>
</div>