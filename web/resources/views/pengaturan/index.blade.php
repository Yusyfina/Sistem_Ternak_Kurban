@extends('layouts.ternak')

@section('content')

<div class="mb-6">

    <h1 class="text-2xl font-bold text-gray-800">
        Pengaturan Sistem
    </h1>

    <p class="text-gray-500 mt-1">
        Kelola master jenis ternak serta kategori dan harga ternak.
    </p>

</div>

{{-- Pesan sukses --}}
@if (session('success'))

    <div class="mb-5 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-green-700">
        {{ session('success') }}
    </div>

@endif

{{-- Error --}}
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


{{-- ========================================================= --}}
{{-- JENIS TERNAK --}}
{{-- ========================================================= --}}

<div class="bg-white rounded-lg shadow-sm mb-6">

    <div class="p-5 border-b">

        <h2 class="font-semibold text-gray-800">
            Jenis Ternak
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            Tambahkan jenis ternak yang digunakan dalam sistem.
        </p>

    </div>

    <div class="p-5">

        {{-- Form tambah jenis --}}
        <form
            action="{{ route('pengaturan.jenis.store') }}"
            method="POST"
            class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end mb-6"
        >

            @csrf

            {{-- Spesies --}}
            <div>

                <label
                    for="spesies_jenis"
                    class="block text-sm font-medium text-gray-700 mb-1"
                >
                    Spesies
                </label>

                <select
                    name="spesies"
                    id="spesies_jenis"
                    required
                    class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500"
                >

                    <option value="">
                        -- Pilih Spesies --
                    </option>

                    <option
                        value="domba"
                        {{ old('spesies') === 'domba' ? 'selected' : '' }}
                    >
                        Domba
                    </option>

                    <option
                        value="sapi"
                        {{ old('spesies') === 'sapi' ? 'selected' : '' }}
                    >
                        Sapi
                    </option>

                </select>

            </div>

            {{-- Nama jenis --}}
            <div>

                <label
                    for="nama_jenis"
                    class="block text-sm font-medium text-gray-700 mb-1"
                >
                    Nama Jenis
                </label>

                <input
                    type="text"
                    name="nama_jenis"
                    id="nama_jenis"
                    value="{{ old('nama_jenis') }}"
                    required
                    maxlength="255"
                    placeholder="Contoh: Domba Garut"
                    class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500"
                >

            </div>

            {{-- Tombol --}}
            <div>

                <button
                    type="submit"
                    class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
                >
                    + Tambah Jenis Ternak
                </button>

            </div>

        </form>


        {{-- Daftar jenis --}}
        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-50 border-b">

                    <tr>

                        <th class="px-4 py-3 text-left">
                            No
                        </th>

                        <th class="px-4 py-3 text-left">
                            Spesies
                        </th>

                        <th class="px-4 py-3 text-left">
                            Nama Jenis
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse ($jenisTernak as $item)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="px-4 py-3">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-4 py-3">

                                @if ($item->spesies === 'domba')

                                    <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">
                                        Domba
                                    </span>

                                @else

                                    <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                                        Sapi
                                    </span>

                                @endif

                            </td>

                            <td class="px-4 py-3 font-medium text-gray-800">
                                {{ $item->nama_jenis }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="3"
                                class="px-4 py-8 text-center text-gray-500"
                            >
                                Belum ada jenis ternak.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- KATEGORI HARGA --}}
{{-- ========================================================= --}}

<div class="bg-white rounded-lg shadow-sm">

    <div class="p-5 border-b">

        <h2 class="font-semibold text-gray-800">
            Kategori dan Harga Ternak
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            Atur kategori ternak berdasarkan spesies, rentang bobot, dan harga.
        </p>

    </div>

    <div class="p-5">

        {{-- Form tambah kategori --}}
        <form
            action="{{ route('pengaturan.kategori.store') }}"
            method="POST"
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6"
        >

            @csrf

            {{-- Kategori --}}
            <div>

                <label
                    for="kategori"
                    class="block text-sm font-medium text-gray-700 mb-1"
                >
                    Kategori
                </label>

                <input
                    type="text"
                    name="kategori"
                    id="kategori"
                    value="{{ old('kategori') }}"
                    required
                    placeholder="Contoh: Domba A"
                    class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500"
                >

            </div>

            {{-- Spesies --}}
            <div>

                <label
                    for="spesies_kategori"
                    class="block text-sm font-medium text-gray-700 mb-1"
                >
                    Spesies
                </label>

                <select
                    name="spesies"
                    id="spesies_kategori"
                    required
                    class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500"
                >

                    <option value="">
                        -- Pilih Spesies --
                    </option>

                    <option
                        value="domba"
                        {{ old('spesies') === 'domba' ? 'selected' : '' }}
                    >
                        Domba
                    </option>

                    <option
                        value="sapi"
                        {{ old('spesies') === 'sapi' ? 'selected' : '' }}
                    >
                        Sapi
                    </option>

                </select>

            </div>

            {{-- Bobot minimum --}}
            <div>

                <label
                    for="bobot_min"
                    class="block text-sm font-medium text-gray-700 mb-1"
                >
                    Bobot Minimum (kg)
                </label>

                <input
                    type="number"
                    name="bobot_min"
                    id="bobot_min"
                    value="{{ old('bobot_min') }}"
                    required
                    min="0"
                    step="0.1"
                    placeholder="Contoh: 20"
                    class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500"
                >

            </div>

            {{-- Bobot maksimum --}}
            <div>

                <label
                    for="bobot_max"
                    class="block text-sm font-medium text-gray-700 mb-1"
                >
                    Bobot Maksimum (kg)
                </label>

                <input
                    type="number"
                    name="bobot_max"
                    id="bobot_max"
                    value="{{ old('bobot_max') }}"
                    required
                    min="0"
                    step="0.1"
                    placeholder="Contoh: 30"
                    class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500"
                >

            </div>

            {{-- Harga --}}
            <div>

                <label
                    for="harga"
                    class="block text-sm font-medium text-gray-700 mb-1"
                >
                    Harga (Rp)
                </label>

                <input
                    type="number"
                    name="harga"
                    id="harga"
                    value="{{ old('harga') }}"
                    required
                    min="0"
                    step="1"
                    placeholder="Contoh: 2400000"
                    class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500"
                >

            </div>

            {{-- Tombol --}}
            <div class="md:col-span-2 lg:col-span-3">

                <button
                    type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
                >
                    + Tambah Kategori Harga
                </button>

            </div>

        </form>


        {{-- Daftar kategori --}}
        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-50 border-b">

                    <tr>

                        <th class="px-4 py-3 text-left">
                            No
                        </th>

                        <th class="px-4 py-3 text-left">
                            Kategori
                        </th>

                        <th class="px-4 py-3 text-left">
                            Spesies
                        </th>

                        <th class="px-4 py-3 text-left">
                            Bobot
                        </th>

                        <th class="px-4 py-3 text-left">
                            Harga
                        </th>

                        <th class="px-4 py-3 text-left">
                            Status
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse ($kategori as $item)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="px-4 py-3">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-4 py-3 font-medium text-gray-800">
                                {{ $item->kategori }}
                            </td>

                            <td class="px-4 py-3">
                                {{ ucfirst($item->spesies) }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $item->bobot_min }} -
                                {{ $item->bobot_max }} kg
                            </td>

                            <td class="px-4 py-3 font-medium">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3">

                                @if ($item->status === 'aktif')

                                    <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                        Aktif
                                    </span>

                                @else

                                    <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                        Nonaktif
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="px-4 py-8 text-center text-gray-500"
                            >
                                Belum ada kategori harga.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection