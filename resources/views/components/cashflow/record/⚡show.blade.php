<?php

use Livewire\Component;
use App\Models\Cashflow;

new class extends Component {
    public Cashflow $record;
    public $id;

    public function delete($id)
    {
        $cashflow = Cashflow::findOrFail($id);

        //TODO: Authorization check

        $cashflow->delete();
    }
};
?>

<flux:table.row wire:key="{{ $this->id }}">
    <!-- Description -->
    <flux:table.cell>{{ $this->record->description }}</flux:table.cell>
    <!-- Date -->
    <flux:table.cell>{{ $this->record->date }}</flux:table.cell>
    <!-- Type -->
    <flux:table.cell>
        @if ($this->record->type === 'INCOME')
            <flux:badge color="green" size="sm" inset="top bottom">{{ __('Income') }}
            </flux:badge>
        @else
            <flux:badge color="red" size="sm" inset="top bottom">{{ __('Expense') }}
            </flux:badge>
        @endif
    </flux:table.cell>
    <!-- Status -->
    <flux:table.cell>
        @if ($this->record->status === 'PAID')
            <flux:badge color="green" size="sm" inset="top bottom">{{ __('Paid') }}
            </flux:badge>
        @else
            <flux:badge color="yellow" size="sm" inset="top bottom">{{ __('Pending') }}
            </flux:badge>
        @endif
    </flux:table.cell>
    <!-- Amount -->
    <flux:table.cell variant="strong">
        {{ $this->record->currency }} ${{ $this->record->amount }}
    </flux:table.cell>
    <!-- Actions -->
    <flux:table.cell>
        <flux:button size="sm" wire:click="$parent.set('editing', true)">{{ __('Edit') }}</flux:button>
        <flux:button size="sm" wire:click="delete('{{ $record->id }}')" color="red">
            {{ __('Delete') }}
        </flux:button>
    </flux:table.cell>
</flux:table.row>
