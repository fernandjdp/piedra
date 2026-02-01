<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Cashflow;

new class extends Component {
    #[Computed]
    public function cashflow()
    {
        return Cashflow::all();
    }
};
?>

<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <!-- Header con título y botón -->
    <div class="flex items-center justify-between">
        <span class="text-3xl font-bold">{{ __('Cashflow') }}</span>
        <flux:button href="/cashflow/create">{{ __('Add') }}</flux:button>
    </div>

    <!-- Tabla de registros -->
    <livewire:cashflow.table :cashflow="$this->cashflow" />
</div>
