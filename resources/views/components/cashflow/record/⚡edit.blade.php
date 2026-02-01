<?php

use Livewire\Component;
use App\Models\Cashflow;

new class extends Component {
    public Cashflow $record;
    public $id;

    public $description;
    public $amount;
    public $type;
    public $date;
    public $category;
    public $fixed;
    public $currency;
    public $status;

    public function mount()
    {
        $this->fill($this->record->only(['description', 'amount', 'type', 'date', 'category', 'fixed', 'currency', 'status']));
    }

    public function save(): void
    {
        $this->record->update($this->only(['description', 'amount', 'type', 'date', 'category', 'fixed', 'currency', 'status']));
        $this->dispatch('toggle-editing');
    }
};
?>

<flux:table.row wire:key="{{ $this->id }}">
    <!-- Description -->
    <flux:table.cell>
        <flux:input wire:model="description" />
    </flux:table.cell>
    <!-- Date -->
    <flux:table.cell>{{ $this->record->date }}</flux:table.cell>
    <!-- Type -->
    <flux:table.cell>
        <flux:select wire:model="type" placeholder="Choose type...">
            <flux:select.option value="INCOME">{{ __('Income') }}</flux:select.option>
            <flux:select.option value="EXPENSE">{{ __('Expense') }}</flux:select.option>
        </flux:select>
    </flux:table.cell>
    <!-- Status -->
    <flux:table.cell>
        <flux:select wire:model="status" placeholder="Choose status...">
            <flux:select.option value="PAID">{{ __('Paid') }}</flux:select.option>
            <flux:select.option value="PENDING">{{ __('Pending') }}</flux:select.option>
        </flux:select>
    </flux:table.cell>
    <!-- Amount -->
    <flux:table.cell variant="strong">
        <flux:field>
            <flux:input.group>
                <flux:input class="max-w-24" wire:model="amount" mask:dynamic="$money($input)" />
                <flux:select class="max-w-fit" wire:model="currency">
                    <flux:select.option selected>ARS</flux:select.option>
                    <flux:select.option>USD</flux:select.option>
                </flux:select>
            </flux:input.group>
            <flux:error name="amount" />
        </flux:field>
    </flux:table.cell>
    <!-- Actions -->
    <flux:table.cell>
        <flux:button size="sm" wire:click="save">{{ __('Save') }}</flux:button>
        <flux:button size="sm" wire:click="$parent.set('editing', false)">{{ __('Cancel') }}</flux:button>

    </flux:table.cell>
</flux:table.row>
