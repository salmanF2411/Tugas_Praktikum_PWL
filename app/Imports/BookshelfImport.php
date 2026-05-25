<?php

namespace App\Imports;

use App\Models\Bookshelf;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BookshelfImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Bookshelf([
            'code' => $row['kode'] ?? $row['code'] ?? null,
            'name' => $row['nama'] ?? $row['name'] ?? null,
        ]);
    }
}
