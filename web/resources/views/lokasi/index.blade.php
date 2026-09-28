@extends('layouts.ternak')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">
        Data Lokasi Peternakan
    </h1>

    <p class="text-gray-500 mt-1">
        Daftar lokasi peternakan yang terdaftar di sistem.
    </p>
</div>

{{-- Pesan berhasil --}}
@if (session('success'))
    <div class="mb-5 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-green-700">
        {{ session('success') }}
    </div>
@endif

{{-- Pesan error --}}
@if ($errors->any())
    <div class="mb-5 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-red-700">
        <p class="font-semibold mb-1">
            Terjadi kesalahan:
        </p>

        <ul class="list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="bg-white rounded-lg shadow-sm">

    {{-- Header --}}
    <div class="p-5 border-b flex justify-between items-center">

        <div>
            <h2 class="font-semibold text-gray-800">
                Daftar Lokasi
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Total: {{ $lokasi->total() }} lokasi
            </p>
        </div>

        <a
            href="{{ route('lokasi.create') }}"
            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
        >
            + Tambah Lokasi
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
                        Nama Lokasi
                    </th>

                    <th class="px-5 py-3 text-left">
                        Alamat
                    </th>

                    <th class="px-5 py-3 text-left">
                        Status
                    </th>

                    <th class="px-5 py-3 text-left">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse ($lokasi as $item)

                    <tr class="border-b hover:bg-gray-50">

                        {{-- No --}}
                        <td class="px-5 py-4">
                            {{ $lokasi->firstItem() + $loop->index }}
                        </td>

                        {{-- Nama --}}
                        <td class="px-5 py-4 font-medium text-gray-800">
                            {{ $item->nama }}
                        </td>

                        {{-- Alamat --}}
                        <td class="px-5 py-4">
                            {{ $item->alamat ?? '-' }}
                        </td>

                        {{-- Status --}}
                        <td class="px-5 py-4">

                            @if ($item->status === 'aktif')

                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                    Aktif
                                </span>

                            @else

                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                    Nonaktif
                                </span>

                            @endif

                        </td>

                        {{-- Aksi --}}
                        <td class="px-5 py-4">

                            <a
                                href="{{ route('lokasi.edit', $item) }}"
                                class="text-blue-600 hover:text-blue-800 font-medium"
                            >
                                Edit
                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="5"
                            class="px-5 py-12 text-center text-gray-500"
                        >
                            Belum ada data lokasi peternakan.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{-- Pagination --}}
    @if ($lokasi->hasPages())

        <div class="px-5 py-4 border-t">
            {{ $lokasi->links() }}
        </div>

    @endif

</div>

@endsection