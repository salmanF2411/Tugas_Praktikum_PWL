<?php

namespace App\Exports;

use App\Models\ReturnRecord;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReturnExport implements FromArray, WithHeadings, ShouldAutoSize
{
    public function array(): array
    {
        $items = ReturnRecord::with('loanDetail.loan.user')->get();
        $data = [];
        $no = 1;
        foreach ($items as $it) {
            $loan = $it->loanDetail->loan ?? null;
            $user = $loan ? ($loan->user ?? null) : null;
            $data[] = [
                'no' => $no++,
                'nama' => $user ? trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) : '-',
                'npm' => $loan ? $loan->user_npm : '-',
                'tanggal_pinjam' => $loan ? $loan->loan_at : '-',
                'tanggal_kembali' => $loan ? $loan->return_at : '-',
            ];
        }
        return $data;
    }

    public function headings(): array
    {
        return [
            'no',
            'nama',
            'npm',
            'tanggal_pinjam',
            'tanggal_kembali',
        ];
    }
}
