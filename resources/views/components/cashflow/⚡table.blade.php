<?php

use Livewire\Component;
use Livewire\Attributes\Reactive;

new class extends Component {
    #[Reactive]
    public $cashflow;
};
?>

<!-- Tabla de registros -->
<div class="relative flex-1 overflow-hidden">
    <flux:table>
        <flux:table.columns>
            <flux:table.column>{{ __('Description') }}</flux:table.column>
            <flux:table.column>{{ __('Type') }}</flux:table.column>
            <flux:table.column>{{ __('Status') }}</flux:table.column>
            <flux:table.column>{{ __('Amount') }}</flux:table.column>
            <flux:table.column>{{ __('Action') }}</flux:table.column>
        </flux:table.columns>
        <flux:table.rows>
            @foreach ($this->cashflow as $record)
                <livewire:cashflow.record :$record :key="$record->id" />
            @endforeach
        </flux:table.rows>
    </flux:table>
</div>
