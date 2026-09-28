@extends('layouts.ternak')

@section('content')

<div class="mb-6">

    <h1 class="text-2xl font-bold text-gray-800">
        Riwayat Penimbangan
    </h1>

    <p class="text-gray-500 mt-1">
        Riwayat seluruh proses penimbangan ternak.
    </p>

</div>


{{-- NOTIFIKASI --}}
@if (session('success'))

    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">

        <p class="text-sm text-green-700">
            {{ session('success') }}
        </p>

    </div>

@endif


@if (session('error'))

    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">

        <p class="text-sm text-red-700">
            {{ session('error') }}
        </p>

    </div>

@endif


<div class="bg-white rounded-lg shadow-sm">


    {{-- HEADER --}}
    <div class="p-5 border-b">

        <h2 class="font-semibold text-gray-800">
            Riwayat Data Penimbangan
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            Menampilkan data penimbangan beserta status verifikasinya.
        </p>

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
                        Tanggal
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
                        Bobot
                    </th>

                    <th class="px-5 py-3 text-left">
                        Metode
                    </th>

                    <th class="px-5 py-3 text-left">
                        Operator
                    </th>

                    <th class="px-5 py-3 text-left">
                        Status
                    </th>

                    <th class="px-5 py-3 text-left">
                        Verifikator
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse ($penimbangan as $item)

                    <tr class="border-b hover:bg-gray-50">


                        {{-- NOMOR --}}
                        <td class="px-5 py-3">
                            {{ $loop->iteration }}
                        </td>


                        {{-- TANGGAL --}}
                        <td class="px-5 py-3">

                            @if ($item->ditimbang_at)

                                {{ \Carbon\Carbon::parse($item->ditimbang_at)->format('d/m/Y H:i') }}

                            @else

                                -

                            @endif

                        </td>


                        {{-- KODE TERNAK --}}
                        <td class="px-5 py-3 font-medium text-gray-800">

                            {{ $item->ternak->kode_ternak ?? '-' }}

                        </td>


                        {{-- JENIS --}}
                        <td class="px-5 py-3">

                            {{ $item->ternak->jenisTernak->nama_jenis ?? '-' }}

                        </td>


                        {{-- LOKASI --}}
                        <td class="px-5 py-3">

                            {{ $item->ternak->lokasi->nama ?? '-' }}

                        </td>


                        {{-- BOBOT --}}
                        <td class="px-5 py-3 font-medium">

                            {{ $item->bobot }} kg

                        </td>


                        {{-- METODE --}}
                        <td class="px-5 py-3">

                            {{ ucfirst(str_replace('_', ' ', $item->metode)) }}

                        </td>


                        {{-- OPERATOR --}}
                        <td class="px-5 py-3">

                            {{ $item->operator->name ?? '-' }}

                        </td>


                        {{-- STATUS VERIFIKASI --}}
                        <td class="px-5 py-3">

                            @if ($item->status_verifikasi === 'menunggu')

                                <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-700">
                                    Menunggu
                                </span>

                            @elseif ($item->status_verifikasi === 'valid')

                                <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">
                                    Valid
                                </span>

                            @elseif ($item->status_verifikasi === 'kurang_akurat')

                                <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full bg-orange-100 text-orange-700">
                                    Kurang Akurat
                                </span>

                            @else

                                <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full bg-red-100 text-red-700">
                                    Tidak Valid
                                </span>

                            @endif

                        </td>


                        {{-- VERIFIKATOR --}}
                        <td class="px-5 py-3">

                            @if ($item->verifikator)

                                {{ $item->verifikator->name }}

                            @else

                                -

                            @endif

                        </td>


                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="10"
                            class="px-5 py-10 text-center text-gray-500"
                        >

                            Belum ada riwayat penimbangan.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- PAGINATION --}}
    @if (method_exists($penimbangan, 'hasPages') && $penimbangan->hasPages())

        <div class="p-5 border-t">

            {{ $penimbangan->links() }}

        </div>

    @endif

</div>

@endsection