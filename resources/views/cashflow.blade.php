<x-layouts::app :title="__('Cashflow')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <!-- Header con título y botón -->
        <div class="flex items-center justify-between">
            <span class="text-3xl font-bold">{{ __('Cashflow') }}</span>
            <flux:button href="/cashflow/create">{{ __('Add') }}</flux:button>
        </div>

        <!-- Tabla de registros -->
        <div class="relative flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>
    </div>
</x-layouts::app>
