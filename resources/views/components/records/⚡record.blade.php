<?php

use Livewire\Component;
use App\Models\Cashflow;

new class extends Component {
    public Cashflow $record;
};
?>

<div @class([
    'relative flex items-center gap-3 p-3 rounded-lg',
    'bg-green-100' => $record->type === 'INCOME',
    'bg-red-100' => $record->type !== 'INCOME',
])>
    @if ($record->fixed)
        <!-- Star in upper right -->
        <div class="absolute top-2 right-2">
            <flux:icon.star variant="micro" class="text-zinc-400" />
        </div>
    @endif

    <!-- Contenido del registro -->
    <div class="flex-1">
        <p class="font-semibold text-gray-800">{{ $record->description }}</p>
        <flux:badge color="zinc">{{ $record->category }}</flux:badge>
    </div>

    <!-- Monto -->
    <div class="text-right pr-2">
        <p class="font-bold text-gray-800">{{ $record->amount }} {{ $record->currency }}</p>
    </div>

    <div class="pr-4">
        <flux:button href="/cashflow/{{ $record->id }}/edit" size="sm" icon="pencil-square" class="text-gray-600">
        </flux:button>
    </div>

</div>
