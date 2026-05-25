<?php

namespace App\Imports;

use App\Models\LoanDetail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LoanDetailImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new LoanDetail([
            'loan_id' => $row['loan_id'] ?? null,
            'book_id' => $row['book_id'] ?? null,
            'is_return' => $row['is_return'] ?? ($row['is_return'] ?? 0),
        ]);
    }
}
