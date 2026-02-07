<?php

use Livewire\Component;
use Livewire\Attributes\Reactive;

new class extends Component {
    #[Reactive]
    public $cashflow;
};
?>

<!-- Tabla de registros -->
<div class="grid grid-cols-1 gap-3">
    @foreach ($this->cashflow as $record)
        <livewire:records.record :$record :key="$record->id" />
    @endforeach
</div>
