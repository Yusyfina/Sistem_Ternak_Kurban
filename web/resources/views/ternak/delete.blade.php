@extends('layouts.ternak')

@section('title', 'Hapus Ternak')
@section('page-title', 'Hapus Ternak')

@section('content')

<div class="mx-auto max-w-2xl">

    {{-- HEADER --}}
    <div class="mb-6">

        <h1 class="text-2xl font-bold text-gray-900">
            Hapus Data Ternak
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Konfirmasi sebelum menghapus data ternak.
        </p>

    </div>


    {{-- CARD --}}
    <div class="overflow-hidden rounded-xl border border-gray-200
                bg-white shadow-sm">

        {{-- HEADER --}}
        <div class="border-b border-red-100 bg-red-50 px-6 py-5">

            <div class="flex gap-3">

                <div class="flex h-10 w-10 shrink-0 items-center
                            justify-center rounded-full bg-red-100">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-5 w-5 text-red-600"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="2">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 9v4m0 4h.01M10.29 3.86l-7.82 13.5A2 2 0 004.2 20h15.6a2 2 0 001.73-2.64l-7.82-13.5a2 2 0 00-3.42 0z" />

                    </svg>

                </div>

                <div>

                    <h2 class="font-semibold text-red-800">
                        Konfirmasi Hapus
                    </h2>

                    <p class="mt-1 text-sm text-red-700">
                        Apakah kamu yakin ingin menghapus data ternak ini?
                    </p>

                </div>

            </div>

        </div>


        {{-- DATA --}}
        <div class="space-y-5 px-6 py-6">

            <div class="flex items-center justify-between
                        border-b border-gray-100 pb-4">

                <span class="text-sm text-gray-500">
                    Kode Ternak
                </span>

                <span class="text-sm font-semibold text-gray-900">
                    {{ $ternak->kode_ternak }}
                </span>

            </div>


            <div class="flex items-center justify-between
                        border-b border-gray-100 pb-4">

                <span class="text-sm text-gray-500">
                    Jenis Ternak
                </span>

                <span class="text-sm font-semibold text-gray-900">
                    {{ $ternak->jenisTernak->nama_jenis ?? '-' }}
                </span>

            </div>


            <div class="flex items-center justify-between
                        border-b border-gray-100 pb-4">

                <span class="text-sm text-gray-500">
                    Lokasi
                </span>

                <span class="text-sm font-semibold text-gray-900">
                    {{ $ternak->lokasi->nama ?? '-' }}
                </span>

            </div>


            <div class="flex items-center justify-between
                        border-b border-gray-100 pb-4">

                <span class="text-sm text-gray-500">
                    Kode RFID
                </span>

                <span class="font-mono text-sm font-semibold text-gray-900">
                    {{ $ternak->kode_rfid ?? '-' }}
                </span>

            </div>


            <div class="flex items-center justify-between
                        border-b border-gray-100 pb-4">

                <span class="text-sm text-gray-500">
                    Bobot Terakhir
                </span>

                <span class="text-sm font-semibold text-gray-900">

                    @if($ternak->bobot_terakhir !== null)

                        {{ number_format($ternak->bobot_terakhir, 1, ',', '.') }}
                        kg

                    @else

                        -

                    @endif

                </span>

            </div>


            <div class="flex items-center justify-between">

                <span class="text-sm text-gray-500">
                    Status
                </span>

                <span class="text-sm font-semibold capitalize text-gray-900">
                    {{ str_replace('_', ' ', $ternak->status) }}
                </span>

            </div>

        </div>


        {{-- FOOTER --}}
        <div class="flex flex-col-reverse gap-3 border-t border-gray-200
                    bg-gray-50 px-6 py-4 sm:flex-row sm:justify-end">

            <a href="{{ route('ternak.show', $ternak) }}"
               class="inline-flex items-center justify-center rounded-lg
                      border border-gray-300 bg-white px-5 py-2.5
                      text-sm font-semibold text-gray-700
                      transition hover:bg-gray-50">

                Batal

            </a>


            <form action="{{ route('ternak.destroy', $ternak) }}"
                  method="POST">

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="w-full rounded-lg bg-red-600 px-5 py-2.5
                           text-sm font-semibold text-white
                           transition hover:bg-red-700
                           sm:w-auto"
                    onclick="return confirm('Yakin ingin menghapus {{ $ternak->kode_ternak }}?')"
                >

                    Ya, Hapus Ternak

                </button>

            </form>

        </div>

    </div>

</div>

@endsection