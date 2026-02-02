<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Cashflow;
use App\Actions\ImportCashflowAction;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

new class extends Component {
    use WithFileUploads;

    public $file;

    #[Computed]
    public function cashflow()
    {
        return Cashflow::all();
    }

    public function handleImport(ImportCashflowAction $action)
    {
        $action->handle($this->file);
    }
};
?>

<div class="flex h-full w-full flex-1 flex-col gap-4     rounded-xl">
    <!-- Header con título y botón -->
    <div class="flex items-center justify-between">
        <span class="text-3xl font-bold">{{ __('Cashflow') }}</span>
        <div>
            <flux:button href="/cashflow/create">{{ __('Add') }}</flux:button>
            <flux:modal.trigger name="import-cashflow">
                <flux:button>{{ __('Import') }}</flux:button>
            </flux:modal.trigger>
        </div>
    </div>

    <!-- Tabla de registros -->
    <livewire:cashflow.table :cashflow="$this->cashflow" />

    <!-- Modal de importar cashflow -->
    <flux:modal name="import-cashflow" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Import') }}</flux:heading>
                <flux:text class="mt-2">{{ __('Retrieve cashflow data from a file') }}</flux:text>
            </div>

            <flux:input wire:model="file" type="file" label="Select file" />

            <div class="flex">
                <flux:spacer />

                <flux:button wire:click="handleImport" variant="primary">{{ __('Import') }}</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
