@extends('layouts.ternak')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">
        Data Ternak
    </h1>

    <p class="text-gray-500 mt-1">
        Daftar data ternak yang terdaftar di sistem.
    </p>
</div>


{{-- NOTIFIKASI BERHASIL --}}
@if (session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
        <p class="text-sm text-green-700">
            {{ session('success') }}
        </p>
    </div>
@endif


{{-- NOTIFIKASI ERROR --}}
@if (session('error'))
    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
        <p class="text-sm text-red-700">
            {{ session('error') }}
        </p>
    </div>
@endif


<div class="bg-white rounded-lg shadow-sm">

    {{-- HEADER --}}
    <div class="p-5 border-b flex justify-between items-center">

        <div>
            <h2 class="font-semibold text-gray-800">
                Daftar Ternak
            </h2>

            <p class="text-sm text-gray-500">
                Total: {{ $ternak->total() }} ternak
            </p>
        </div>

        <a
            href="{{ route('ternak.create') }}"
            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
        >
            + Tambah Ternak
        </a>

    </div>


    {{-- TABLE --}}
    <div class="overflow-x-auto">

        <table class="w-full text-sm">

            <thead class="bg-gray-50 border-b">

                <tr>

                    <th class="px-5 py-3 text-left">
                        No
                    </th>

                    <th class="px-5 py-3 text-left">
                        Kode Ternak
                    </th>

                    <th class="px-5 py-3 text-left">
                        Jenis
                    </th>

                    <th class="px-5 py-3 text-left">
                        Lokasi
                    </th>

                    <th class="px-5 py-3 text-left">
                        RFID
                    </th>

                    <th class="px-5 py-3 text-left">
                        Bobot Terakhir
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

                @forelse ($ternak as $item)

                    <tr class="border-b hover:bg-gray-50">

                        {{-- NOMOR --}}
                        <td class="px-5 py-3">
                            {{ $ternak->firstItem() + $loop->index }}
                        </td>


                        {{-- KODE --}}
                        <td class="px-5 py-3 font-medium text-gray-800">
                            {{ $item->kode_ternak }}
                        </td>


                        {{-- JENIS --}}
                        <td class="px-5 py-3">
                            {{ $item->jenisTernak->nama_jenis ?? '-' }}
                        </td>


                        {{-- LOKASI --}}
                        <td class="px-5 py-3">
                            {{ $item->lokasi->nama ?? '-' }}
                        </td>


                        {{-- RFID --}}
                        <td class="px-5 py-3">
                            {{ $item->kode_rfid ?? '-' }}
                        </td>


                        {{-- BOBOT --}}
                        <td class="px-5 py-3">
                            @if ($item->bobot_terakhir !== null)
                                {{ $item->bobot_terakhir }} kg
                            @else
                                -
                            @endif
                        </td>


                        {{-- STATUS --}}
                        <td class="px-5 py-3">
                            {{ ucfirst($item->status) }}
                        </td>


                        {{-- AKSI --}}
                        <td class="px-5 py-3">

                            <div class="flex items-center gap-3">

                                <a
                                    href="{{ route('ternak.edit', $item) }}"
                                    class="text-blue-600 hover:underline"
                                >
                                    Edit
                                </a>

                                <a
                                    href="{{ route('ternak.delete', $item) }}"
                                    class="text-red-600 hover:underline"
                                >
                                    Hapus
                                </a>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="8"
                            class="px-5 py-10 text-center text-gray-500"
                        >
                            Belum ada data ternak.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- PAGINATION --}}
    @if ($ternak->hasPages())

        <div class="p-5 border-t">

            {{ $ternak->links() }}

        </div>

    @endif

</div>

@endsection