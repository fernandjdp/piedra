<?php

use Livewire\Component;

new class extends Component {
    public $cashflows = [];

    public function mount()
    {
        $this->cashflows = \App\Models\Cashflow::all();
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
    <div class="relative flex-1 overflow-hidden">
        <flux:table>
            <flux:table.columns>
                <flux:table.column>{{ __('Description') }}</flux:table.column>
                <flux:table.column>{{ __('Date') }}</flux:table.column>
                <flux:table.column>{{ __('Type') }}</flux:table.column>
                <flux:table.column>{{ __('Status') }}</flux:table.column>
                <flux:table.column>{{ __('Amount') }}</flux:table.column>
            </flux:table.columns>
            <flux:table.rows>
                @foreach ($cashflows as $cashflow)
                    <flux:table.row wire:key="{{ $cashflow->id }}">
                        <flux:table.cell>{{ $cashflow->description }}</flux:table.cell>
                        <flux:table.cell>{{ $cashflow->date }}</flux:table.cell>
                        <flux:table.cell>
                            @if ($cashflow->type === 'INCOME')
                                <flux:badge color="green" size="sm" inset="top bottom">{{ __('Income') }}
                                </flux:badge>
                            @else
                                <flux:badge color="red" size="sm" inset="top bottom">{{ __('Expense') }}
                                </flux:badge>
                            @endif
                        </flux:table.cell>
                        <flux:table.cell>
                            <flux:badge color="green" size="sm" inset="top bottom">{{ __('Paid') }}
                            </flux:badge>
                        </flux:table.cell>
                        <flux:table.cell variant="strong">${{ $cashflow->amount }}</flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    </div>
