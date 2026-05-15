<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        $data['loans'] = Loan::with('user')->get();
        return view('loans.index', $data);
    }

    public function print()
    {
        $loans = Loan::with('user')->get();
        $pdf = Pdf::loadView('loans.print', compact('loans'));
        return $pdf->stream('daftar_peminjaman.pdf');
    }

    public function create()
    {
        $data['users'] = User::all()->mapWithKeys(function ($user) {
            return [$user->npm => $user->first_name . ' ' . $user->last_name];
        });
        return view('loans.create', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_npm' => 'required|exists:users,npm',
            'loan_at' => 'required|date',
            'return_at' => 'required|date|after_or_equal:loan_at',
        ]);

        Loan::create($validated);
        return redirect()->route('loans')->with([
            'message' => 'Data peminjaman berhasil ditambahkan',
            'alert-type' => 'success',
        ]);
    }

    public function edit(string $id)
    {
        $data['loan'] = Loan::findOrFail($id);
        $data['users'] = User::all()->mapWithKeys(function ($user) {
            return [$user->npm => $user->first_name . ' ' . $user->last_name];
        });
        return view('loans.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $loan = Loan::findOrFail($id);
        $validated = $request->validate([
            'user_npm' => 'required|exists:users,npm',
            'loan_at' => 'required|date',
            'return_at' => 'required|date|after_or_equal:loan_at',
        ]);

        $loan->update($validated);
        return redirect()->route('loans')->with([
            'message' => 'Data peminjaman berhasil diupdate',
            'alert-type' => 'success',
        ]);
    }

    public function destroy(string $id)
    {
        $loan = Loan::findOrFail($id);
        $loan->delete();

        return redirect()->route('loans')->with([
            'message' => 'Data peminjaman berhasil dihapus',
            'alert-type' => 'success',
        ]);
    }
}
