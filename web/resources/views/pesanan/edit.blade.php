@extends('layouts.ternak')

@section('content')

<div class="mb-6">

    <h1 class="text-2xl font-bold text-gray-800">
        Edit Pesanan
    </h1>

    <p class="text-gray-500 mt-1">
        Perbarui data pesanan yang sudah dibuat.
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
            Form Edit Pesanan
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            No. Pesanan:
            <span class="font-medium text-gray-700">
                {{ $pesanan->no_pesanan }}
            </span>
        </p>

    </div>

    {{-- Form --}}
    <form
        action="{{ route('pesanan.update', $pesanan) }}"
        method="POST"
        class="p-5"
    >

        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            {{-- No Pesanan --}}
            <div>

                <label
                    class="block text-sm font-medium text-gray-700 mb-1"
                >
                    No. Pesanan
                </label>

                <input
                    type="text"
                    value="{{ $pesanan->no_pesanan }}"
                    readonly
                    class="w-full bg-gray-100 border-gray-300 rounded-lg text-gray-600"
                >

                <p class="mt-1 text-xs text-gray-500">
                    Nomor pesanan dibuat otomatis oleh sistem.
                </p>

            </div>

            {{-- Pembeli --}}
            <div>

                <label
                    for="pembeli_id"
                    class="block text-sm font-medium text-gray-700 mb-1"
                >
                    Pembeli
                </label>

                <select
                    name="pembeli_id"
                    id="pembeli_id"
                    required
                    class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500"
                >

                    <option value="">
                        Pilih pembeli
                    </option>

                    @foreach ($pembeli as $item)

                        <option
                            value="{{ $item->id }}"
                            {{ old('pembeli_id', $pesanan->pembeli_id) == $item->id ? 'selected' : '' }}
                        >
                            {{ $item->nama }}

                            @if ($item->telepon)
                                - {{ $item->telepon }}
                            @endif

                        </option>

                    @endforeach

                </select>

                @error('pembeli_id')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Kategori Harga --}}
            <div>

                <label
                    for="kategori_harga_id"
                    class="block text-sm font-medium text-gray-700 mb-1"
                >
                    Kategori Harga
                </label>

                <select
                    name="kategori_harga_id"
                    id="kategori_harga_id"
                    required
                    class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500"
                >

                    <option value="">
                        Pilih kategori harga
                    </option>

                    @foreach ($kategoriHarga as $kategori)

                        <option
                            value="{{ $kategori->id }}"
                            {{ old('kategori_harga_id', $pesanan->kategori_harga_id) == $kategori->id ? 'selected' : '' }}
                        >

                            {{ $kategori->kategori }}

                            -
                            {{ ucfirst($kategori->spesies) }}

                            -
                            {{ $kategori->bobot_min }} - {{ $kategori->bobot_max }} kg

                            -
                            Rp {{ number_format((float) $kategori->harga, 0, ',', '.') }}

                        </option>

                    @endforeach

                </select>

                @error('kategori_harga_id')
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
                        value="menunggu_pemasangan"
                        {{ old('status', $pesanan->status) === 'menunggu_pemasangan' ? 'selected' : '' }}
                    >
                        Menunggu Pemasangan
                    </option>

                    <option
                        value="terpasang"
                        {{ old('status', $pesanan->status) === 'terpasang' ? 'selected' : '' }}
                    >
                        Terpasang
                    </option>

                    <option
                        value="dibatalkan"
                        {{ old('status', $pesanan->status) === 'dibatalkan' ? 'selected' : '' }}
                    >
                        Dibatalkan
                    </option>

                </select>

                @error('status')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

        </div>

        {{-- Informasi ternak --}}
        @if ($pesanan->ternak)

            <div class="mt-6 rounded-lg bg-green-50 border border-green-200 p-4">

                <p class="text-sm font-medium text-green-800">
                    Ternak yang sudah dipasangkan
                </p>

                <div class="mt-2 text-sm text-green-700">

                    <p>
                        Kode:
                        <strong>
                            {{ $pesanan->ternak->kode_ternak }}
                        </strong>
                    </p>

                    <p>
                        Jenis:
                        {{ $pesanan->ternak->jenisTernak->nama_jenis ?? '-' }}
                    </p>

                    <p>
                        Bobot:
                        {{ $pesanan->ternak->bobot_terakhir ?? '-' }} kg
                    </p>

                    <p>
                        Lokasi:
                        {{ $pesanan->ternak->lokasi->nama ?? '-' }}
                    </p>

                </div>

            </div>

        @else

            <div class="mt-6 rounded-lg bg-yellow-50 border border-yellow-200 p-4">

                <p class="text-sm text-yellow-700">
                    Pesanan ini belum memiliki ternak yang dipasangkan.
                </p>

            </div>

        @endif

        {{-- Tombol --}}
        <div class="flex items-center justify-end gap-3 mt-6 pt-5 border-t">

            <a
                href="{{ route('pesanan.index') }}"
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