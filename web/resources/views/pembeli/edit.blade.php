@extends('layouts.ternak')

@section('content')

<div class="mb-6">

    <h1 class="text-2xl font-bold text-gray-800">
        Edit Pembeli
    </h1>

    <p class="text-gray-500 mt-1">
        Perbarui data pembeli yang sudah terdaftar.
    </p>

</div>

<div class="bg-white rounded-lg shadow-sm">

    {{-- Header --}}
    <div class="p-5 border-b">

        <h2 class="font-semibold text-gray-800">
            Form Edit Pembeli
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            Periksa kembali data sebelum menyimpan perubahan.
        </p>

    </div>

    {{-- Form --}}
    <form
        action="{{ route('pembeli.update', $pembeli) }}"
        method="POST"
        class="p-5"
    >

        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            {{-- Nama --}}
            <div>

                <label
                    for="nama"
                    class="block text-sm font-medium text-gray-700 mb-1"
                >
                    Nama Pembeli
                </label>

                <input
                    type="text"
                    name="nama"
                    id="nama"
                    value="{{ old('nama', $pembeli->nama) }}"
                    required
                    maxlength="255"
                    placeholder="Masukkan nama pembeli"
                    class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500"
                >

                @error('nama')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- No HP --}}
            <div>

                <label
                    for="no_hp"
                    class="block text-sm font-medium text-gray-700 mb-1"
                >
                    No. HP
                </label>

                <input
                    type="text"
                    name="no_hp"
                    id="no_hp"
                    value="{{ old('no_hp', $pembeli->no_hp) }}"
                    maxlength="30"
                    placeholder="Contoh: 081234567890"
                    class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500"
                >

                @error('no_hp')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Email --}}
            <div>

                <label
                    for="email"
                    class="block text-sm font-medium text-gray-700 mb-1"
                >
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email', $pembeli->email) }}"
                    maxlength="255"
                    placeholder="Contoh: nama@email.com"
                    class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500"
                >

                @error('email')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Alamat --}}
            <div>

                <label
                    for="alamat"
                    class="block text-sm font-medium text-gray-700 mb-1"
                >
                    Alamat
                </label>

                <textarea
                    name="alamat"
                    id="alamat"
                    rows="3"
                    placeholder="Masukkan alamat pembeli"
                    class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500"
                >{{ old('alamat', $pembeli->alamat) }}</textarea>

                @error('alamat')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

        </div>

        {{-- Tombol --}}
        <div class="flex items-center justify-end gap-3 mt-6 pt-5 border-t">

            <a
                href="{{ route('pembeli.index') }}"
                class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50"
            >
                Batal
            </a>

            <button
                type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
            >
                Simpan Perubahan
            </button>

        </div>

    </form>

</div>

@endsection