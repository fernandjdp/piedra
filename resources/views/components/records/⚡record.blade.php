<?php

use Livewire\Component;
use App\Models\Cashflow;

new class extends Component {
    public Cashflow $record;
};
?>

<div @class([
    'flex items-center gap-3 p-3 rounded-lg',
    'bg-green-100' => $record->type === 'INCOME',
    'bg-red-100' => $record->type !== 'INCOME',
])>
    <!-- Contenido del registro -->
    <div class="flex-1">
        <p class="font-semibold text-gray-800">{{ $record->description }}</p>
        <p class="text-sm text-gray-600">{{ $record->date->format('d M Y') }}</p>
    </div>

    <!-- Monto -->
    <div class="text-right pr-2">
        <p class="font-bold text-gray-800">{{ $record->amount }} {{ $record->currency }}</p>
    </div>

    <!-- Pin si está fijado -->
    @if ($record->fixed)
        <flux:button size="sm" icon="pin" class="text-gray-600"></flux:button>
    @else
        <flux:button href="/cashflow/{{ $record->id }}/edit" size="sm" icon="pencil-square" class="text-gray-600">
        </flux:button>
    @endif
</div>
