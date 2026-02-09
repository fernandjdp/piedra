<?php

use Livewire\Component;
use Livewire\Attributes\Reactive;

new class extends Component {
    #[Reactive]
    public $cashflow;
    public $budgetActualMinusExpenses;
    public $budgetFood = 400;
    public $totalFixedExpenses;
    public $remainingFoodBudget;
    public $remainingBudget;
    public $remainingExcessBudget;

    public function boot()
    {
        $this->calculateBudget();
    }

    public function calculateBudget()
    {
        // Probemos el cálculo desde la colección, de ser muy pesada probamos con consultas directas a la base de datos
        $expenses = $this->cashflow->where('type', 'EXPENSE')->sum('amount');
        $income = $this->cashflow->where('type', 'INCOME')->sum('amount');
        $foodExpenses = $this->cashflow->where('type', 'EXPENSE')->where('category', 'FOOD')->sum('amount');
        $this->totalFixedExpenses = $this->cashflow->where('fixed', true)->where('type', 'EXPENSE')->sum('amount');
        $this->budgetActualMinusExpenses = $income - $expenses;
        $this->remainingFoodBudget = max(0, $this->budgetFood - $foodExpenses); // Ejemplo: presupuesto de comida de 500
        $this->remainingBudget = max(0, $this->totalFixedExpenses - $expenses);
        $this->remainingExcessBudget = 0;
    }
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
                <p class="text-4xl font-bold">{{ $this->budgetActualMinusExpenses }}</p>
            </div>
        </flux:card>

        <!-- Card 2 -->
        <flux:card class="border-2 border-gray-300">
            <div class="space-y-2">
                <p class="text-sm font-semibold text-gray-700">{{ __('Remaining food budget') }}</p>
                <p class="text-4xl font-bold">{{ $this->remainingFoodBudget }}</p>
            </div>
        </flux:card>

        <!-- Card 3 -->
        <flux:card class="border-2 border-gray-300">
            <div class="space-y-2">
                <p class="text-sm font-semibold text-gray-700">{{ __('Remaining excess budget') }}</p>
                <p class="text-4xl font-bold">{{ $this->remainingBudget }}</p>
            </div>
        </flux:card>

        <!-- Card 4 -->
        <flux:card class="border-2 border-gray-300">
            <div class="space-y-2">
                <p class="text-sm font-semibold text-gray-700">{{ __('Total fixed expenses') }}</p>
                <p class="text-4xl font-bold">{{ $this->totalFixedExpenses }}</p>
            </div>
        </flux:card>

        <!-- Card 5 -->
        <flux:card class="border-2 border-gray-300">
            <div class="space-y-2">
                <p class="text-sm font-semibold text-gray-700">{{ __('Remaining excess budget') }}</p>
                <p class="text-4xl font-bold">120</p>
            </div>
        </flux:card>

        <!-- Card 6 -->
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
