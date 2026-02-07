<?php

declare(strict_types=1);

namespace App\Imports;

use App\Models\Cashflow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

final class CashflowImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $filtered = $rows->filter(function ($row) {
            return isset($row['description'], $row['amount'], $row['type'], $row['date']);
        });

        foreach ($filtered as $row) {
            Cashflow::create([
                'description' => $row['description'],
                'amount' => $row['amount'],
                'type' => $row['type'],
                'date' => Date::excelToDateTimeObject($row['date']),
                'category' => '',
                'fixed' => false,
                'currency' => 'USD',
                'status' => 'PAID',
            ]);
        }
    }
}
