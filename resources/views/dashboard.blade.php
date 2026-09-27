@extends('layouts.ternak')

@section('content')

    <div class="mb-8">
        <h2 class="text-2xl font-bold">
            Dashboard
        </h2>

        <p class="text-gray-500 mt-1">
            Ringkasan data Sistem Ternak Kurban
        </p>
    </div>


    {{-- STATISTIK --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        {{-- Total Ternak --}}
        <div class="bg-white rounded-xl shadow-sm p-6">
            <p class="text-gray-500 text-sm">
                Total Ternak
            </p>

            <h3 class="text-3xl font-bold mt-2">
                {{ $totalTernak }}
            </h3>
        </div>


        {{-- Tersedia --}}
        <div class="bg-white rounded-xl shadow-sm p-6">
            <p class="text-gray-500 text-sm">
                Ternak Tersedia
            </p>

            <h3 class="text-3xl font-bold mt-2">
                {{ $tersedia }}
            </h3>
        </div>


        {{-- Dipesan --}}
        <div class="bg-white rounded-xl shadow-sm p-6">
            <p class="text-gray-500 text-sm">
                Ternak Dipesan
            </p>

            <h3 class="text-3xl font-bold mt-2">
                {{ $dipesan }}
            </h3>
        </div>


        {{-- Lokasi --}}
        <div class="bg-white rounded-xl shadow-sm p-6">
            <p class="text-gray-500 text-sm">
                Total Lokasi
            </p>

            <h3 class="text-3xl font-bold mt-2">
                {{ $totalLokasi }}
            </h3>
        </div>


        {{-- Pembeli --}}
        <div class="bg-white rounded-xl shadow-sm p-6">
            <p class="text-gray-500 text-sm">
                Total Pembeli
            </p>

            <h3 class="text-3xl font-bold mt-2">
                {{ $totalPembeli }}
            </h3>
        </div>


        {{-- Belum Verifikasi --}}
        <div class="bg-white rounded-xl shadow-sm p-6">
            <p class="text-gray-500 text-sm">
                Belum Diverifikasi
            </p>

            <h3 class="text-3xl font-bold mt-2">
                {{ $belumDiverifikasi }}
            </h3>
        </div>

    </div>


    {{-- DATA TERNAK --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">

        {{-- Berdasarkan Lokasi --}}
        <div class="bg-white rounded-xl shadow-sm p-6">

            <h3 class="text-lg font-semibold mb-4">
                Ternak Berdasarkan Lokasi
            </h3>

            <div class="space-y-3">

                @foreach($ternakPerLokasi as $lokasi)

                    <div class="flex justify-between border-b pb-2">

                        <span>
                            {{ $lokasi -> nama }}
                        </span>

                        <span class="font-semibold">
                            {{ $lokasi->ternak_count }}
                        </span>

                    </div>

                @endforeach

            </div>

        </div>


        {{-- Berdasarkan Jenis --}}
        <div class="bg-white rounded-xl shadow-sm p-6">

            <h3 class="text-lg font-semibold mb-4">
                Ternak Berdasarkan Jenis
            </h3>

            <div class="space-y-3">

                @foreach($ternakPerJenis as $jenis)

                    <div class="flex justify-between border-b pb-2">

                        <span>
                            {{ $jenis->nama_jenis }}
                        </span>

                        <span class="font-semibold">
                            {{ $jenis->ternak_count }}
                        </span>

                    </div>

                @endforeach

            </div>

        </div>

    </div>


    {{-- PENIMBANGAN TERBARU --}}
    <div class="bg-white rounded-xl shadow-sm p-6 mt-8">

        <h3 class="text-lg font-semibold mb-4">
            Penimbangan Terbaru
        </h3>

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead>
                    <tr class="border-b">

                        <th class="text-left py-3">
                            Kode Ternak
                        </th>

                        <th class="text-left py-3">
                            Lokasi
                        </th>

                        <th class="text-left py-3">
                            Bobot
                        </th>

                        <th class="text-left py-3">
                            Status
                        </th>

                    </tr>
                </thead>

                <tbody>

                    @forelse($penimbanganTerbaru as $data)

                        <tr class="border-b">

                            <td class="py-3">
                                {{ $data->ternak->kode_ternak }}
                            </td>

                            <td class="py-3">
                                {{ $data->ternak->lokasi->nama }}
                            </td>

                            <td class="py-3">
                                {{ $data->bobot }} kg
                            </td>

                            <td class="py-3">
                                {{ $data->status_verifikasi }}
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="4"
                                class="text-center py-6 text-gray-500">

                                Belum ada data penimbangan.

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

@endsection