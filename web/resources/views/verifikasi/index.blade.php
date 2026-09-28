@extends('layouts.ternak')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">
        Verifikasi Penimbangan
    </h1>

    <p class="text-gray-500 mt-1">
        Periksa dan verifikasi data hasil penimbangan ternak sebelum digunakan dalam sistem.
    </p>
</div>


{{-- NOTIFIKASI BERHASIL --}}
@if (session('success'))
    <div class="mb-6 flex items-start gap-3 p-4 bg-green-50 border border-green-200 rounded-xl">
        <div class="flex-1">
            <p class="text-sm font-medium text-green-800">
                {{ session('success') }}
            </p>
        </div>
    </div>
@endif


{{-- NOTIFIKASI ERROR --}}
@if (session('error'))
    <div class="mb-6 flex items-start gap-3 p-4 bg-red-50 border border-red-200 rounded-xl">
        <div class="flex-1">
            <p class="text-sm font-medium text-red-800">
                {{ session('error') }}
            </p>
        </div>
    </div>
@endif


{{-- ERROR VALIDASI --}}
@if ($errors->any())
    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
        <p class="text-sm font-semibold text-red-800 mb-2">
            Ada data yang perlu diperbaiki:
        </p>

        <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


{{-- RINGKASAN --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">

    {{-- MENUNGGU --}}
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">
                    Menunggu Verifikasi
                </p>

                <p class="text-2xl font-bold text-gray-800 mt-1">
                    {{ $penimbangan->total() }}
                </p>
            </div>

            <div class="w-11 h-11 rounded-xl bg-yellow-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-yellow-600"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
    </div>


    {{-- DATA DI HALAMAN --}}
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">
                    Data Ditampilkan
                </p>

                <p class="text-2xl font-bold text-gray-800 mt-1">
                    {{ $penimbangan->count() }}
                </p>
            </div>

            <div class="w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-600"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5l5 5v11a2 2 0 01-2 2z"/>
                </svg>
            </div>
        </div>
    </div>


    {{-- STATUS --}}
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">
                    Status
                </p>

                <p class="text-lg font-semibold text-yellow-700 mt-1">
                    Perlu Pemeriksaan
                </p>
            </div>

            <div class="w-11 h-11 rounded-xl bg-yellow-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-yellow-600"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4a2 2 0 00-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z"/>
                </svg>
            </div>
        </div>
    </div>

</div>


{{-- DATA VERIFIKASI --}}
<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">

    {{-- HEADER --}}
    <div class="px-6 py-5 border-b border-gray-200 flex flex-col md:flex-row md:items-center md:justify-between gap-3">

        <div>
            <h2 class="text-lg font-semibold text-gray-800">
                Data Menunggu Verifikasi
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Periksa hasil penimbangan kemudian tentukan status verifikasinya.
            </p>
        </div>

        <a
            href="{{ route('penimbangan.riwayat') }}"
            class="inline-flex items-center justify-center px-4 py-2.5 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition"
        >
            Lihat Riwayat
        </a>

    </div>


    {{-- DATA --}}
    <div class="p-6">

        @forelse ($penimbangan as $item)

            <div class="border border-gray-200 rounded-xl mb-5 last:mb-0 overflow-hidden">

                {{-- BAGIAN INFORMASI --}}
                <div class="p-5 bg-gray-50 border-b border-gray-200">

                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

                        {{-- IDENTITAS TERNAK --}}
                        <div class="flex items-center gap-4">

                            <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-700"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M5.5 15.5c1.5 2 3.5 3 6.5 3s5-1 6.5-3M8 10h.01M16 10h.01M9 6.5C10 5.5 11 5 12 5s2 .5 3 1.5M4 13c-.8-.8-1.2-1.8-1.2-3 0-2.5 2-4.5 4.5-4.5"/>
                                </svg>
                            </div>

                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide">
                                    Kode Ternak
                                </p>

                                <p class="text-lg font-bold text-gray-800">
                                    {{ $item->ternak->kode_ternak ?? '-' }}
                                </p>

                                <p class="text-sm text-gray-500">
                                    {{ $item->ternak->jenisTernak->nama_jenis ?? '-' }}
                                </p>
                            </div>

                        </div>


                        {{-- BOBOT --}}
                        <div class="lg:text-right">

                            <p class="text-xs text-gray-500 uppercase tracking-wide">
                                Hasil Penimbangan
                            </p>

                            <p class="text-3xl font-bold text-green-700">
                                {{ $item->bobot }}
                                <span class="text-base font-medium text-gray-500">
                                    kg
                                </span>
                            </p>

                        </div>

                    </div>

                </div>


                {{-- DETAIL --}}
                <div class="p-5">

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

                        {{-- LOKASI --}}
                        <div>
                            <p class="text-xs text-gray-500 mb-1">
                                Lokasi
                            </p>

                            <p class="text-sm font-medium text-gray-800">
                                {{ $item->ternak->lokasi->nama ?? '-' }}
                            </p>
                        </div>


                        {{-- METODE --}}
                        <div>
                            <p class="text-xs text-gray-500 mb-1">
                                Metode
                            </p>

                            <p class="text-sm font-medium text-gray-800">
                                {{ ucfirst(str_replace('_', ' ', $item->metode)) }}
                            </p>
                        </div>


                        {{-- OPERATOR --}}
                        <div>
                            <p class="text-xs text-gray-500 mb-1">
                                Operator
                            </p>

                            <p class="text-sm font-medium text-gray-800">
                                {{ $item->operator->name ?? '-' }}
                            </p>
                        </div>


                        {{-- WAKTU --}}
                        <div>
                            <p class="text-xs text-gray-500 mb-1">
                                Waktu Penimbangan
                            </p>

                            <p class="text-sm font-medium text-gray-800">
                                @if ($item->ditimbang_at)
                                    {{ \Carbon\Carbon::parse($item->ditimbang_at)->format('d/m/Y H:i') }}
                                @else
                                    -
                                @endif
                            </p>
                        </div>

                    </div>


                    {{-- FORM VERIFIKASI --}}
                    <form
                        action="{{ route('verifikasi.store', $item) }}"
                        method="POST"
                        class="border-t border-gray-200 pt-5"
                    >

                        @csrf

                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

                            {{-- STATUS --}}
                            <div>

                                <label
                                    for="status_verifikasi_{{ $item->id }}"
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                >
                                    Hasil Verifikasi
                                </label>

                                <select
                                    name="status_verifikasi"
                                    id="status_verifikasi_{{ $item->id }}"
                                    class="w-full rounded-lg border-gray-300 focus:border-green-600 focus:ring-green-600"
                                    required
                                >

                                    <option value="">
                                        -- Pilih Status --
                                    </option>

                                    <option value="valid">
                                        Valid
                                    </option>

                                    <option value="kurang_akurat">
                                        Kurang Akurat
                                    </option>

                                    <option value="tidak_valid">
                                        Tidak Valid
                                    </option>

                                </select>

                            </div>


                            {{-- CATATAN --}}
                            <div class="lg:col-span-2">

                                <label
                                    for="catatan_verifikasi_{{ $item->id }}"
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                >
                                    Catatan Verifikasi
                                </label>

                                <textarea
                                    name="catatan_verifikasi"
                                    id="catatan_verifikasi_{{ $item->id }}"
                                    rows="3"
                                    placeholder="Tambahkan catatan jika diperlukan..."
                                    class="w-full rounded-lg border-gray-300 focus:border-green-600 focus:ring-green-600"
                                ></textarea>

                            </div>

                        </div>


                        {{-- BUTTON --}}
                        <div class="flex justify-end mt-5">

                            <button
                                type="submit"
                                class="inline-flex items-center px-5 py-2.5 bg-green-700 text-white text-sm font-medium rounded-lg hover:bg-green-800 transition"
                            >
                                Simpan Verifikasi
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        @empty

            {{-- EMPTY STATE --}}
            <div class="py-14 text-center">

                <div class="mx-auto w-14 h-14 rounded-full bg-green-50 flex items-center justify-center mb-4">

                    <svg class="w-7 h-7 text-green-600"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M5 13l4 4L19 7"/>
                    </svg>

                </div>

                <h3 class="text-lg font-semibold text-gray-800">
                    Tidak ada data yang perlu diverifikasi
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    Semua data penimbangan sudah diproses atau belum ada data baru.
                </p>

            </div>

        @endforelse

    </div>


    {{-- PAGINATION --}}
    @if (method_exists($penimbangan, 'hasPages') && $penimbangan->hasPages())

        <div class="px-6 py-4 border-t border-gray-200">
            {{ $penimbangan->links() }}
        </div>

    @endif

</div>

@endsection