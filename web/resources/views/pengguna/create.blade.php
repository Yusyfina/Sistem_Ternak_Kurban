@extends('layouts.ternak')

@section('content')

<div class="mb-6">

    <h1 class="text-2xl font-bold text-gray-800">
        Tambah Pengguna
    </h1>

    <p class="text-gray-500 mt-1">
        Tambahkan akun pengguna baru ke dalam sistem.
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
            Form Pengguna
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            Isi data pengguna dan tentukan hak aksesnya.
        </p>

    </div>

    <form
        action="{{ route('pengguna.store') }}"
        method="POST"
        class="p-5"
    >

        @csrf

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
                    value="{{ old('name') }}"
                    required
                    maxlength="255"
                    placeholder="Masukkan nama pengguna"
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
                    value="{{ old('kode') }}"
                    maxlength="10"
                    placeholder="Contoh: OP-01"
                    class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500"
                >

                @error('kode')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

                <p class="mt-1 text-xs text-gray-500">
                    Contoh kode: OP-01, MD-01.
                </p>

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
                    value="{{ old('email') }}"
                    required
                    placeholder="contoh@email.com"
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

                    <option value="">
                        -- Pilih Role --
                    </option>

                    <option
                        value="super_admin"
                        {{ old('role') === 'super_admin' ? 'selected' : '' }}
                    >
                        Super Admin
                    </option>

                    <option
                        value="admin_pusat"
                        {{ old('role') === 'admin_pusat' ? 'selected' : '' }}
                    >
                        Admin Pusat
                    </option>

                    <option
                        value="admin_lokasi"
                        {{ old('role') === 'admin_lokasi' ? 'selected' : '' }}
                    >
                        Admin Lokasi
                    </option>

                    <option
                        value="operator"
                        {{ old('role') === 'operator' ? 'selected' : '' }}
                    >
                        Operator
                    </option>

                    <option
                        value="mandor"
                        {{ old('role') === 'mandor' ? 'selected' : '' }}
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
                            {{ old('lokasi_id') == $item->id ? 'selected' : '' }}
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

        </div>

        {{-- Password --}}
        <div class="mt-5">

            <div class="rounded-lg bg-blue-50 border border-blue-200 p-4">

                <p class="text-sm text-blue-700">
                    Password awal akun akan menggunakan password default
                    yang ditentukan oleh sistem. Pengguna dapat mengganti
                    password melalui pengaturan profil setelah login.
                </p>

            </div>

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
                Simpan Pengguna
            </button>

        </div>

    </form>

</div>

@endsection