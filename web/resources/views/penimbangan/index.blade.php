@extends('layouts.ternak')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">
        Penimbangan
    </h1>

    <p class="text-gray-500 mt-1">
        Daftar data penimbangan ternak yang masuk ke sistem.
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
                Data Penimbangan
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Data penimbangan yang perlu diperiksa atau diverifikasi.
            </p>
        </div>

        <a
            href="{{ route('penimbangan.create') }}"
            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
        >
            + Tambah Penimbangan
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
                        Bobot
                    </th>

                    <th class="px-5 py-3 text-left">
                        Metode
                    </th>

                    <th class="px-5 py-3 text-left">
                        Sumber
                    </th>

                    <th class="px-5 py-3 text-left">
                        Operator
                    </th>

                    <th class="px-5 py-3 text-left">
                        Status
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


                        {{-- KODE TERNAK --}}
                        <td class="px-5 py-3 font-medium text-gray-800">
                            {{ $item->ternak->kode_ternak ?? '-' }}
                        </td>


                        {{-- JENIS --}}
                        <td class="px-5 py-3">
                            {{ $item->ternak->jenisTernak->nama_jenis ?? '-' }}
                        </td>


                        {{-- BOBOT --}}
                        <td class="px-5 py-3 font-medium">
                            {{ $item->bobot }} kg
                        </td>


                        {{-- METODE --}}
                        <td class="px-5 py-3">
                            {{ ucfirst(str_replace('_', ' ', $item->metode)) }}
                        </td>


                        {{-- SUMBER --}}
                        <td class="px-5 py-3">
                            {{ ucfirst(str_replace('_', ' ', $item->sumber)) }}
                        </td>


                        {{-- OPERATOR --}}
                        <td class="px-5 py-3">
                            {{ $item->operator->name ?? '-' }}
                        </td>


                        {{-- STATUS --}}
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

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="8"
                            class="px-5 py-10 text-center text-gray-500"
                        >
                            Belum ada data penimbangan.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection