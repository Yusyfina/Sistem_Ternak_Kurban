@extends('layouts.ternak')

@section('content')

<div class="mb-6">

    <h1 class="text-2xl font-bold text-gray-800">
        Tambah Penimbangan
    </h1>

    <p class="text-gray-500 mt-1">
        Masukkan hasil penimbangan ternak.
    </p>

</div>


<div class="max-w-3xl">

    <div class="bg-white rounded-lg shadow-sm">

        {{-- HEADER --}}
        <div class="p-6 border-b">

            <h2 class="text-lg font-semibold text-gray-800">
                Form Penimbangan
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Data yang dimasukkan akan berstatus menunggu verifikasi.
            </p>

        </div>


        <form
            action="{{ route('penimbangan.store') }}"
            method="POST"
        >

            @csrf


            <div class="p-6 space-y-6">

                {{-- TERNAK --}}
                <div>

                    <label
                        for="ternak_id"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Ternak
                    </label>

                    <select
                        name="ternak_id"
                        id="ternak_id"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                        required
                    >

                        <option value="">
                            -- Pilih Ternak --
                        </option>

                        @foreach ($ternak as $item)

                            <option
                                value="{{ $item->id }}"
                                {{ old('ternak_id') == $item->id ? 'selected' : '' }}
                            >
                                {{ $item->kode_ternak }}

                                -
                                {{ $item->jenisTernak->nama_jenis ?? '-' }}

                                -

                                {{ $item->lokasi->nama ?? '-' }}

                            </option>

                        @endforeach

                    </select>

                    @error('ternak_id')

                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- BOBOT --}}
                <div>

                    <label
                        for="bobot"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Bobot
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
                            class="w-full rounded-l-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                            required
                        >

                        <span class="inline-flex items-center px-4 bg-gray-100 border border-l-0 border-gray-300 rounded-r-lg text-gray-600">
                            kg
                        </span>

                    </div>

                    @error('bobot')

                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- METODE --}}
                <div>

                    <label
                        for="metode"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Metode Penimbangan
                    </label>

                    <select
                        name="metode"
                        id="metode"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                        required
                    >

                        <option value="">
                            -- Pilih Metode --
                        </option>

                        <option
                            value="manual"
                            {{ old('metode') == 'manual' ? 'selected' : '' }}
                        >
                            Manual
                        </option>

                        <option
                            value="estimasi"
                            {{ old('metode') == 'estimasi' ? 'selected' : '' }}
                        >
                            Estimasi
                        </option>

                        <option
                            value="otomatis_iot"
                            {{ old('metode') == 'otomatis_iot' ? 'selected' : '' }}
                        >
                            Otomatis IoT
                        </option>

                    </select>

                    @error('metode')

                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- SUMBER --}}
                <div>

                    <label
                        for="sumber"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Sumber Data
                    </label>

                    <select
                        name="sumber"
                        id="sumber"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                        required
                    >

                        <option value="">
                            -- Pilih Sumber Data --
                        </option>

                        <option
                            value="manual_entry"
                            {{ old('sumber') == 'manual_entry' ? 'selected' : '' }}
                        >
                            Manual Entry
                        </option>

                        <option
                            value="otomatis_iot"
                            {{ old('sumber') == 'otomatis_iot' ? 'selected' : '' }}
                        >
                            Otomatis IoT
                        </option>

                        <option
                            value="data_manajemen"
                            {{ old('sumber') == 'data_manajemen' ? 'selected' : '' }}
                        >
                            Data Manajemen
                        </option>

                        <option
                            value="tidak_ada_data"
                            {{ old('sumber') == 'tidak_ada_data' ? 'selected' : '' }}
                        >
                            Tidak Ada Data
                        </option>

                    </select>

                    @error('sumber')

                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- INFORMASI VERIFIKASI --}}
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">

                    <h3 class="text-sm font-semibold text-yellow-800">
                        Informasi
                    </h3>

                    <p class="text-sm text-yellow-700 mt-1">
                        Setelah data disimpan, status penimbangan akan otomatis menjadi
                        <strong>Menunggu Verifikasi</strong>.
                    </p>

                </div>

            </div>


            {{-- BUTTON --}}
            <div class="px-6 py-4 bg-gray-50 border-t flex justify-end gap-3">

                <a
                    href="{{ route('penimbangan.index') }}"
                    class="px-5 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
                >
                    Simpan Penimbangan
                </button>

            </div>

        </form>

    </div>

</div>

@endsection