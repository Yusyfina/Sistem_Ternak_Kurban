@extends('layouts.ternak')

@section('title', 'Detail Ternak')
@section('page-title', 'Detail Ternak')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <div class="flex items-center gap-2 text-sm text-gray-500">
                <a href="{{ route('ternak.index') }}"
                   class="hover:text-[#164A3A]">
                    Data Ternak
                </a>

                <span>/</span>

                <span>Detail</span>
            </div>

            <div class="mt-2 flex items-center gap-3">

                <h1 class="text-2xl font-bold text-gray-900">
                    {{ $ternak->kode_ternak }}
                </h1>

                @php
                    $statusClass = match($ternak->status) {
                        'tersedia' => 'bg-green-50 text-green-700 ring-green-600/20',
                        'dipesan' => 'bg-amber-50 text-amber-700 ring-amber-600/20',
                        'terkirim' => 'bg-blue-50 text-blue-700 ring-blue-600/20',
                        'disembelih' => 'bg-gray-100 text-gray-700 ring-gray-500/20',
                        default => 'bg-gray-100 text-gray-600 ring-gray-500/20',
                    };
                @endphp

                <span class="inline-flex items-center rounded-full
                             px-2.5 py-1 text-xs font-semibold
                             capitalize ring-1 ring-inset
                             {{ $statusClass }}">

                    {{ str_replace('_', ' ', $ternak->status) }}

                </span>

            </div>

            <p class="mt-1 text-sm text-gray-500">
                Detail informasi ternak dan riwayat penimbangan.
            </p>

        </div>


        {{-- ACTION --}}
        <div class="flex flex-wrap gap-2">

            <a href="{{ route('ternak.index') }}"
               class="inline-flex items-center justify-center gap-2
                      rounded-lg border border-gray-300 bg-white
                      px-4 py-2.5 text-sm font-semibold text-gray-700
                      transition hover:bg-gray-50">

                Kembali

            </a>

            <a href="{{ route('ternak.edit', $ternak) }}"
               class="inline-flex items-center justify-center gap-2
                      rounded-lg bg-[#164A3A] px-4 py-2.5
                      text-sm font-semibold text-white
                      transition hover:bg-[#123d30]">

                Edit Data

            </a>

        </div>

    </div>


    {{-- INFORMASI UTAMA --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

        {{-- DATA UTAMA --}}
        <div class="lg:col-span-2 overflow-hidden rounded-xl
                    border border-gray-200 bg-white shadow-sm">

            <div class="border-b border-gray-200 px-6 py-5">

                <h2 class="text-lg font-semibold text-gray-900">
                    Informasi Ternak
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Informasi utama dari ternak.
                </p>

            </div>


            <div class="grid grid-cols-1 gap-x-8 gap-y-6 p-6 sm:grid-cols-2">

                {{-- KODE --}}
                <div>

                    <p class="text-sm text-gray-500">
                        Kode Ternak
                    </p>

                    <p class="mt-1 text-sm font-semibold text-gray-900">
                        {{ $ternak->kode_ternak }}
                    </p>

                </div>


                {{-- RFID --}}
                <div>

                    <p class="text-sm text-gray-500">
                        Kode RFID
                    </p>

                    <p class="mt-1 font-mono text-sm font-semibold text-gray-900">
                        {{ $ternak->kode_rfid ?? '-' }}
                    </p>

                </div>


                {{-- JENIS --}}
                <div>

                    <p class="text-sm text-gray-500">
                        Jenis Ternak
                    </p>

                    <p class="mt-1 text-sm font-semibold text-gray-900">
                        {{ $ternak->jenisTernak->nama_jenis ?? '-' }}
                    </p>

                    @if($ternak->jenisTernak)
                        <p class="mt-1 text-xs capitalize text-gray-500">
                            {{ $ternak->jenisTernak->spesies }}
                        </p>
                    @endif

                </div>


                {{-- LOKASI --}}
                <div>

                    <p class="text-sm text-gray-500">
                        Lokasi Peternakan
                    </p>

                    <p class="mt-1 text-sm font-semibold text-gray-900">
                        {{ $ternak->lokasi->nama ?? '-' }}
                    </p>

                </div>


                {{-- BOBOT --}}
                <div>

                    <p class="text-sm text-gray-500">
                        Bobot Terakhir
                    </p>

                    @if($ternak->bobot_terakhir !== null)

                        <p class="mt-1 text-xl font-bold text-[#164A3A]">
                            {{ number_format($ternak->bobot_terakhir, 1, ',', '.') }}
                            <span class="text-sm font-medium text-gray-500">
                                kg
                            </span>
                        </p>

                    @else

                        <p class="mt-1 text-sm text-gray-400">
                            Belum ada data
                        </p>

                    @endif

                </div>


                {{-- STATUS --}}
                <div>

                    <p class="text-sm text-gray-500">
                        Status Ternak
                    </p>

                    <div class="mt-2">

                        <span class="inline-flex items-center rounded-full
                                     px-2.5 py-1 text-xs font-semibold
                                     capitalize ring-1 ring-inset
                                     {{ $statusClass }}">

                            {{ str_replace('_', ' ', $ternak->status) }}

                        </span>

                    </div>

                </div>

            </div>

        </div>


        {{-- RINGKASAN --}}
        <div class="overflow-hidden rounded-xl border border-gray-200
                    bg-white shadow-sm">

            <div class="border-b border-gray-200 px-6 py-5">

                <h2 class="text-lg font-semibold text-gray-900">
                    Ringkasan
                </h2>

            </div>

            <div class="space-y-5 p-6">

                <div>

                    <p class="text-sm text-gray-500">
                        Total Penimbangan
                    </p>

                    <p class="mt-1 text-2xl font-bold text-gray-900">
                        {{ $ternak->penimbangan->count() }}
                    </p>

                </div>


                <div class="border-t border-gray-100 pt-5">

                    <p class="text-sm text-gray-500">
                        Status Saat Ini
                    </p>

                    <p class="mt-1 text-sm font-semibold capitalize text-gray-900">
                        {{ str_replace('_', ' ', $ternak->status) }}
                    </p>

                </div>


                <div class="border-t border-gray-100 pt-5">

                    <p class="text-sm text-gray-500">
                        Lokasi
                    </p>

                    <p class="mt-1 text-sm font-semibold text-gray-900">
                        {{ $ternak->lokasi->nama ?? '-' }}
                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- RIWAYAT PENIMBANGAN --}}
    <div class="overflow-hidden rounded-xl border border-gray-200
                bg-white shadow-sm">

        <div class="flex flex-col gap-2 border-b border-gray-200
                    px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <h2 class="text-lg font-semibold text-gray-900">
                    Riwayat Penimbangan
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Riwayat pengukuran bobot untuk ternak ini.
                </p>

            </div>

            <span class="text-sm text-gray-500">
                {{ $ternak->penimbangan->count() }} data
            </span>

        </div>


        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-3 text-left text-xs font-semibold
                                   uppercase tracking-wider text-gray-500">
                            Tanggal
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold
                                   uppercase tracking-wider text-gray-500">
                            Bobot
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold
                                   uppercase tracking-wider text-gray-500">
                            Metode
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold
                                   uppercase tracking-wider text-gray-500">
                            Sumber
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold
                                   uppercase tracking-wider text-gray-500">
                            Verifikasi
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100 bg-white">

                    @forelse($ternak->penimbangan->sortByDesc('ditimbang_at') as $data)

                        <tr class="hover:bg-gray-50">

                            {{-- TANGGAL --}}
                            <td class="whitespace-nowrap px-6 py-4">

                                <p class="text-sm font-medium text-gray-800">
                                    {{ $data->ditimbang_at?->format('d M Y') ?? '-' }}
                                </p>

                                <p class="mt-1 text-xs text-gray-500">
                                    {{ $data->ditimbang_at?->format('H:i') ?? '-' }}
                                </p>

                            </td>


                            {{-- BOBOT --}}
                            <td class="whitespace-nowrap px-6 py-4">

                                <span class="text-sm font-semibold text-gray-900">
                                    {{ number_format($data->bobot, 1, ',', '.') }}
                                    kg
                                </span>

                            </td>


                            {{-- METODE --}}
                            <td class="whitespace-nowrap px-6 py-4">

                                <span class="text-sm capitalize text-gray-700">
                                    {{ str_replace('_', ' ', $data->metode) }}
                                </span>

                            </td>


                            {{-- SUMBER --}}
                            <td class="whitespace-nowrap px-6 py-4">

                                <span class="text-sm capitalize text-gray-700">
                                    {{ str_replace('_', ' ', $data->sumber) }}
                                </span>

                            </td>


                            {{-- VERIFIKASI --}}
                            <td class="whitespace-nowrap px-6 py-4">

                                @php
                                    $verifikasiClass = match($data->status_verifikasi) {
                                        'valid' => 'bg-green-50 text-green-700 ring-green-600/20',
                                        'menunggu' => 'bg-amber-50 text-amber-700 ring-amber-600/20',
                                        'kurang_akurat' => 'bg-orange-50 text-orange-700 ring-orange-600/20',
                                        'tidak_valid' => 'bg-red-50 text-red-700 ring-red-600/20',
                                        default => 'bg-gray-100 text-gray-600 ring-gray-500/20',
                                    };
                                @endphp

                                <span class="inline-flex items-center rounded-full
                                             px-2.5 py-1 text-xs font-semibold
                                             capitalize ring-1 ring-inset
                                             {{ $verifikasiClass }}">

                                    {{ str_replace('_', ' ', $data->status_verifikasi) }}

                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5"
                                class="px-6 py-12 text-center">

                                <p class="text-sm font-semibold text-gray-900">
                                    Belum ada riwayat penimbangan
                                </p>

                                <p class="mt-1 text-sm text-gray-500">
                                    Data penimbangan untuk ternak ini belum tersedia.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- DANGER ZONE --}}
    <div class="rounded-xl border border-red-200 bg-white shadow-sm">

        <div class="border-b border-red-100 px-6 py-5">

            <h2 class="text-lg font-semibold text-red-700">
                Hapus Data
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Penghapusan hanya dapat dilakukan jika ternak belum memiliki
                riwayat penimbangan.
            </p>

        </div>

        <div class="flex flex-col gap-4 px-6 py-5 sm:flex-row
                    sm:items-center sm:justify-between">

            <div>

                <p class="text-sm font-medium text-gray-800">
                    Hapus {{ $ternak->kode_ternak }}
                </p>

                <p class="mt-1 text-sm text-gray-500">
                    Tindakan ini tidak dapat dibatalkan.
                </p>

            </div>

            <a href="{{ route('ternak.delete', $ternak) }}"
               class="inline-flex items-center justify-center rounded-lg
                      border border-red-200 bg-red-50 px-4 py-2.5
                      text-sm font-semibold text-red-600
                      transition hover:bg-red-100">

                Hapus Ternak

            </a>

        </div>

    </div>

</div>

@endsection