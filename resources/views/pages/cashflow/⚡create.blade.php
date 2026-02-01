<?php

use Livewire\Component;
use App\Models\Cashflow;

new class extends Component {
    public $description = '';
    public $amount = '';
    public $type = 'EXPENSE';
    public $date = '';
    public $category = '';
    public $fixed = false;
    public $status = 'PENDING';
    public $currency = 'ARS';

    public function create()
    {
        Cashflow::create($this->only(['description', 'amount', 'type', 'date', 'category', 'fixed', 'status', 'currency']));
        return $this->redirect('/cashflow');
    }
};
?>

<!-- HTML -->

<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <!-- Header con título y botón -->
    <div class="flex items-center justify-between">
        <span class="text-3xl font-bold">{{ __('Add Cashflow') }}</span>
    </div>

    <!-- Formulario -->
    <div class="grid grid-cols-2 gap-4">
        <!-- Descripción -->
        <flux:input wire:model="description" label="{{ __('Description') }}" />

        <!-- Monto con selector de moneda -->
        <flux:field>
            <flux:label>{{ __('Amount') }}</flux:label>
            <flux:input.group>
                <flux:input wire:model="amount" mask:dynamic="$money($input)" />
                <flux:select wire:model="currency" class="max-w-fit">
                    <flux:select.option selected>ARS</flux:select.option>
                    <flux:select.option>USD</flux:select.option>
                </flux:select>
            </flux:input.group>
            <flux:error name="amount" />
        </flux:field>

        <!-- Tipo: Ingreso o Gasto -->
        <flux:radio.group wire:model="type" variant="segmented" label="{{ __('Type') }}">
            <flux:radio value="INCOME" label="{{ __('Income') }}" icon="arrow-up-right" />
            <flux:radio value="EXPENSE" label="{{ __('Expense') }}" icon="arrow-down-right" checked />
        </flux:radio.group>

        <!-- Frecuencia fija -->
        <flux:field variant="inline" class="items-center">
            <flux:checkbox wire:model="fixed" />
            <flux:label>{{ __('Fixed payment (every month)') }}</flux:label>
        </flux:field>

        <!-- Fecha -->
        <flux:input wire:model="date" label="{{ __('Date') }}" type="date" />

        <!-- Status -->
        <flux:select wire:model="status" placeholder="Choose status..." label="{{ __('Status') }}">
            <flux:select.option value="PAID">{{ __('Paid') }}</flux:select.option>
            <flux:select.option value="PENDING">{{ __('Pending') }}</flux:select.option>
        </flux:select>
    </div>

    <!-- Botones de acción -->
    <div class="flex gap-2 justify-end">
        <flux:button wire:click="create" variant="primary">{{ __('Save') }}</flux:button>
        <flux:button href="/cashflow">{{ __('Cancel') }}</flux:button>
    </div>
</div>
