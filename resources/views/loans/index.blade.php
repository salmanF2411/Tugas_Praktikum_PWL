<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ action: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 space-x-3">
                <x-primary-button tag="a" href="{{ route('loans.create') }}">Tambah Peminjaman</x-primary-button>
                <x-primary-button tag="a" href="{{ route('loans.print') }}" target="blank">Print Peminjaman</x-primary-button>
                <x-primary-button tag="a" href="{{ route('loans.export') }}" target="blank">Export Peminjaman</x-primary-button>
                <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal','import-loan')">Import Peminjaman</x-primary-button>
            </div>

            <x-modal name="import-loan" focusable maxWidth="xl">
                <form method="post" action="{{ route('loans.import') }}" class="p-6" enctype="multipart/form-data">
                    @csrf

                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Import Data Peminjaman') }}</h2>
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
                        <th>NPM</th>
                        <th>Nama</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Aksi</th>
                    </tr>
                </x-slot>
                @php $num = 1; @endphp
                @foreach($loans as $loan)
                <tr>
                    <td>{{ $num++ }}</td>
                    <td>{{ $loan->user_npm }}</td>
                    <td>{{ optional($loan->user)->first_name ? optional($loan->user)->first_name . ' ' . optional($loan->user)->last_name : '-' }}</td>
                    <td>{{ $loan->loan_at }}</td>
                    <td>{{ $loan->return_at }}</td>
                    <td>
                        <x-primary-button tag="a" href="{{ route('loans.edit', $loan->id) }}">Edit</x-primary-button>
                        <x-danger-button x-on:click=" action='{{ route('loans.destroy', $loan->id) }}'; $dispatch('open-modal', 'confirm-loan-deletion')">
                            Delete
                        </x-danger-button>
                    </td>
                </tr>
                @endforeach
            </x-table>

            <x-modal name="confirm-loan-deletion" focusable maxWidth="xl">
                <form method="post" x-bind:action="action" class="p-6">
                    @csrf
                    @method('delete')
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Apakah anda yakin akan menghapus peminjaman ini?') }}
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