@extends('layouts.ternak')

@section('title', 'Tambah Penimbangan')
@section('page-title', 'Tambah Penimbangan')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div>

        <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">

            <a
                href="{{ route('penimbangan.index') }}"
                class="hover:text-[#164A3A] transition">

                Penimbangan

            </a>

            <span>
                /
            </span>

            <span class="text-gray-700">
                Tambah
            </span>

        </div>

        <h2 class="text-2xl font-bold text-gray-900">
            Tambah Penimbangan
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Masukkan hasil penimbangan ternak ke dalam sistem.
        </p>

    </div>


    {{-- VALIDATION ERROR --}}
    @if($errors->any())

        <div
            class="p-4
                   bg-red-50
                   border border-red-200
                   rounded-xl">

            <div class="flex gap-3">

                <div
                    class="w-8 h-8
                           rounded-full
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

                    <p class="font-semibold text-red-800 text-sm">
                        Data belum dapat disimpan
                    </p>

                    <ul
                        class="mt-2
                               list-disc
                               list-inside
                               text-sm
                               text-red-700
                               space-y-1">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- FORM --}}
    <div
        class="bg-white
               border border-gray-200
               rounded-xl
               shadow-sm
               overflow-hidden">

        {{-- FORM HEADER --}}
        <div
            class="px-6 py-5
                   border-b border-gray-200">

            <h3 class="text-lg font-semibold text-gray-900">
                Form Penimbangan
            </h3>

            <p class="text-sm text-gray-500 mt-1">
                Data yang dimasukkan akan berstatus Menunggu Verifikasi.
            </p>

        </div>


        <form
            action="{{ route('penimbangan.store') }}"
            method="POST">

            @csrf


            <div class="p-6 space-y-8">


                {{-- ================================================= --}}
                {{-- DATA TERNAK --}}
                {{-- ================================================= --}}

                <div>

                    <div class="mb-4">

                        <h4 class="text-base font-semibold text-gray-900">
                            Data Ternak
                        </h4>

                        <p class="text-sm text-gray-500 mt-1">
                            Pilih ternak yang akan ditimbang.
                        </p>

                    </div>


                    <div>

                        <label
                            for="ternak_id"
                            class="block text-sm font-medium text-gray-700 mb-2">

                            Ternak
                            <span class="text-red-500">*</span>

                        </label>

                        <select
                            name="ternak_id"
                            id="ternak_id"
                            required
                            class="w-full
                                   px-4 py-3
                                   bg-white
                                   border border-gray-300
                                   rounded-lg
                                   text-sm
                                   text-gray-700
                                   focus:ring-2
                                   focus:ring-[#164A3A]
                                   focus:border-[#164A3A]">

                            <option value="">
                                -- Pilih Ternak --
                            </option>

                            @foreach ($ternak as $item)

                                <option
                                    value="{{ $item->id }}"
                                    {{ old('ternak_id') == $item->id ? 'selected' : '' }}>

                                    {{ $item->kode_ternak }}
                                    -
                                    {{ $item->jenisTernak->nama_jenis ?? '-' }}
                                    -
                                    {{ $item->lokasi->nama ?? '-' }}

                                </option>

                            @endforeach

                        </select>

                        <p class="mt-1.5 text-xs text-gray-400">
                            Hanya ternak dengan status tersedia yang ditampilkan.
                        </p>

                        @error('ternak_id')

                            <p class="mt-1.5 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>

                </div>


                {{-- PEMBATAS --}}
                <div class="border-t border-gray-100"></div>


                {{-- ================================================= --}}
                {{-- HASIL PENIMBANGAN --}}
                {{-- ================================================= --}}

                <div>

                    <div class="mb-4">

                        <h4 class="text-base font-semibold text-gray-900">
                            Hasil Penimbangan
                        </h4>

                        <p class="text-sm text-gray-500 mt-1">
                            Masukkan bobot dan informasi sumber penimbangan.
                        </p>

                    </div>


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                        {{-- BOBOT --}}
                        <div>

                            <label
                                for="bobot"
                                class="block text-sm font-medium text-gray-700 mb-2">

                                Bobot
                                <span class="text-red-500">*</span>

                            </label>

                            <div class="flex">

                                <input
                                    type="number"
                                    name="bobot"
                                    id="bobot"
                                    value="{{ old('bobot') }}"
                                    step="0.01"
                                    min="0"
                                    placeholder="Contoh: 35.50"
                                    required
                                    class="w-full
                                           px-4 py-3
                                           border border-gray-300
                                           rounded-l-lg
                                           text-sm
                                           focus:ring-2
                                           focus:ring-[#164A3A]
                                           focus:border-[#164A3A]">

                                <span
                                    class="inline-flex
                                           items-center
                                           px-4
                                           bg-gray-100
                                           border border-l-0
                                           border-gray-300
                                           rounded-r-lg
                                           text-sm
                                           font-medium
                                           text-gray-600">

                                    kg

                                </span>

                            </div>

                            @error('bobot')

                                <p class="mt-1.5 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- METODE --}}
                        <div>

                            <label
                                for="metode"
                                class="block text-sm font-medium text-gray-700 mb-2">

                                Metode Penimbangan
                                <span class="text-red-500">*</span>

                            </label>

                            <select
                                name="metode"
                                id="metode"
                                required
                                class="w-full
                                       px-4 py-3
                                       bg-white
                                       border border-gray-300
                                       rounded-lg
                                       text-sm
                                       text-gray-700
                                       focus:ring-2
                                       focus:ring-[#164A3A]
                                       focus:border-[#164A3A]">

                                <option value="">
                                    -- Pilih Metode --
                                </option>

                                <option
                                    value="manual"
                                    {{ old('metode') == 'manual' ? 'selected' : '' }}>

                                    Manual

                                </option>

                                <option
                                    value="estimasi"
                                    {{ old('metode') == 'estimasi' ? 'selected' : '' }}>

                                    Estimasi

                                </option>

                                <option
                                    value="otomatis_iot"
                                    {{ old('metode') == 'otomatis_iot' ? 'selected' : '' }}>

                                    Otomatis IoT

                                </option>

                            </select>

                            @error('metode')

                                <p class="mt-1.5 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- SUMBER --}}
                        <div class="md:col-span-2">

                            <label
                                for="sumber"
                                class="block text-sm font-medium text-gray-700 mb-2">

                                Sumber Data
                                <span class="text-red-500">*</span>

                            </label>

                            <select
                                name="sumber"
                                id="sumber"
                                required
                                class="w-full
                                       px-4 py-3
                                       bg-white
                                       border border-gray-300
                                       rounded-lg
                                       text-sm
                                       text-gray-700
                                       focus:ring-2
                                       focus:ring-[#164A3A]
                                       focus:border-[#164A3A]">

                                <option value="">
                                    -- Pilih Sumber Data --
                                </option>

                                <option
                                    value="manual_entry"
                                    {{ old('sumber') == 'manual_entry' ? 'selected' : '' }}>

                                    Manual Entry

                                </option>

                                <option
                                    value="otomatis_iot"
                                    {{ old('sumber') == 'otomatis_iot' ? 'selected' : '' }}>

                                    Otomatis IoT

                                </option>

                                <option
                                    value="data_manajemen"
                                    {{ old('sumber') == 'data_manajemen' ? 'selected' : '' }}>

                                    Data Manajemen

                                </option>

                                <option
                                    value="tidak_ada_data"
                                    {{ old('sumber') == 'tidak_ada_data' ? 'selected' : '' }}>

                                    Tidak Ada Data

                                </option>

                            </select>

                            @error('sumber')

                                <p class="mt-1.5 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                    </div>

                </div>


                {{-- PEMBATAS --}}
                <div class="border-t border-gray-100"></div>


                {{-- ================================================= --}}
                {{-- INFORMASI VERIFIKASI --}}
                {{-- ================================================= --}}

                <div
                    class="flex items-start gap-4
                           p-5
                           bg-yellow-50
                           border border-yellow-200
                           rounded-xl">

                    <div
                        class="w-10 h-10
                               rounded-full
                               bg-yellow-100
                               flex items-center
                               justify-center
                               flex-shrink-0">

                        <svg
                            class="w-5 h-5 text-yellow-600"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M12 22a10 10 0 100-20 10 10 0 000 20z" />

                        </svg>

                    </div>

                    <div>

                        <h4 class="text-sm font-semibold text-yellow-800">
                            Informasi Verifikasi
                        </h4>

                        <p class="text-sm text-yellow-700 mt-1 leading-relaxed">

                            Setelah data disimpan, status penimbangan akan
                            otomatis menjadi

                            <strong>
                                Menunggu Verifikasi
                            </strong>.

                            Data selanjutnya dapat diperiksa melalui menu
                            Verifikasi.

                        </p>

                    </div>

                </div>

            </div>


            {{-- FOOTER FORM --}}
            <div
                class="px-6 py-4
                       bg-gray-50
                       border-t border-gray-200
                       flex flex-col-reverse sm:flex-row
                       sm:justify-end
                       gap-3">

                <a
                    href="{{ route('penimbangan.index') }}"
                    class="inline-flex
                           items-center
                           justify-center
                           px-5 py-2.5
                           bg-white
                           border border-gray-300
                           text-gray-700
                           text-sm font-medium
                           rounded-lg
                           hover:bg-gray-50
                           transition">

                    Batal

                </a>

                <button
                    type="submit"
                    class="inline-flex
                           items-center
                           justify-center
                           gap-2
                           px-5 py-2.5
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
                            d="M5 13l4 4L19 7" />

                    </svg>

                    Simpan Penimbangan

                </button>

            </div>

        </form>

    </div>

</div>

@endsection