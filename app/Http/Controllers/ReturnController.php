<?php

namespace App\Http\Controllers;

use App\Models\LoanDetail;
use App\Models\ReturnRecord;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function index()
    {
        $data['returns'] = ReturnRecord::with('loanDetail.loan.user')->get();
        return view('returns.index', $data);
    }

    public function print()
    {
        $returns = ReturnRecord::with('loanDetail.loan.user')->get();
        $pdf = Pdf::loadView('returns.print', compact('returns'));
        return $pdf->stream('daftar_pengembalian.pdf');
    }

    public function create()
    {
        $data['loanDetails'] = LoanDetail::with(['loan.user', 'book'])->get();
        return view('returns.create', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'loan_detail_id' => 'required|exists:loan_detail,id',
            'charge' => 'required|boolean',
            'amount' => 'required|integer|min:0',
        ]);

        ReturnRecord::create($validated);
        return redirect()->route('returns')->with([
            'message' => 'Data pengembalian berhasil ditambahkan',
            'alert-type' => 'success',
        ]);
    }

    public function edit(string $id)
    {
        $data['return'] = ReturnRecord::findOrFail($id);
        $data['loanDetails'] = LoanDetail::with(['loan.user', 'book'])->get();
        return view('returns.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $return = ReturnRecord::findOrFail($id);
        $validated = $request->validate([
            'loan_detail_id' => 'required|exists:loan_detail,id',
            'charge' => 'required|boolean',
            'amount' => 'required|integer|min:0',
        ]);

        $return->update($validated);
        return redirect()->route('returns')->with([
            'message' => 'Data pengembalian berhasil diupdate',
            'alert-type' => 'success',
        ]);
    }

    public function destroy(string $id)
    {
        $return = ReturnRecord::findOrFail($id);
        $return->delete();

        return redirect()->route('returns')->with([
            'message' => 'Data pengembalian berhasil dihapus',
            'alert-type' => 'success',
        ]);
    }
}
