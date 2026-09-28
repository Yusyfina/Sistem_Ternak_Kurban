@extends('layouts.ternak')

@section('content')

<div class="mb-6">

    <h1 class="text-2xl font-bold text-gray-800">
        Edit Pengguna
    </h1>

    <p class="text-gray-500 mt-1">
        Perbarui data dan hak akses pengguna.
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

    <div class="p-5 border-b">

        <h2 class="font-semibold text-gray-800">
            Form Edit Pengguna
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            Periksa kembali data sebelum menyimpan perubahan.
        </p>

    </div>

    <form
        action="{{ route('pengguna.update', $pengguna) }}"
        method="POST"
        class="p-5"
    >

        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            {{-- Nama --}}
            <div>

                <label
                    for="name"
                    class="block text-sm font-medium text-gray-700 mb-1"
                >
                    Nama
                </label>

                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name', $pengguna->name) }}"
                    required
                    maxlength="255"
                    class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500"
                >

                @error('name')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Kode --}}
            <div>

                <label
                    for="kode"
                    class="block text-sm font-medium text-gray-700 mb-1"
                >
                    Kode Pengguna
                </label>

                <input
                    type="text"
                    name="kode"
                    id="kode"
                    value="{{ old('kode', $pengguna->kode) }}"
                    maxlength="10"
                    class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500"
                >

                @error('kode')
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
                    value="{{ old('email', $pengguna->email) }}"
                    required
                    class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500"
                >

                @error('email')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Role --}}
            <div>

                <label
                    for="role"
                    class="block text-sm font-medium text-gray-700 mb-1"
                >
                    Role
                </label>

                <select
                    name="role"
                    id="role"
                    required
                    class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500"
                >

                    <option
                        value="super_admin"
                        {{ old('role', $pengguna->role) === 'super_admin' ? 'selected' : '' }}
                    >
                        Super Admin
                    </option>

                    <option
                        value="admin_pusat"
                        {{ old('role', $pengguna->role) === 'admin_pusat' ? 'selected' : '' }}
                    >
                        Admin Pusat
                    </option>

                    <option
                        value="admin_lokasi"
                        {{ old('role', $pengguna->role) === 'admin_lokasi' ? 'selected' : '' }}
                    >
                        Admin Lokasi
                    </option>

                    <option
                        value="operator"
                        {{ old('role', $pengguna->role) === 'operator' ? 'selected' : '' }}
                    >
                        Operator
                    </option>

                    <option
                        value="mandor"
                        {{ old('role', $pengguna->role) === 'mandor' ? 'selected' : '' }}
                    >
                        Mandor
                    </option>

                </select>

                @error('role')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Lokasi --}}
            <div>

                <label
                    for="lokasi_id"
                    class="block text-sm font-medium text-gray-700 mb-1"
                >
                    Lokasi
                </label>

                <select
                    name="lokasi_id"
                    id="lokasi_id"
                    class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500"
                >

                    <option value="">
                        -- Pusat / Tidak Terikat Lokasi --
                    </option>

                    @foreach ($lokasi as $item)

                        <option
                            value="{{ $item->id }}"
                            {{ old('lokasi_id', $pengguna->lokasi_id) == $item->id ? 'selected' : '' }}
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
                        {{ old('status', $pengguna->status) === 'aktif' ? 'selected' : '' }}
                    >
                        Aktif
                    </option>

                    <option
                        value="nonaktif"
                        {{ old('status', $pengguna->status) === 'nonaktif' ? 'selected' : '' }}
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

        </div>

        {{-- Info akun --}}
        <div class="mt-6 rounded-lg bg-yellow-50 border border-yellow-200 p-4">

            <p class="text-sm text-yellow-700">
                Mengubah role atau lokasi pengguna akan memengaruhi data
                dan halaman yang dapat diakses oleh pengguna tersebut.
            </p>

        </div>

        {{-- Tombol --}}
        <div class="flex items-center justify-end gap-3 mt-6 pt-5 border-t">

            <a
                href="{{ route('pengguna.index') }}"
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