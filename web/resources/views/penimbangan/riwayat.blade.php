@extends('layouts.ternak')

@section('title', 'Riwayat Penimbangan')
@section('page-title', 'Riwayat Penimbangan')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>

            <h2 class="text-2xl font-bold text-gray-900">
                Riwayat Penimbangan
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Riwayat seluruh proses penimbangan ternak.
            </p>

        </div>

        <a
            href="{{ route('penimbangan.create') }}"
            class="inline-flex items-center justify-center gap-2
                   px-5 py-3
                   bg-[#164A3A]
                   text-white
                   text-sm font-medium
                   rounded-lg
                   hover:bg-[#0f382c]
                   transition">

            <svg
                class="w-5 h-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 4v16m8-8H4" />

            </svg>

            Tambah Penimbangan

        </a>

    </div>


    {{-- NOTIFIKASI SUCCESS --}}
    @if(session('success'))

        <div
            class="flex items-start gap-3
                   p-4
                   bg-green-50
                   border border-green-200
                   rounded-xl">

            <div
                class="w-8 h-8 rounded-full
                       bg-green-100
                       flex items-center
                       justify-center
                       flex-shrink-0">

                <svg
                    class="w-5 h-5 text-green-600"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M5 13l4 4L19 7" />

                </svg>

            </div>

            <div>

                <p class="text-sm font-semibold text-green-800">
                    Berhasil
                </p>

                <p class="text-sm text-green-700 mt-0.5">
                    {{ session('success') }}
                </p>

            </div>

        </div>

    @endif


    {{-- NOTIFIKASI ERROR --}}
    @if(session('error'))

        <div
            class="flex items-start gap-3
                   p-4
                   bg-red-50
                   border border-red-200
                   rounded-xl">

            <div
                class="w-8 h-8 rounded-full
                       bg-red-100
                       flex items-center
                       justify-center
                       flex-shrink-0">

                <svg
                    class="w-5 h-5 text-red-600"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />

                </svg>

            </div>

            <div>

                <p class="text-sm font-semibold text-red-800">
                    Terjadi Kesalahan
                </p>

                <p class="text-sm text-red-700 mt-0.5">
                    {{ session('error') }}
                </p>

            </div>

        </div>

    @endif


    {{-- CARD RIWAYAT --}}
    <div
        class="bg-white
               rounded-xl
               border border-gray-200
               shadow-sm
               overflow-hidden">

        {{-- HEADER CARD --}}
        <div
            class="px-6 py-5
                   border-b border-gray-200">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                <div>

                    <h3 class="text-lg font-semibold text-gray-900">
                        Riwayat Data Penimbangan
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Menampilkan data penimbangan beserta status verifikasinya.
                    </p>

                </div>

                <div
                    class="text-sm text-gray-500">

                    Total:
                    <span class="font-semibold text-gray-800">
                        {{ $penimbangan->total() }}
                    </span>
                    data

                </div>

            </div>

        </div>


        {{-- TABLE --}}
        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-50 border-b border-gray-200">

                    <tr>

                        <th
                            class="px-5 py-4 text-left
                                   font-semibold text-gray-600
                                   whitespace-nowrap">
                            No
                        </th>

                        <th
                            class="px-5 py-4 text-left
                                   font-semibold text-gray-600
                                   whitespace-nowrap">
                            Tanggal
                        </th>

                        <th
                            class="px-5 py-4 text-left
                                   font-semibold text-gray-600
                                   whitespace-nowrap">
                            Kode Ternak
                        </th>

                        <th
                            class="px-5 py-4 text-left
                                   font-semibold text-gray-600
                                   whitespace-nowrap">
                            Jenis
                        </th>

                        <th
                            class="px-5 py-4 text-left
                                   font-semibold text-gray-600
                                   whitespace-nowrap">
                            Lokasi
                        </th>

                        <th
                            class="px-5 py-4 text-left
                                   font-semibold text-gray-600
                                   whitespace-nowrap">
                            Bobot
                        </th>

                        <th
                            class="px-5 py-4 text-left
                                   font-semibold text-gray-600
                                   whitespace-nowrap">
                            Metode
                        </th>

                        <th
                            class="px-5 py-4 text-left
                                   font-semibold text-gray-600
                                   whitespace-nowrap">
                            Operator
                        </th>

                        <th
                            class="px-5 py-4 text-left
                                   font-semibold text-gray-600
                                   whitespace-nowrap">
                            Status
                        </th>

                        <th
                            class="px-5 py-4 text-left
                                   font-semibold text-gray-600
                                   whitespace-nowrap">
                            Verifikator
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse ($penimbangan as $item)

                        <tr class="hover:bg-gray-50 transition">


                            {{-- NOMOR --}}
                            <td class="px-5 py-4 text-gray-500">

                                {{ $penimbangan->firstItem() + $loop->index }}

                            </td>


                            {{-- TANGGAL --}}
                            <td class="px-5 py-4">

                                @if ($item->ditimbang_at)

                                    <div class="font-medium text-gray-800">

                                        {{ $item->ditimbang_at->format('d/m/Y') }}

                                    </div>

                                    <div class="text-xs text-gray-400 mt-1">

                                        {{ $item->ditimbang_at->format('H:i') }}

                                    </div>

                                @else

                                    <span class="text-gray-400">
                                        -
                                    </span>

                                @endif

                            </td>


                            {{-- KODE TERNAK --}}
                            <td class="px-5 py-4">

                                <div class="font-semibold text-gray-900">

                                    {{ $item->ternak->kode_ternak ?? '-' }}

                                </div>

                            </td>


                            {{-- JENIS --}}
                            <td class="px-5 py-4">

                                <span class="text-gray-700">

                                    {{ $item->ternak->jenisTernak->nama_jenis ?? '-' }}

                                </span>

                            </td>


                            {{-- LOKASI --}}
                            <td class="px-5 py-4">

                                <span class="text-gray-600">

                                    {{ $item->ternak->lokasi->nama ?? '-' }}

                                </span>

                            </td>


                            {{-- BOBOT --}}
                            <td class="px-5 py-4">

                                <span class="font-semibold text-gray-900">

                                    {{ number_format((float) $item->bobot, 1, ',', '.') }}

                                </span>

                                <span class="text-gray-500">
                                    kg
                                </span>

                            </td>


                            {{-- METODE --}}
                            <td class="px-5 py-4">

                                @php

                                    $metodeLabel = match($item->metode) {

                                        'manual' => 'Manual',

                                        'estimasi' => 'Estimasi',

                                        'otomatis_iot' => 'Otomatis IoT',

                                        default => ucfirst(
                                            str_replace('_', ' ', $item->metode)
                                        ),

                                    };

                                @endphp

                                <span
                                    class="inline-flex
                                           px-2.5 py-1
                                           rounded-lg
                                           text-xs font-medium
                                           bg-gray-100
                                           text-gray-700">

                                    {{ $metodeLabel }}

                                </span>

                            </td>


                            {{-- OPERATOR --}}
                            <td class="px-5 py-4">

                                @if ($item->operator)

                                    <div class="flex items-center gap-2">

                                        <div
                                            class="w-8 h-8
                                                   rounded-full
                                                   bg-[#164A3A]
                                                   text-white
                                                   flex items-center
                                                   justify-center
                                                   text-xs
                                                   font-semibold">

                                            {{ strtoupper(substr($item->operator->name, 0, 1)) }}

                                        </div>

                                        <span class="text-gray-700">

                                            {{ $item->operator->name }}

                                        </span>

                                    </div>

                                @else

                                    <span class="text-gray-400">
                                        -
                                    </span>

                                @endif

                            </td>


                            {{-- STATUS --}}
                            <td class="px-5 py-4">

                                @if ($item->status_verifikasi === 'menunggu')

                                    <span
                                        class="inline-flex items-center gap-1.5
                                               px-3 py-1.5
                                               text-xs font-medium
                                               rounded-full
                                               bg-yellow-100
                                               text-yellow-700">

                                        <span
                                            class="w-1.5 h-1.5
                                                   rounded-full
                                                   bg-yellow-500">
                                        </span>

                                        Menunggu

                                    </span>

                                @elseif ($item->status_verifikasi === 'valid')

                                    <span
                                        class="inline-flex items-center gap-1.5
                                               px-3 py-1.5
                                               text-xs font-medium
                                               rounded-full
                                               bg-green-100
                                               text-green-700">

                                        <span
                                            class="w-1.5 h-1.5
                                                   rounded-full
                                                   bg-green-500">
                                        </span>

                                        Valid

                                    </span>

                                @elseif ($item->status_verifikasi === 'kurang_akurat')

                                    <span
                                        class="inline-flex items-center gap-1.5
                                               px-3 py-1.5
                                               text-xs font-medium
                                               rounded-full
                                               bg-orange-100
                                               text-orange-700">

                                        <span
                                            class="w-1.5 h-1.5
                                                   rounded-full
                                                   bg-orange-500">
                                        </span>

                                        Kurang Akurat

                                    </span>

                                @else

                                    <span
                                        class="inline-flex items-center gap-1.5
                                               px-3 py-1.5
                                               text-xs font-medium
                                               rounded-full
                                               bg-red-100
                                               text-red-700">

                                        <span
                                            class="w-1.5 h-1.5
                                                   rounded-full
                                                   bg-red-500">
                                        </span>

                                        Tidak Valid

                                    </span>

                                @endif

                            </td>


                            {{-- VERIFIKATOR --}}
                            <td class="px-5 py-4">

                                @if ($item->verifikator)

                                    <div class="flex items-center gap-2">

                                        <div
                                            class="w-8 h-8
                                                   rounded-full
                                                   bg-gray-200
                                                   text-gray-600
                                                   flex items-center
                                                   justify-center
                                                   text-xs
                                                   font-semibold">

                                            {{ strtoupper(substr($item->verifikator->name, 0, 1)) }}

                                        </div>

                                        <span class="text-gray-700">

                                            {{ $item->verifikator->name }}

                                        </span>

                                    </div>

                                @else

                                    <span class="text-gray-400">
                                        Belum diverifikasi
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="10"
                                class="px-5 py-14 text-center">

                                <div
                                    class="flex flex-col
                                           items-center
                                           justify-center">

                                    <div
                                        class="w-16 h-16
                                               rounded-full
                                               bg-gray-100
                                               flex items-center
                                               justify-center">

                                        <svg
                                            class="w-8 h-8 text-gray-400"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24">

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z" />

                                        </svg>

                                    </div>

                                    <h3
                                        class="mt-4
                                               font-semibold
                                               text-gray-800">

                                        Belum Ada Riwayat

                                    </h3>

                                    <p
                                        class="mt-1
                                               text-sm
                                               text-gray-500">

                                        Belum ada riwayat penimbangan yang tersimpan.

                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        @if($penimbangan->hasPages())

            <div
                class="px-5 py-4
                       border-t border-gray-200">

                {{ $penimbangan->links() }}

            </div>

        @endif

    </div>

</div>

@endsection