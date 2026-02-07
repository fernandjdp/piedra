<?php

use Livewire\Component;
use Livewire\Attributes\Reactive;

new class extends Component {
    #[Reactive]
    public $cashflow;
};
?>

<!-- Contenedor principal con dos columnas -->
<div class="absolute inset-0 flex gap-4">
    <!-- Columna izquierda: Lista scrolleable de registros -->
    <div class="flex-1 flex flex-col min-h-0">
        <div class="flex-1 overflow-y-auto no-scrollbar p-4 space-y-4">
            @forelse ($this->cashflow as $record)
                <livewire:records.record :$record :key="$record->id" />
            @empty
                <div class="text-center text-gray-500 py-8">
                    {{ __('No records found') }}
                </div>
            @endforelse
        </div>

        <div class="flex shrink-0 justify-center pt-4">
            <flux:button href="/cashflow/create" icon="plus"></flux:button>
        </div>
    </div>

    <!-- Columna derecha: Cards estáticos -->
    <div class="w-80 space-y-3 flex flex-col shrink-0">
        <!-- Card 1 -->
        <flux:card class="border-2 border-gray-300">
            <div class="space-y-2">
                <p class="text-sm font-semibold text-gray-700">{{ __('Budget actual minus expenses') }}</p>
                <p class="text-4xl font-bold">800</p>
            </div>
        </flux:card>

        <!-- Card 2 -->
        <flux:card class="border-2 border-gray-300">
            <div class="space-y-2">
                <p class="text-sm font-semibold text-gray-700">{{ __('Remaining food budget') }}</p>
                <p class="text-4xl font-bold">200</p>
            </div>
        </flux:card>

        <!-- Card 3 -->
        <flux:card class="border-2 border-gray-300">
            <div class="space-y-2">
                <p class="text-sm font-semibold text-gray-700">{{ __('Remaining excess budget') }}</p>
                <p class="text-4xl font-bold">120</p>
            </div>
        </flux:card>
    </div>
</div>

<style>
    @layer utilities {
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }
    }
</style>
