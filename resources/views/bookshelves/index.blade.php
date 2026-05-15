<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Rak Buku') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ action: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 space-x-3">
                <x-primary-button tag="a" href="{{ route('bookshelves.create') }}">Tambah Rak Buku</x-primary-button>
                <x-primary-button tag="a" href="{{ route('bookshelves.print') }}" target="blank">Print Rak Buku</x-primary-button>
            </div>

            <x-table>
                <x-slot name="header">
                    <tr>
                        <th>#</th>
                        <th>Kode Rak</th>
                        <th>Nama Rak</th>
                        <th>Aksi</th>
                    </tr>
                </x-slot>

                @php $num = 1; @endphp
                @foreach($bookshelves as $bookshelf)
                <tr>
                    <td>{{ $num++ }}</td>
                    <td>{{ $bookshelf->code }}</td>
                    <td>{{ $bookshelf->name }}</td>
                    <td>
                        <x-primary-button tag="a" href="{{ route('bookshelves.edit', $bookshelf->id) }}">Edit</x-primary-button>
                        <x-danger-button x-on:click=" action='{{ route('bookshelves.destroy', $bookshelf->id) }}'; $dispatch('open-modal', 'confirm-bookshelf-deletion')">
                            Delete
                        </x-danger-button>
                    </td>
                </tr>
                @endforeach
            </x-table>

            <x-modal name="confirm-bookshelf-deletion" focusable maxWidth="xl">
                <form method="post" x-bind:action="action" class="p-6">
                    @csrf
                    @method('delete')
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Apakah anda yakin akan menghapus rak buku ini?') }}
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