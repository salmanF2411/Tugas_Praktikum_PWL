<?php

namespace App\Exports;

use App\Models\Bookshelf;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BookshelfExport implements FromArray, WithHeadings, ShouldAutoSize
{
    public function array(): array
    {
        $shelves = Bookshelf::all();
        $data = [];
        $no = 1;
        foreach ($shelves as $s) {
            $data[] = [
                'no' => $no++,
                'code' => $s->code,
                'name' => $s->name,
            ];
        }
        return $data;
    }

    public function headings(): array
    {
        return [
            'no',
            'kode',
            'nama',
        ];
    }
}
