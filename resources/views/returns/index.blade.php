<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Pengembalian') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ action: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 space-x-3">
                <x-primary-button tag="a" href="{{ route('returns.create') }}">Tambah Pengembalian</x-primary-button>
                <x-primary-button tag="a" href="{{ route('returns.print') }}" target="blank">Print Pengembalian</x-primary-button>
                <x-primary-button tag="a" href="{{ route('returns.export') }}" target="blank">Export Pengembalian</x-primary-button>
                <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal','import-return')">Import Pengembalian</x-primary-button>
            </div>

            <x-modal name="import-return" focusable maxWidth="xl">
                <form method="post" action="{{ route('returns.import') }}" class="p-6" enctype="multipart/form-data">
                    @csrf

                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Import Data Pengembalian') }}</h2>
                    <div class="max-w-xl">
                        <x-input-label for="file" class="sr-only" value="File Import" />
                        <x-file-input id="file" name="file" class="mt-1 block w-full" required />
                    </div>
                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">{{ __('Cancel') }}</x-secondary-button>
                        <x-primary-button class="ml-3">{{ __('Upload') }}</x-primary-button>
                    </div>
                </form>
            </x-modal>

            <x-table>
                <x-slot name="header">
                    <tr>
                        <th>#</th>
                        <th>ID Detail</th>
                        <th>ID Pinjam</th>
                        <th>Biaya</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </x-slot>
                @php $num = 1; @endphp
                @foreach($returns as $return)
                <tr>
                    <td>{{ $num++ }}</td>
                    <td>{{ $return->loan_detail_id }}</td>
                    <td>{{ optional($return->loanDetail)->loan_id }}</td>
                    <td>{{ $return->charge ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $return->amount }}</td>
                    <td>
                        <x-primary-button tag="a" href="{{ route('returns.edit', $return->id) }}">Edit</x-primary-button>
                        <x-danger-button x-on:click=" action='{{ route('returns.destroy', $return->id) }}'; $dispatch('open-modal', 'confirm-return-deletion')">
                            Delete
                        </x-danger-button>
                    </td>
                </tr>
                @endforeach
            </x-table>

            <x-modal name="confirm-return-deletion" focusable maxWidth="xl">
                <form method="post" x-bind:action="action" class="p-6">
                    @csrf
                    @method('delete')
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Apakah anda yakin akan menghapus data pengembalian ini?') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Setelah proses dilaksanakan, data akan dihapus secara permanen.') }}
                    </p>
                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-secondary-button>
                        <x-danger-button class="ml-3">
                            {{ __('Delete!!!') }}
                        </x-danger-button>
                    </div>
                </form>
            </x-modal>
        </div>
    </div>
</x-app-layout>