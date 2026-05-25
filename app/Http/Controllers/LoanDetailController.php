<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\LoanDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Exports\LoanDetailExport;
use App\Imports\LoanDetailImport;
use Maatwebsite\Excel\Facades\Excel;

class LoanDetailController extends Controller
{
    public function index()
    {
        $data['loanDetails'] = LoanDetail::with(['loan.user', 'book'])->get();
        return view('loan_details.index', $data);
    }

    public function print()
    {
        $loanDetails = LoanDetail::with(['loan.user', 'book'])->get();
        $pdf = Pdf::loadView('loan_details.print', compact('loanDetails'));
        return $pdf->stream('daftar_detail_peminjaman.pdf');
    }

    public function create()
    {
        $data['loans'] = Loan::with('user')->get();
        $data['books'] = Book::all();
        return view('loan_details.create', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'loan_id' => 'required|exists:loans,id',
            'book_id' => 'required|exists:books,id',
            'is_return' => 'required|boolean',
        ]);

        LoanDetail::create($validated);
        return redirect()->route('loan.details')->with([
            'message' => 'Data detail peminjaman berhasil ditambahkan',
            'alert-type' => 'success',
        ]);
    }

    public function edit(string $id)
    {
        $data['loanDetail'] = LoanDetail::findOrFail($id);
        $data['loans'] = Loan::with('user')->get();
        $data['books'] = Book::all();
        return view('loan_details.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $loanDetail = LoanDetail::findOrFail($id);
        $validated = $request->validate([
            'loan_id' => 'required|exists:loans,id',
            'book_id' => 'required|exists:books,id',
            'is_return' => 'required|boolean',
        ]);

        $loanDetail->update($validated);
        return redirect()->route('loan.details')->with([
            'message' => 'Data detail peminjaman berhasil diupdate',
            'alert-type' => 'success',
        ]);
    }

    public function destroy(string $id)
    {
        $loanDetail = LoanDetail::findOrFail($id);
        $loanDetail->delete();

        return redirect()->route('loan.details')->with([
            'message' => 'Data detail peminjaman berhasil dihapus',
            'alert-type' => 'success',
        ]);
    }

    public function export()
    {
        return Excel::download(new LoanDetailExport, 'loan_details.xlsx');
    }

    public function import(Request $req)
    {
        $req->validate([
            'file' => 'required|max:10000|mimes:xlsx,xls',
        ]);

        Excel::import(new LoanDetailImport, $req->file('file'));
        return redirect()->route('loan.details')->with([
            'message' => 'Data detail peminjaman berhasil di import',
            'alert-type' => 'success',
        ]);
    }
}
