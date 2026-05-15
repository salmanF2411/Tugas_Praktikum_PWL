<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Pengembalian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="post" action="{{ route('returns.update', $return->id) }}" class="mt-6 space-y-6">
                    @csrf
                    @method('PATCH')
                    <div class="max-w-xl">
                        <x-input-label for="loan_detail_id" value="Detail Peminjaman" />
                        <x-select-input id="loan_detail_id" name="loan_detail_id" class="mt-1 block w-full" required>
                            <option value="">Pilih detail peminjaman</option>
                            @foreach($loanDetails as $detail)
                            <option value="{{ $detail->id }}" @selected(old('loan_detail_id', $return->loan_detail_id) == $detail->id)>
                                {{ $detail->id }} - Pinjam #{{ $detail->loan_id }} - {{ optional($detail->book)->title }}
                            </option>
                            @endforeach
                        </x-select-input>
                        <x-input-error class="mt-2" :messages="$errors->get('loan_detail_id')" />
                    </div>
                    <div class="max-w-xl">
                        <x-input-label for="charge" value="Ada Biaya" />
                        <x-select-input id="charge" name="charge" class="mt-1 block w-full" required>
                            <option value="">Pilih opsi</option>
                            <option value="1" @selected(old('charge', $return->charge) == 1)>Ya</option>
                            <option value="0" @selected(old('charge', $return->charge) == 0)>Tidak</option>
                        </x-select-input>
                        <x-input-error class="mt-2" :messages="$errors->get('charge')" />
                    </div>
                    <div class="max-w-xl">
                        <x-input-label for="amount" value="Jumlah Biaya" />
                        <x-text-input id="amount" type="number" name="amount" class="mt-1 block w-full" value="{{ old('amount', $return->amount) }}" required />
                        <x-input-error class="mt-2" :messages="$errors->get('amount')" />
                    </div>
                    <div class="flex items-center gap-4">
                        <x-secondary-button tag="a" href="{{ route('returns') }}">Cancel</x-secondary-button>
                        <x-primary-button type="submit">Update</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>