@extends('layouts.ternak')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<div class="space-y-8">

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <div>
        <h2 class="text-2xl font-bold text-gray-900">
            Dashboard
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Ringkasan data Sistem Ternak Kurban
        </p>
    </div>


    {{-- ========================================================= --}}
    {{-- STATISTIK --}}
    {{-- ========================================================= --}}

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">


        {{-- TOTAL TERNAK --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Total Ternak
                    </p>

                    <p class="mt-3 text-3xl font-bold text-gray-900">
                        {{ $totalTernak }}
                    </p>

                    <p class="mt-2 text-xs text-gray-400">
                        Semua ternak terdaftar
                    </p>
                </div>

                <div class="w-12 h-12 rounded-xl bg-green-50 text-green-700 flex items-center justify-center">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M5 10h14l-1.5 8H6.5L5 10Z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M8 10V7a4 4 0 0 1 8 0v3"
                        />
                    </svg>

                </div>

            </div>

        </div>


        {{-- TERSEDIA --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Ternak Tersedia
                    </p>

                    <p class="mt-3 text-3xl font-bold text-green-600">
                        {{ $tersedia }}
                    </p>

                    <p class="mt-2 text-xs text-gray-400">
                        Siap untuk dipesan
                    </p>
                </div>

                <div class="w-12 h-12 rounded-xl bg-green-50 text-green-600 flex items-center justify-center">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m5 12 4 4L19 6"
                        />
                    </svg>

                </div>

            </div>

        </div>


        {{-- DIPESAN --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Ternak Dipesan
                    </p>

                    <p class="mt-3 text-3xl font-bold text-amber-500">
                        {{ $dipesan }}
                    </p>

                    <p class="mt-2 text-xs text-gray-400">
                        Sedang dalam proses
                    </p>
                </div>

                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3 4h18l-2 12H5L3 4Z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M7 20a1 1 0 1 0 0-2 1 1 0 0 0 0 2Zm10 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"
                        />
                    </svg>

                </div>

            </div>

        </div>


        {{-- LOKASI --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Total Lokasi
                    </p>

                    <p class="mt-3 text-3xl font-bold text-blue-600">
                        {{ $totalLokasi }}
                    </p>

                    <p class="mt-2 text-xs text-gray-400">
                        Lokasi peternakan
                    </p>
                </div>

                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 21s7-6.1 7-12a7 7 0 1 0-14 0c0 5.9 7 12 7 12Z"
                        />

                        <circle
                            cx="12"
                            cy="9"
                            r="2.5"
                        />
                    </svg>

                </div>

            </div>

        </div>


        {{-- PEMBELI --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Total Pembeli
                    </p>

                    <p class="mt-3 text-3xl font-bold text-purple-600">
                        {{ $totalPembeli }}
                    </p>

                    <p class="mt-2 text-xs text-gray-400">
                        Data pembeli
                    </p>
                </div>

                <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"
                        />

                        <circle
                            cx="8.5"
                            cy="7"
                            r="4"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M22 21v-2a4 4 0 0 0-3-3.87"
                        />
                    </svg>

                </div>

            </div>

        </div>


        {{-- VERIFIKASI --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Belum Diverifikasi
                    </p>

                    <p class="mt-3 text-3xl font-bold text-red-500">
                        {{ $belumDiverifikasi }}
                    </p>

                    <p class="mt-2 text-xs text-gray-400">
                        Menunggu pemeriksaan
                    </p>
                </div>

                <div class="w-12 h-12 rounded-xl bg-red-50 text-red-500 flex items-center justify-center">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 9v4"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 17h.01"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M10.3 4.2 2.7 17a2 2 0 0 0 1.7 3h15.2a2 2 0 0 0 1.7-3L13.7 4.2a2 2 0 0 0-3.4 0Z"
                        />
                    </svg>

                </div>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- DIAGRAM BARIS 1 --}}
    {{-- ========================================================= --}}

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">


        {{-- ===================================================== --}}
        {{-- DONUT CHART STATUS TERNAK --}}
        {{-- ===================================================== --}}

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

            <div class="mb-6">

                <h3 class="text-lg font-bold text-gray-900">
                    Status Ternak
                </h3>

                <p class="text-sm text-gray-400 mt-1">
                    Distribusi status seluruh ternak
                </p>

            </div>

            <div class="relative h-[320px]">

                <canvas id="statusTernakChart"></canvas>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- BAR CHART LOKASI --}}
        {{-- ===================================================== --}}

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

            <div class="mb-6">

                <h3 class="text-lg font-bold text-gray-900">
                    Ternak Berdasarkan Lokasi
                </h3>

                <p class="text-sm text-gray-400 mt-1">
                    Jumlah ternak pada setiap lokasi
                </p>

            </div>

            <div class="relative h-[320px]">

                <canvas id="lokasiTernakChart"></canvas>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- DIAGRAM BARIS 2 --}}
    {{-- ========================================================= --}}

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">


        {{-- ===================================================== --}}
        {{-- COLUMN CHART JENIS TERNAK --}}
        {{-- ===================================================== --}}

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

            <div class="mb-6">

                <h3 class="text-lg font-bold text-gray-900">
                    Ternak Berdasarkan Jenis
                </h3>

                <p class="text-sm text-gray-400 mt-1">
                    Jumlah ternak berdasarkan jenis
                </p>

            </div>

            <div class="relative h-[320px]">

                <canvas id="jenisTernakChart"></canvas>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- LINE CHART PENIMBANGAN --}}
        {{-- ===================================================== --}}

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

            <div class="mb-6">

                <h3 class="text-lg font-bold text-gray-900">
                    Riwayat Penimbangan
                </h3>

                <p class="text-sm text-gray-400 mt-1">
                    Perkembangan bobot penimbangan terbaru
                </p>

            </div>

            <div class="relative h-[320px]">

                <canvas id="penimbanganChart"></canvas>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- TABEL PENIMBANGAN TERBARU --}}
    {{-- ========================================================= --}}

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

        <div class="flex items-center justify-between mb-6">

            <div>

                <h3 class="text-lg font-bold text-gray-900">
                    Penimbangan Terbaru
                </h3>

                <p class="text-sm text-gray-400 mt-1">
                    Data penimbangan terakhir
                </p>

            </div>

            <a
                href="{{ route('penimbangan.riwayat') }}"
                class="text-sm font-semibold text-[#164A3A] hover:underline"
            >
                Lihat semua
            </a>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead>

                    <tr class="border-b border-gray-100">

                        <th class="text-left py-4 px-3 font-semibold text-gray-500">
                            Kode Ternak
                        </th>

                        <th class="text-left py-4 px-3 font-semibold text-gray-500">
                            Jenis
                        </th>

                        <th class="text-left py-4 px-3 font-semibold text-gray-500">
                            Lokasi
                        </th>

                        <th class="text-left py-4 px-3 font-semibold text-gray-500">
                            Bobot
                        </th>

                        <th class="text-left py-4 px-3 font-semibold text-gray-500">
                            Metode
                        </th>

                        <th class="text-left py-4 px-3 font-semibold text-gray-500">
                            Status
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($penimbanganTerbaru as $data)

                        <tr class="border-b border-gray-50 hover:bg-gray-50 transition">

                            <td class="py-4 px-3">

                                <span class="font-semibold text-gray-800">
                                    {{ $data->ternak->kode_ternak ?? '-' }}
                                </span>

                            </td>


                            <td class="py-4 px-3 text-gray-600">

                                {{ $data->ternak->jenisTernak->nama_jenis ?? '-' }}

                            </td>


                            <td class="py-4 px-3 text-gray-600">

                                {{ $data->ternak->lokasi->nama ?? '-' }}

                            </td>


                            <td class="py-4 px-3">

                                <span class="font-semibold text-[#164A3A]">
                                    {{ number_format((float) $data->bobot, 1) }} kg
                                </span>

                            </td>


                            <td class="py-4 px-3 text-gray-600">

                                {{ str_replace('_', ' ', ucfirst($data->metode)) }}

                            </td>


                            <td class="py-4 px-3">

                                @if($data->status_verifikasi === 'valid')

                                    <span class="inline-flex px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-medium">
                                        Valid
                                    </span>

                                @elseif($data->status_verifikasi === 'menunggu')

                                    <span class="inline-flex px-3 py-1 rounded-full bg-amber-100 text-amber-700 text-xs font-medium">
                                        Menunggu
                                    </span>

                                @elseif($data->status_verifikasi === 'kurang_akurat')

                                    <span class="inline-flex px-3 py-1 rounded-full bg-orange-100 text-orange-700 text-xs font-medium">
                                        Kurang Akurat
                                    </span>

                                @else

                                    <span class="inline-flex px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-medium">
                                        Tidak Valid
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="text-center py-10 text-gray-400"
                            >
                                Belum ada data penimbangan.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


</div>


{{-- ============================================================= --}}
{{-- CHART.JS --}}
{{-- ============================================================= --}}

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | DATA STATUS TERNAK
    |--------------------------------------------------------------------------
    */

    const statusTernak = {
        tersedia: {{ $tersedia }},
        dipesan: {{ $dipesan }},
        terkirim: {{ $terkirim }},
        disembelih: {{ $disembelih }}
    };


    /*
    |--------------------------------------------------------------------------
    | DONUT CHART STATUS TERNAK
    |--------------------------------------------------------------------------
    */

    const statusCanvas = document.getElementById('statusTernakChart');

    if (statusCanvas) {

        new Chart(statusCanvas, {

            type: 'doughnut',

            data: {

                labels: [
                    'Tersedia',
                    'Dipesan',
                    'Terkirim',
                    'Disembelih'
                ],

                datasets: [{

                    data: [
                        statusTernak.tersedia,
                        statusTernak.dipesan,
                        statusTernak.terkirim,
                        statusTernak.disembelih
                    ],

                    backgroundColor: [
                        '#22c55e',
                        '#f59e0b',
                        '#3b82f6',
                        '#9ca3af'
                    ],

                    borderWidth: 0,

                    hoverOffset: 8

                }]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                cutout: '68%',

                plugins: {

                    legend: {

                        position: 'bottom',

                        labels: {
                            usePointStyle: true,
                            padding: 20
                        }

                    }

                }

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | BAR CHART TERNAK PER LOKASI
    |--------------------------------------------------------------------------
    */

    const lokasiCanvas = document.getElementById('lokasiTernakChart');

    if (lokasiCanvas) {

        new Chart(lokasiCanvas, {

            type: 'bar',

            data: {

                labels: [

                    @foreach($ternakPerLokasi as $lokasi)

                        @json($lokasi->nama),

                    @endforeach

                ],

                datasets: [{

                    label: 'Jumlah Ternak',

                    data: [

                        @foreach($ternakPerLokasi as $lokasi)

                            {{ $lokasi->ternak_count }},

                        @endforeach

                    ],

                    backgroundColor: '#164A3A',

                    borderRadius: 8,

                    borderSkipped: false

                }]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                scales: {

                    y: {

                        beginAtZero: true,

                        ticks: {

                            precision: 0

                        }

                    },

                    x: {

                        grid: {
                            display: false
                        }

                    }

                },

                plugins: {

                    legend: {
                        display: false
                    }

                }

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | COLUMN CHART JENIS TERNAK
    |--------------------------------------------------------------------------
    */

    const jenisCanvas = document.getElementById('jenisTernakChart');

    if (jenisCanvas) {

        new Chart(jenisCanvas, {

            type: 'bar',

            data: {

                labels: [

                    @foreach($ternakPerJenis as $jenis)

                        @json($jenis->nama_jenis),

                    @endforeach

                ],

                datasets: [{

                    label: 'Jumlah Ternak',

                    data: [

                        @foreach($ternakPerJenis as $jenis)

                            {{ $jenis->ternak_count }},

                        @endforeach

                    ],

                    backgroundColor: '#5E9278',

                    borderRadius: 8,

                    borderSkipped: false

                }]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                scales: {

                    y: {

                        beginAtZero: true,

                        ticks: {
                            precision: 0
                        }

                    },

                    x: {

                        grid: {
                            display: false
                        }

                    }

                },

                plugins: {

                    legend: {
                        display: false
                    }

                }

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | LINE CHART PENIMBANGAN
    |--------------------------------------------------------------------------
    */

    const penimbanganCanvas = document.getElementById('penimbanganChart');


    if (penimbanganCanvas) {

        new Chart(penimbanganCanvas, {

            type: 'line',

            data: {

                labels: [

                    @foreach($dataPenimbangan as $data)

                        @json(
                            $data->ditimbang_at
                                ? $data->ditimbang_at->format('d/m H:i')
                                : '-'
                        ),

                    @endforeach

                ],

                datasets: [{

                    label: 'Bobot Ternak (kg)',

                    data: [

                        @foreach($dataPenimbangan as $data)

                            {{ (float) $data->bobot }},

                        @endforeach

                    ],

                    borderColor: '#164A3A',

                    backgroundColor: 'rgba(22, 74, 58, 0.10)',

                    pointBackgroundColor: '#164A3A',

                    pointBorderColor: '#ffffff',

                    pointBorderWidth: 2,

                    pointRadius: 5,

                    pointHoverRadius: 7,

                    borderWidth: 2,

                    tension: 0.35,

                    fill: true

                }]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                interaction: {

                    intersect: false,

                    mode: 'index'

                },

                scales: {

                    y: {

                        beginAtZero: true,

                        title: {

                            display: true,

                            text: 'Bobot (kg)'

                        }

                    },

                    x: {

                        grid: {
                            display: false
                        }

                    }

                },

                plugins: {

                    legend: {

                        display: true,

                        position: 'bottom',

                        labels: {
                            usePointStyle: true
                        }

                    }

                }

            }

        });

    }

});

</script>

@endsection