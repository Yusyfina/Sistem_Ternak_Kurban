@extends('layouts.ternak')

@section('content')

<div class="mb-6">

    <h1 class="text-2xl font-bold text-gray-800">
        Hapus Data Ternak
    </h1>

    <p class="text-gray-500 mt-1">
        Konfirmasi penghapusan data ternak.
    </p>

</div>


<div class="max-w-2xl">

    <div class="bg-white rounded-lg shadow-sm">


        {{-- HEADER --}}
        <div class="p-6 border-b">

            <h2 class="text-lg font-semibold text-red-600">
                Konfirmasi Hapus
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Periksa data berikut sebelum menghapus.
            </p>

        </div>


        {{-- INFORMASI --}}
        <div class="p-6">

            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">

                <p class="text-sm text-red-700">
                    Apakah kamu yakin ingin menghapus data ternak ini?
                </p>

                <p class="text-sm text-red-600 mt-1">
                    Data yang sudah dihapus tidak dapat dikembalikan.
                </p>

            </div>


            <div class="space-y-4">

                {{-- KODE --}}
                <div class="flex justify-between border-b pb-3">

                    <span class="text-gray-500">
                        Kode Ternak
                    </span>

                    <span class="font-semibold text-gray-800">
                        {{ $ternak->kode_ternak }}
                    </span>

                </div>


                {{-- JENIS --}}
                <div class="flex justify-between border-b pb-3">

                    <span class="text-gray-500">
                        Jenis Ternak
                    </span>

                    <span class="font-semibold text-gray-800">
                        {{ $ternak->jenisTernak->nama_jenis ?? '-' }}
                    </span>

                </div>


                {{-- LOKASI --}}
                <div class="flex justify-between border-b pb-3">

                    <span class="text-gray-500">
                        Lokasi
                    </span>

                    <span class="font-semibold text-gray-800">
                        {{ $ternak->lokasi->nama ?? '-' }}
                    </span>

                </div>


                {{-- RFID --}}
                <div class="flex justify-between border-b pb-3">

                    <span class="text-gray-500">
                        Kode RFID
                    </span>

                    <span class="font-semibold text-gray-800">
                        {{ $ternak->kode_rfid ?? '-' }}
                    </span>

                </div>


                {{-- BOBOT --}}
                <div class="flex justify-between border-b pb-3">

                    <span class="text-gray-500">
                        Bobot Terakhir
                    </span>

                    <span class="font-semibold text-gray-800">

                        @if ($ternak->bobot_terakhir !== null)

                            {{ $ternak->bobot_terakhir }} kg

                        @else

                            -

                        @endif

                    </span>

                </div>


                {{-- STATUS --}}
                <div class="flex justify-between">

                    <span class="text-gray-500">
                        Status
                    </span>

                    <span class="font-semibold text-gray-800">
                        {{ ucfirst($ternak->status) }}
                    </span>

                </div>

            </div>

        </div>


        {{-- BUTTON --}}
        <div class="px-6 py-4 bg-gray-50 border-t flex justify-end gap-3">

            <a
                href="{{ route('ternak.index') }}"
                class="px-5 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300"
            >
                Batal
            </a>


            <form
                action="{{ route('ternak.destroy', $ternak) }}"
                method="POST"
            >

                @csrf

                @method('DELETE')

                <button
                    type="submit"
                    class="px-5 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700"
                >
                    Ya, Hapus Ternak
                </button>

            </form>

        </div>

    </div>

</div>

@endsection