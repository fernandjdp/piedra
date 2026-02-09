<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Cashflow;
use App\Actions\ImportCashflowAction;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    public $file;
    public $monthFilter;
    public $yearFilter;

    public function mount()
    {
        $this->monthFilter = now()->format('m');
        $this->yearFilter = now()->format('Y');
    }

    #[Computed]
    public function cashflow()
    {
        return Cashflow::query()
            ->whereMonth('date', (int) $this->monthFilter)
            ->whereYear('date', (int) $this->yearFilter)
            ->orderBy('amount', 'desc')
            ->get();
            //->dd();
    }

    public function handleImport(ImportCashflowAction $action)
    {
        $this->validate(['file' => 'required|file|mimes:csv,xlsx']);
        $action->handle($this->file);

        // Resetear el archivo y cerrar el modal
        $this->reset('file');
        $this->dispatch('modal-close', name: 'import-cashflow');
    }
};
?>

<div class="flex h-full w-full flex-col overflow-hidden">
    <div class="flex flex-col flex-1 gap-4 min-h-0">
        <!-- Header con título y botón -->
        <div class="flex shrink-0 items-center justify-between">
            <span class="text-3xl font-bold">{{ __('Cashflow') }}</span>
            <div class="flex justify-between gap-2">
                <flux:select wire:model.live="monthFilter" placeholder="{{ __('Month') }}">
                    @foreach (range(1, 12) as $monthNumber)
                        @php
                            // Creamos un objeto fecha para obtener el nombre del mes traducido
                            $monthName = \Carbon\Carbon::create(2024, $monthNumber, 1)->translatedFormat('F');
                        @endphp
                        <flux:select.option value="{{ sprintf('%02d', $monthNumber) }}">
                            {{ ucfirst($monthName) }}
                        </flux:select.option>
                    @endforeach
                </flux:select>

                <flux:select wire:model.live="yearFilter" placeholder="{{ __('Year') }}">
                    {{-- Genera un rango de años dinámico (ej: 5 atrás, 5 adelante) --}}
                    @foreach (range(now()->year - 10, now()->year + 5) as $year)
                        <flux:select.option value="{{ $year }}">{{ $year }}</flux:select.option>
                    @endforeach
                </flux:select>
            </div>
            <div>
                <flux:button href="/cashflow/create">{{ __('Add') }}</flux:button>
                <flux:modal.trigger name="import-cashflow">
                    <flux:button>{{ __('Import') }}</flux:button>
                </flux:modal.trigger>
            </div>
        </div>

        <!-- Tabla de registros -->
        {{--
        <livewire:cashflow.table :cashflow="$this->cashflow" /> --}}
        <div class="flex-1 min-h-0 relative">
            <livewire:records.list :cashflow="$this->cashflow" />
        </div>
    </div>

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
