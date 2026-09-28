@extends('layouts.ternak')

@section('content')

<div class="mb-6">

    <h1 class="text-2xl font-bold text-gray-800">
        Tambah Pesanan
    </h1>

    <p class="text-gray-500 mt-1">
        Buat pesanan kurban baru untuk pembeli.
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
            Form Pesanan
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            Pilih pembeli dan kategori harga ternak.
        </p>

    </div>

    {{-- Form --}}
    <form
        action="{{ route('pesanan.store') }}"
        method="POST"
        class="p-5"
    >

        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

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
                            {{ old('pembeli_id') == $item->id ? 'selected' : '' }}
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
                            {{ old('kategori_harga_id') == $kategori->id ? 'selected' : '' }}
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

        </div>

        {{-- Informasi --}}
        <div class="mt-6 rounded-lg bg-blue-50 border border-blue-200 p-4">

            <p class="text-sm text-blue-700">

                Setelah pesanan dibuat, status awal akan menjadi
                <strong>Menunggu Pemasangan</strong>.

                Ternak akan dipasangkan setelah pesanan dibuat.

            </p>

        </div>

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
                Simpan Pesanan
            </button>

        </div>

    </form>

</div>

@endsection