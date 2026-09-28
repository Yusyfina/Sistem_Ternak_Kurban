@extends('layouts.ternak')

@section('content')

<div class="mb-6">

    <h1 class="text-2xl font-bold text-gray-800">
        Tambah Lokasi Peternakan
    </h1>

    <p class="text-gray-500 mt-1">
        Tambahkan lokasi peternakan baru ke dalam sistem.
    </p>

</div>

@if ($errors->any())

    <div class="mb-5 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-red-700">

        <p class="font-semibold mb-1">
            Terjadi kesalahan:
        </p>

        <ul class="list-disc list-inside text-sm">

            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

        </ul>

    </div>

@endif

<div class="bg-white rounded-lg shadow-sm">

    {{-- Header --}}
    <div class="p-5 border-b">

        <h2 class="font-semibold text-gray-800">
            Form Lokasi Peternakan
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            Isi data lokasi dengan lengkap.
        </p>

    </div>

    {{-- Form --}}
    <form
        action="{{ route('lokasi.store') }}"
        method="POST"
        class="p-5"
    >

        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            {{-- Nama --}}
            <div>

                <label
                    for="nama"
                    class="block text-sm font-medium text-gray-700 mb-1"
                >
                    Nama Lokasi
                </label>

                <input
                    type="text"
                    name="nama"
                    id="nama"
                    value="{{ old('nama') }}"
                    required
                    maxlength="255"
                    placeholder="Contoh: Peternakan Lokasi A"
                    class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500"
                >

                @error('nama')

                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>

                @enderror

            </div>

            {{-- Status --}}
            <div>

                <label
                    for="status"
                    class="block text-sm font-medium text-gray-700 mb-1"
                >
                    Status
                </label>

                <select
                    name="status"
                    id="status"
                    required
                    class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500"
                >

                    <option
                        value="aktif"
                        {{ old('status', 'aktif') === 'aktif' ? 'selected' : '' }}
                    >
                        Aktif
                    </option>

                    <option
                        value="nonaktif"
                        {{ old('status') === 'nonaktif' ? 'selected' : '' }}
                    >
                        Nonaktif
                    </option>

                </select>

                @error('status')

                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>

                @enderror

            </div>

            {{-- Alamat --}}
            <div class="md:col-span-2">

                <label
                    for="alamat"
                    class="block text-sm font-medium text-gray-700 mb-1"
                >
                    Alamat
                </label>

                <textarea
                    name="alamat"
                    id="alamat"
                    rows="4"
                    placeholder="Masukkan alamat lengkap lokasi peternakan"
                    class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500"
                >{{ old('alamat') }}</textarea>

                @error('alamat')

                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>

                @enderror

            </div>

        </div>

        {{-- Informasi --}}
        <div class="mt-6 rounded-lg bg-blue-50 border border-blue-200 p-4">

            <p class="text-sm text-blue-700">
                Lokasi dengan status <strong>Aktif</strong> dapat digunakan
                untuk penempatan ternak dan proses operasional.
            </p>

        </div>

        {{-- Tombol --}}
        <div class="flex items-center justify-end gap-3 mt-6 pt-5 border-t">

            <a
                href="{{ route('lokasi.index') }}"
                class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50"
            >
                Batal
            </a>

            <button
                type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
            >
                Simpan Lokasi
            </button>

        </div>

    </form>

</div>

@endsection