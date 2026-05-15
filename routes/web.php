<?php


use App\Http\Controllers\BookController;
use App\Http\Controllers\BookshelfController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LoanDetailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReturnController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/books', [BookController::class, 'index'])->name('books');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::get('/books/print', [BookController::class, 'print'])->name('books.print');
    Route::post('/books/store', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::match(['put', 'patch'], '/books/{id}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');

    Route::get('/bookshelves', [BookshelfController::class, 'index'])->name('bookshelves');
    Route::get('/bookshelves/create', [BookshelfController::class, 'create'])->name('bookshelves.create');
    Route::post('/bookshelves/store', [BookshelfController::class, 'store'])->name('bookshelves.store');
    Route::get('/bookshelves/{id}/edit', [BookshelfController::class, 'edit'])->name('bookshelves.edit');
    Route::match(['put', 'patch'], '/bookshelves/{id}', [BookshelfController::class, 'update'])->name('bookshelves.update');
    Route::delete('/bookshelves/{id}', [BookshelfController::class, 'destroy'])->name('bookshelves.destroy');
    Route::get('/bookshelves/print', [BookshelfController::class, 'print'])->name('bookshelves.print');

    Route::get('/loans', [LoanController::class, 'index'])->name('loans');
    Route::get('/loans/create', [LoanController::class, 'create'])->name('loans.create');
    Route::post('/loans/store', [LoanController::class, 'store'])->name('loans.store');
    Route::get('/loans/{id}/edit', [LoanController::class, 'edit'])->name('loans.edit');
    Route::match(['put', 'patch'], '/loans/{id}', [LoanController::class, 'update'])->name('loans.update');
    Route::delete('/loans/{id}', [LoanController::class, 'destroy'])->name('loans.destroy');
    Route::get('/loans/print', [LoanController::class, 'print'])->name('loans.print');

    Route::get('/loan-details', [LoanDetailController::class, 'index'])->name('loan.details');
    Route::get('/loan-details/create', [LoanDetailController::class, 'create'])->name('loan.details.create');
    Route::post('/loan-details/store', [LoanDetailController::class, 'store'])->name('loan.details.store');
    Route::get('/loan-details/{id}/edit', [LoanDetailController::class, 'edit'])->name('loan.details.edit');
    Route::match(['put', 'patch'], '/loan-details/{id}', [LoanDetailController::class, 'update'])->name('loan.details.update');
    Route::delete('/loan-details/{id}', [LoanDetailController::class, 'destroy'])->name('loan.details.destroy');
    Route::get('/loan-details/print', [LoanDetailController::class, 'print'])->name('loan.details.print');

    Route::get('/returns', [ReturnController::class, 'index'])->name('returns');
    Route::get('/returns/create', [ReturnController::class, 'create'])->name('returns.create');
    Route::post('/returns/store', [ReturnController::class, 'store'])->name('returns.store');
    Route::get('/returns/{id}/edit', [ReturnController::class, 'edit'])->name('returns.edit');
    Route::match(['put', 'patch'], '/returns/{id}', [ReturnController::class, 'update'])->name('returns.update');
    Route::delete('/returns/{id}', [ReturnController::class, 'destroy'])->name('returns.destroy');
    Route::get('/returns/print', [ReturnController::class, 'print'])->name('returns.print');
});

require __DIR__ . '/auth.php';
