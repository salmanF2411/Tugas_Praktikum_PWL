<?php

namespace App\Exports;

use App\Models\LoanDetail;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LoanDetailExport implements FromArray, WithHeadings, ShouldAutoSize
{
    public function array(): array
    {
        $details = LoanDetail::with('book')->get();
        $data = [];
        $no = 1;
        foreach ($details as $d) {
            $data[] = [
                'no' => $no++,
                'loan_id' => $d->loan_id,
                'book_id' => $d->book_id,
                'book_title' => optional($d->book)->title,
                'is_return' => $d->is_return,
            ];
        }
        return $data;
    }

    public function headings(): array
    {
        return [
            'no',
            'loan_id',
            'book_id',
            'book_title',
            'is_return',
        ];
    }
}
