<?php

use Livewire\Component;
use App\Models\Cashflow;

new class extends Component {
    public $id;
    public Cashflow $record;
    public bool $editing = false;
};
?>

@if ($this->editing)
    <livewire:cashflow.record.edit :record="$this->record" :key="$this->id" />
@else
    <livewire:cashflow.record.show :record="$this->record" :key="$this->id" />
@endif
