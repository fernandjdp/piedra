<?php

declare(strict_types=1);

namespace App\Actions;

use App\Imports\CashflowImport;
use Maatwebsite\Excel\Facades\Excel;


final readonly class ImportCashflowAction
{
    /**
     * Execute the action.
     */
    public function handle($file): void
    {
        Excel::import(new CashflowImport, $file);
    }
}
