<?php

use Livewire\Component;
use App\Models\Cashflow;

new class extends Component {
    public Cashflow $cashflow;
    public $description;
    public float $amount;
    public $type;
    public $date;
    public $category;
    public $fixed;

    public function mount()
    {
        $this->cashflow = Cashflow::find(request()->route('id'));
        $this->fill($this->cashflow->only(['description', 'amount', 'type', 'date', 'category', 'fixed']));
    }

    public function update()
    {
        $this->cashflow->update($this->only(['description', 'amount', 'type', 'date', 'category', 'fixed']));

        return $this->redirect('/cashflow');
    }
};
?>

<!-- HTML -->

<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <!-- Header con título y botón -->
    <div class="flex items-center justify-between">
        <span class="text-3xl font-bold">{{ __('Update Cashflow') }}</span>
    </div>

    <!-- Formulario -->
    <div class="grid grid-cols-2 gap-4">
        <!-- Descripción -->
        <flux:input wire:model="description" label="{{ __('Description') }}" />

        <!-- Monto con selector de moneda -->
        <flux:field>
            <flux:label>{{ __('Amount') }}</flux:label>
            <flux:input.group>
                <flux:input wire:model="amount" type="number" mask:dynamic="$money($input)" />
                <flux:select class="max-w-fit">
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

        <!-- Categoría -->
        <flux:input label="{{ __('Category') }}" />
    </div>

    <!-- Botones de acción -->
    <div class="flex gap-2 justify-end">
        <flux:button wire:click="update" variant="primary">{{ __('Save') }}</flux:button>
        <flux:button href="/cashflow">{{ __('Cancel') }}</flux:button>
    </div>
</div>
