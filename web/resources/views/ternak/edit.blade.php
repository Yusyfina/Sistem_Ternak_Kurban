@extends('layouts.ternak')

@section('content')

<div class="mb-6">

    <h1 class="text-2xl font-bold text-gray-800">
        Edit Data Ternak
    </h1>

    <p class="text-gray-500 mt-1">
        Ubah data ternak yang sudah terdaftar.
    </p>

</div>


<div class="bg-white rounded-lg shadow-sm">

    <div class="p-6 border-b">

        <h2 class="text-lg font-semibold text-gray-800">
            Form Edit Ternak
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            Kode ternak:
            <span class="font-medium text-gray-700">
                {{ $ternak->kode_ternak }}
            </span>
        </p>

    </div>


    <form
        action="{{ route('ternak.update', $ternak) }}"
        method="POST"
    >

        @csrf
        @method('PUT')


        <div class="p-6 space-y-6">

            {{-- KODE --}}
            <div>

                <label
                    for="kode_ternak"
                    class="block text-sm font-medium text-gray-700 mb-2"
                >
                    Kode Ternak
                </label>

                <input
                    type="text"
                    name="kode_ternak"
                    id="kode_ternak"
                    value="{{ old('kode_ternak', $ternak->kode_ternak) }}"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                >

                @error('kode_ternak')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- JENIS --}}
            <div>

                <label
                    for="jenis_ternak_id"
                    class="block text-sm font-medium text-gray-700 mb-2"
                >
                    Jenis Ternak
                </label>

                <select
                    name="jenis_ternak_id"
                    id="jenis_ternak_id"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                >

                    <option value="">
                        -- Pilih Jenis Ternak --
                    </option>

                    @foreach ($jenisTernak as $jenis)

                        <option
                            value="{{ $jenis->id }}"
                            {{ old('jenis_ternak_id', $ternak->jenis_ternak_id) == $jenis->id ? 'selected' : '' }}
                        >
                            {{ $jenis->nama_jenis }}
                        </option>

                    @endforeach

                </select>

                @error('jenis_ternak_id')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- LOKASI --}}
            <div>

                <label
                    for="lokasi_id"
                    class="block text-sm font-medium text-gray-700 mb-2"
                >
                    Lokasi Peternakan
                </label>

                <select
                    name="lokasi_id"
                    id="lokasi_id"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                >

                    <option value="">
                        -- Pilih Lokasi --
                    </option>

                    @foreach ($lokasi as $item)

                        <option
                            value="{{ $item->id }}"
                            {{ old('lokasi_id', $ternak->lokasi_id) == $item->id ? 'selected' : '' }}
                        >
                            {{ $item->nama }}
                        </option>

                    @endforeach

                </select>

                @error('lokasi_id')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- RFID --}}
            <div>

                <label
                    for="kode_rfid"
                    class="block text-sm font-medium text-gray-700 mb-2"
                >
                    Kode RFID
                    <span class="text-gray-400">
                        (Opsional)
                    </span>
                </label>

                <input
                    type="text"
                    name="kode_rfid"
                    id="kode_rfid"
                    value="{{ old('kode_rfid', $ternak->kode_rfid) }}"
                    placeholder="Contoh: RFID-0001"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                >

                @error('kode_rfid')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- STATUS --}}
            <div>

                <label
                    for="status"
                    class="block text-sm font-medium text-gray-700 mb-2"
                >
                    Status
                </label>

                <select
                    name="status"
                    id="status"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                >

                    <option
                        value="tersedia"
                        {{ old('status', $ternak->status) == 'tersedia' ? 'selected' : '' }}
                    >
                        Tersedia
                    </option>

                    <option
                        value="dipesan"
                        {{ old('status', $ternak->status) == 'dipesan' ? 'selected' : '' }}
                    >
                        Dipesan
                    </option>

                    <option
                        value="terkirim"
                        {{ old('status', $ternak->status) == 'terkirim' ? 'selected' : '' }}
                    >
                        Terkirim
                    </option>

                    <option
                        value="disembelih"
                        {{ old('status', $ternak->status) == 'disembelih' ? 'selected' : '' }}
                    >
                        Disembelih
                    </option>

                </select>

                @error('status')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- BOBOT --}}
            <div>

                <label
                    for="bobot_terakhir"
                    class="block text-sm font-medium text-gray-700 mb-2"
                >
                    Bobot Terakhir
                    <span class="text-gray-400">
                        (Opsional)
                    </span>
                </label>

                <div class="flex">

                    <input
                        type="number"
                        name="bobot_terakhir"
                        id="bobot_terakhir"
                        value="{{ old('bobot_terakhir', $ternak->bobot_terakhir) }}"
                        step="0.01"
                        min="0"
                        class="w-full rounded-l-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                    >

                    <span class="inline-flex items-center px-4 bg-gray-100 border border-l-0 border-gray-300 rounded-r-lg text-gray-600">
                        kg
                    </span>

                </div>

                @error('bobot_terakhir')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

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

            <button
                type="submit"
                class="px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
            >
                Simpan Perubahan
            </button>

        </div>

    </form>

</div>

@endsection