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


<div class="max-w-4xl">

    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">

        {{-- HEADER --}}
        <div class="px-6 py-5 border-b border-gray-200">

            <h2 class="text-lg font-semibold text-gray-800">
                Form Edit Pembeli
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Periksa kembali data sebelum menyimpan perubahan.
            </p>

        </div>


        {{-- FORM --}}
        <form
            action="{{ route('pembeli.update', $pembeli) }}"
            method="POST"
        >

            @csrf
            @method('PUT')


            <div class="p-6 space-y-6">


                {{-- NAMA --}}
                <div>

                    <label
                        for="nama"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Nama Pembeli
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        name="nama"
                        id="nama"
                        value="{{ old('nama', $pembeli->nama) }}"
                        required
                        maxlength="255"
                        placeholder="Masukkan nama pembeli"
                        class="w-full rounded-lg border-gray-300
                               focus:border-green-600 focus:ring-green-600"
                    >

                    @error('nama')
                        <p class="mt-1.5 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- TELEPON --}}
                <div>

                    <label
                        for="telepon"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        No. Telepon
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        name="telepon"
                        id="telepon"
                        value="{{ old('telepon', $pembeli->telepon) }}"
                        required
                        maxlength="20"
                        placeholder="Contoh: 081234567890"
                        class="w-full rounded-lg border-gray-300
                               focus:border-green-600 focus:ring-green-600"
                    >

                    @error('telepon')
                        <p class="mt-1.5 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- ALAMAT --}}
                <div>

                    <label
                        for="alamat"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Alamat
                    </label>

                    <textarea
                        name="alamat"
                        id="alamat"
                        rows="4"
                        placeholder="Masukkan alamat pembeli"
                        class="w-full rounded-lg border-gray-300
                               focus:border-green-600 focus:ring-green-600"
                    >{{ old('alamat', $pembeli->alamat) }}</textarea>

                    @error('alamat')
                        <p class="mt-1.5 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


            </div>


            {{-- BUTTON --}}
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">

                <div class="flex items-center justify-end gap-3">

                    <a
                        href="{{ route('pembeli.index') }}"
                        class="px-5 py-2.5 border border-gray-300
                               text-gray-700 text-sm font-medium rounded-lg
                               hover:bg-gray-100 transition"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="px-5 py-2.5 bg-green-700 text-white
                               text-sm font-medium rounded-lg
                               hover:bg-green-800 transition"
                    >
                        Simpan Perubahan
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection