<?php

namespace App\Imports;

use App\Models\Loan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LoanImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Loan([
            'user_npm' => $row['user_npm'] ?? $row['npm'] ?? null,
            'loan_at' => $row['loan_at'] ?? $row['loan_at'] ?? null,
            'return_at' => $row['return_at'] ?? $row['return_at'] ?? null,
        ]);
    }
}
