<?php

use Livewire\Component;
use App\Models\Cashflow;

new class extends Component {
    public Cashflow $record;
    public bool $editing = false;

    // Campos del formulario
    public $description;
    public $amount;
    public $type;
    public $date;
    public $status;
    public $currency;

    public function mount()
    {
        $this->fill($this->record->only(['description', 'amount', 'type', 'date', 'status', 'currency']));
    }

    public function toggleEditing()
    {
        $this->editing = !$this->editing;
    }

    public function save()
    {
        $this->record->update($this->only(['description', 'amount', 'type', 'date', 'status', 'currency']));

        $this->editing = false; // Cerramos la edición localmente

        // Opcional: Notificar al abuelo si necesita refrescar totales
        // $this->dispatch('record-updated');
    }

    public function delete($id)
    {
        $cashflow = Cashflow::findOrFail($id);

        //TODO: Authorization check

        $cashflow->delete();
    }
};
?>

<flux:table.row wire:key="row-{{ $record->id }}">
    @if ($editing)
        <!-- Description -->
        <flux:table.cell>
            <flux:input wire:model="description" />
        </flux:table.cell>
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
            <flux:button size="sm" :loading="false" wire:click="toggleEditing">{{ __('Cancel') }}
            </flux:button>
        </flux:table.cell>
    @else
        <flux:table.cell>{{ $description }}</flux:table.cell>
        <flux:table.cell>
            <flux:badge :color="$type === 'INCOME' ? 'green' : 'red'" size="sm" inset="top bottom">
                {{ __(Str::title($type)) }}
            </flux:badge>
        </flux:table.cell>
        <flux:table.cell>
            <flux:badge :color="$status === 'PAID' ? 'green' : 'yellow'" size="sm" inset="top bottom">
                {{ __(Str::title($status)) }}
            </flux:badge>
        </flux:table.cell>
        <flux:table.cell variant="strong">{{ $amount }} {{ $currency }}</flux:cell>
            <flux:table.cell>
                <flux:button size="sm" :loading="false" wire:click="toggleEditing">{{ __('Edit') }}
                </flux:button>
                <flux:button size="sm" wire:click="delete('{{ $record->id }}')"
                    wire:confirm="Are you sure you want to delete this post?" color="red">
                    {{ __('Delete') }}
                </flux:button>
            </flux:table.cell>
    @endif
</flux:table.row>
