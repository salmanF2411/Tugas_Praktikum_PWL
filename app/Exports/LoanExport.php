<?php

namespace App\Exports;

use App\Models\Loan;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LoanExport implements FromArray, WithHeadings, ShouldAutoSize
{
    public function array(): array
    {
        $loans = Loan::with('loanDetails')->get();
        $data = [];
        $no = 1;
        foreach ($loans as $loan) {
            $data[] = [
                'no' => $no++,
                'user_npm' => $loan->user_npm,
                'loan_at' => $loan->loan_at,
                'return_at' => $loan->return_at,
                'total_books' => $loan->loanDetails->count(),
            ];
        }
        return $data;
    }

    public function headings(): array
    {
        return [
            'no',
            'user_npm',
            'loan_at',
            'return_at',
            'total_books',
        ];
    }
}
