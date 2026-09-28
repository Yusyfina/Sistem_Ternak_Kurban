@extends('layouts.ternak')

@section('title', 'Penimbangan')
@section('page-title', 'Penimbangan')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>
            <h2 class="text-2xl font-bold text-gray-900">
                Penimbangan
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Daftar data penimbangan ternak yang masuk ke sistem.
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
                       flex items-center justify-center
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
                       flex items-center justify-center
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


    {{-- RINGKASAN --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

        {{-- TOTAL --}}
        <div
            class="bg-white
                   border border-gray-200
                   rounded-xl
                   p-5
                   shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Total Penimbangan
                    </p>

                    <p class="text-2xl font-bold text-gray-900 mt-1">
                        {{ $penimbangan->total() }}
                    </p>
                </div>

                <div
                    class="w-11 h-11 rounded-xl
                           bg-green-50
                           flex items-center justify-center">

                    <svg
                        class="w-6 h-6 text-[#164A3A]"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 17l6-6 4 4 8-8" />

                    </svg>

                </div>

            </div>

        </div>


        {{-- MENUNGGU --}}
        <div
            class="bg-white
                   border border-gray-200
                   rounded-xl
                   p-5
                   shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Menunggu Verifikasi
                    </p>

                    <p class="text-2xl font-bold text-gray-900 mt-1">
                        {{ $penimbangan->getCollection()->where('status_verifikasi', 'menunggu')->count() }}
                    </p>
                </div>

                <div
                    class="w-11 h-11 rounded-xl
                           bg-yellow-50
                           flex items-center justify-center">

                    <svg
                        class="w-6 h-6 text-yellow-600"
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

            </div>

        </div>


        {{-- VALID --}}
        <div
            class="bg-white
                   border border-gray-200
                   rounded-xl
                   p-5
                   shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Data Valid
                    </p>

                    <p class="text-2xl font-bold text-gray-900 mt-1">
                        {{ $penimbangan->getCollection()->where('status_verifikasi', 'valid')->count() }}
                    </p>
                </div>

                <div
                    class="w-11 h-11 rounded-xl
                           bg-green-50
                           flex items-center justify-center">

                    <svg
                        class="w-6 h-6 text-green-600"
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

            </div>

        </div>

    </div>


    {{-- CARD DATA --}}
    <div
        class="bg-white
               rounded-xl
               border border-gray-200
               shadow-sm
               overflow-hidden">

        {{-- HEADER CARD --}}
        <div
            class="px-6 py-5
                   border-b border-gray-200
                   flex flex-col sm:flex-row
                   sm:items-center
                   sm:justify-between
                   gap-3">

            <div>

                <h3 class="text-lg font-semibold text-gray-900">
                    Data Penimbangan
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    Data penimbangan yang perlu diperiksa atau diverifikasi.
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
                            Sumber
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

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse ($penimbangan as $item)

                        <tr class="hover:bg-gray-50 transition">


                            {{-- NOMOR --}}
                            <td class="px-5 py-4 text-gray-500">

                                {{ $penimbangan->firstItem() + $loop->index }}

                            </td>


                            {{-- KODE TERNAK --}}
                            <td class="px-5 py-4">

                                <div class="font-semibold text-gray-900">

                                    {{ $item->ternak->kode_ternak ?? '-' }}

                                </div>

                            </td>


                            {{-- JENIS --}}
                            <td class="px-5 py-4">

                                <div class="font-medium text-gray-800">

                                    {{ $item->ternak->jenisTernak->nama_jenis ?? '-' }}

                                </div>

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
                                    class="inline-flex items-center
                                           px-2.5 py-1
                                           rounded-lg
                                           text-xs font-medium
                                           bg-gray-100
                                           text-gray-700">

                                    {{ $metodeLabel }}

                                </span>

                            </td>


                            {{-- SUMBER --}}
                            <td class="px-5 py-4">

                                @php

                                    $sumberLabel = match($item->sumber) {

                                        'manual_entry' => 'Manual Entry',

                                        'otomatis_iot' => 'Otomatis IoT',

                                        'data_manajemen' => 'Data Manajemen',

                                        'tidak_ada_data' => 'Tidak Ada Data',

                                        default => ucfirst(
                                            str_replace('_', ' ', $item->sumber)
                                        ),

                                    };

                                @endphp

                                <span class="text-gray-600">
                                    {{ $sumberLabel }}
                                </span>

                            </td>


                            {{-- OPERATOR --}}
                            <td class="px-5 py-4">

                                @if($item->operator)

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

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="8"
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
                                                d="M3 7h18M5 7v13h14V7M9 7V4h6v3" />

                                        </svg>

                                    </div>

                                    <h3
                                        class="mt-4
                                               font-semibold
                                               text-gray-800">

                                        Belum Ada Data Penimbangan

                                    </h3>

                                    <p
                                        class="mt-1
                                               text-sm
                                               text-gray-500">

                                        Belum ada data penimbangan yang masuk ke sistem.

                                    </p>

                                    <a
                                        href="{{ route('penimbangan.create') }}"
                                        class="mt-4
                                               inline-flex
                                               items-center gap-2
                                               px-4 py-2
                                               bg-[#164A3A]
                                               text-white
                                               text-sm font-medium
                                               rounded-lg
                                               hover:bg-[#0f382c]">

                                        + Tambah Penimbangan

                                    </a>

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