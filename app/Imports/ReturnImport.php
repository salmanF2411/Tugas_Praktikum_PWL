<?php

namespace App\Imports;

use App\Models\ReturnRecord;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ReturnImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new ReturnRecord([
            'loan_detail_id' => $row['loan_detail_id'] ?? $row['loan_detail'] ?? $row['id_detail'] ?? null,
            'charge' => isset($row['charge']) ? (bool)$row['charge'] : false,
            'amount' => isset($row['amount']) ? (int)$row['amount'] : 0,
        ]);
    }
}
