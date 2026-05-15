<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Detail Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="post" action="{{ route('loan.details.update', $loanDetail->id) }}" class="mt-6 space-y-6">
                    @csrf
                    @method('PATCH')
                    <div class="max-w-xl">
                        <x-input-label for="loan_id" value="Peminjaman" />
                        <x-select-input id="loan_id" name="loan_id" class="mt-1 block w-full" required>
                            <option value="">Pilih peminjaman</option>
                            @foreach($loans as $loan)
                            <option value="{{ $loan->id }}" @selected(old('loan_id', $loanDetail->loan_id) == $loan->id)>
                                {{ $loan->id }} - {{ optional($loan->user)->first_name ? optional($loan->user)->first_name . ' ' . optional($loan->user)->last_name : $loan->user_npm }}
                            </option>
                            @endforeach
                        </x-select-input>
                        <x-input-error class="mt-2" :messages="$errors->get('loan_id')" />
                    </div>
                    <div class="max-w-xl">
                        <x-input-label for="book_id" value="Buku" />
                        <x-select-input id="book_id" name="book_id" class="mt-1 block w-full" required>
                            <option value="">Pilih buku</option>
                            @foreach($books as $book)
                            <option value="{{ $book->id }}" @selected(old('book_id', $loanDetail->book_id) == $book->id)>{{ $book->title }}</option>
                            @endforeach
                        </x-select-input>
                        <x-input-error class="mt-2" :messages="$errors->get('book_id')" />
                    </div>
                    <div class="max-w-xl">
                        <x-input-label for="is_return" value="Status Pengembalian" />
                        <x-select-input id="is_return" name="is_return" class="mt-1 block w-full" required>
                            <option value="">Pilih status</option>
                            <option value="1" @selected(old('is_return', $loanDetail->is_return) == 1)>Sudah</option>
                            <option value="0" @selected(old('is_return', $loanDetail->is_return) == 0)>Belum</option>
                        </x-select-input>
                        <x-input-error class="mt-2" :messages="$errors->get('is_return')" />
                    </div>
                    <div class="flex items-center gap-4">
                        <x-secondary-button tag="a" href="{{ route('loan.details') }}">Cancel</x-secondary-button>
                        <x-primary-button type="submit">Update</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>