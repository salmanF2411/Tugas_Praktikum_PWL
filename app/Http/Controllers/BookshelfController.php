<?php

namespace App\Http\Controllers;

use App\Models\Bookshelf;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Exports\BookshelfExport;
use App\Imports\BookshelfImport;
use Maatwebsite\Excel\Facades\Excel;

class BookshelfController extends Controller
{
    public function index()
    {
        $data['bookshelves'] = Bookshelf::all();
        return view('bookshelves.index', $data);
    }

    public function print()
    {
        $bookshelves = Bookshelf::all();
        $pdf = Pdf::loadView('bookshelves.print', compact('bookshelves'));
        return $pdf->stream('daftar_rak_buku.pdf');
    }

    public function create()
    {
        return view('bookshelves.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:10|unique:bookshelf,code',
            'name' => 'required|string|max:255',
        ]);

        Bookshelf::create($validated);
        return redirect()->route('bookshelves')->with([
            'message' => 'Data rak buku berhasil ditambahkan',
            'alert-type' => 'success',
        ]);
    }

    public function edit(string $id)
    {
        $data['bookshelf'] = Bookshelf::findOrFail($id);
        return view('bookshelves.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $bookshelf = Bookshelf::findOrFail($id);
        $validated = $request->validate([
            'code' => 'required|string|max:10|unique:bookshelf,code,' . $bookshelf->id,
            'name' => 'required|string|max:255',
        ]);

        $bookshelf->update($validated);
        return redirect()->route('bookshelves')->with([
            'message' => 'Data rak buku berhasil diupdate',
            'alert-type' => 'success',
        ]);
    }

    public function destroy(string $id)
    {
        $bookshelf = Bookshelf::findOrFail($id);
        $bookshelf->delete();

        return redirect()->route('bookshelves')->with([
            'message' => 'Data rak buku berhasil dihapus',
            'alert-type' => 'success',
        ]);
    }

    public function export()
    {
        return Excel::download(new BookshelfExport, 'bookshelves.xlsx');
    }

    public function import(Request $req)
    {
        $req->validate([
            'file' => 'required|max:10000|mimes:xlsx,xls',
        ]);

        Excel::import(new BookshelfImport, $req->file('file'));
        return redirect()->route('bookshelves')->with([
            'message' => 'Data rak buku berhasil di import',
            'alert-type' => 'success',
        ]);
    }
}
