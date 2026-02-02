<?php

namespace App\Imports;

use App\Models\Cashflow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CashflowImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            Cashflow::create([
                'description' => $row['description'],
                'amount' => $row['amount'],
                'type' => $row['type'],
                'date' => $row['date'],
                'category' => '',
                'fixed' => false,
                'currency' => "USD",
                'status' => "PAID",
            ]);
        }
    }
}