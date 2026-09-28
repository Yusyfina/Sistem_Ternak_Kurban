@extends('layouts.ternak')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">
        Data Pembeli
    </h1>

    <p class="text-gray-500 mt-1">
        Daftar pembeli yang terdaftar di sistem.
    </p>
</div>

{{-- Pesan berhasil --}}
@if (session('success'))
    <div class="mb-5 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-green-700">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-lg shadow-sm">

    {{-- Header --}}
    <div class="p-5 border-b flex justify-between items-center">

        <div>
            <h2 class="font-semibold text-gray-800">
                Daftar Pembeli
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Total: {{ $pembeli->total() }} pembeli
            </p>
        </div>

        <a
            href="{{ route('pembeli.create') }}"
            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
        >
            + Tambah Pembeli
        </a>

    </div>

    {{-- Tabel --}}
    <div class="overflow-x-auto">

        <table class="w-full text-sm">

            <thead class="bg-gray-50 border-b">

                <tr>

                    <th class="px-5 py-3 text-left">
                        No
                    </th>

                    <th class="px-5 py-3 text-left">
                        Nama
                    </th>

                    <th class="px-5 py-3 text-left">
                        No. HP
                    </th>

                    <th class="px-5 py-3 text-left">
                        Email
                    </th>

                    <th class="px-5 py-3 text-left">
                        Alamat
                    </th>

                    <th class="px-5 py-3 text-left">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse ($pembeli as $item)

                    <tr class="border-b hover:bg-gray-50">

                        {{-- No --}}
                        <td class="px-5 py-4">
                            {{ $pembeli->firstItem() + $loop->index }}
                        </td>

                        {{-- Nama --}}
                        <td class="px-5 py-4 font-medium text-gray-800">
                            {{ $item->nama }}
                        </td>

                        {{-- No HP --}}
                        <td class="px-5 py-4">
                            {{ $item->no_hp ?? '-' }}
                        </td>

                        {{-- Email --}}
                        <td class="px-5 py-4">
                            {{ $item->email ?? '-' }}
                        </td>

                        {{-- Alamat --}}
                        <td class="px-5 py-4">
                            {{ $item->alamat ?? '-' }}
                        </td>

                        {{-- Aksi --}}
                        <td class="px-5 py-4">

                            <div class="flex items-center gap-3">

                                <a
                                    href="{{ route('pembeli.edit', $item) }}"
                                    class="text-blue-600 hover:text-blue-800 font-medium"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('pembeli.destroy', $item) }}"
                                    method="POST"
                                    onsubmit="return confirm('Apakah kamu yakin ingin menghapus data pembeli ini?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="text-red-600 hover:text-red-800 font-medium"
                                    >
                                        Hapus
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="6"
                            class="px-5 py-12 text-center text-gray-500"
                        >
                            Belum ada data pembeli.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{-- Pagination --}}
    @if ($pembeli->hasPages())

        <div class="px-5 py-4 border-t">
            {{ $pembeli->links() }}
        </div>

    @endif

</div>

@endsection