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


{{-- ERROR --}}
@if ($errors->any())

    <div class="mb-5 rounded-lg bg-red-50 border border-red-200 px-4 py-3">

        <p class="font-semibold text-red-700 mb-1">
            Terjadi kesalahan:
        </p>

        <ul class="list-disc list-inside text-sm text-red-600 space-y-1">

            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

        </ul>

    </div>

@endif


<div class="max-w-4xl">

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">

        {{-- HEADER --}}
        <div class="px-6 py-5 border-b border-gray-200">

            <h2 class="text-lg font-semibold text-gray-800">
                Form Edit Pesanan
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                No. Pesanan:

                <span class="font-medium text-gray-700">
                    {{ $pesanan->no_pesanan }}
                </span>
            </p>

        </div>


        {{-- FORM --}}
        <form
            action="{{ route('pesanan.update', $pesanan) }}"
            method="POST"
        >

            @csrf
            @method('PUT')


            <div class="p-6 space-y-6">

                {{-- BARIS PERTAMA --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    {{-- NO PESANAN --}}
                    <div>

                        <label
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            No. Pesanan
                        </label>

                        <input
                            type="text"
                            value="{{ $pesanan->no_pesanan }}"
                            readonly
                            class="w-full bg-gray-100 border-gray-300
                                   rounded-lg text-gray-600"
                        >

                        <p class="mt-1 text-xs text-gray-500">
                            Nomor pesanan dibuat otomatis oleh sistem.
                        </p>

                    </div>


                    {{-- PEMBELI --}}
                    <div>

                        <label
                            for="pembeli_id"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Pembeli
                        </label>

                        <select
                            name="pembeli_id"
                            id="pembeli_id"
                            required
                            class="w-full rounded-lg border-gray-300
                                   focus:border-blue-500
                                   focus:ring-blue-500"
                        >

                            <option value="">
                                -- Pilih Pembeli --
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


                    {{-- KATEGORI HARGA --}}
                    <div>

                        <label
                            for="kategori_harga_id"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Kategori Harga
                        </label>

                        <select
                            name="kategori_harga_id"
                            id="kategori_harga_id"
                            required
                            class="w-full rounded-lg border-gray-300
                                   focus:border-blue-500
                                   focus:ring-blue-500"
                        >

                            <option value="">
                                -- Pilih Kategori Harga --
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
                                    {{ $kategori->bobot_min }} -
                                    {{ $kategori->bobot_max }} kg

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
                            required
                            class="w-full rounded-lg border-gray-300
                                   focus:border-blue-500
                                   focus:ring-blue-500"
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


                {{-- INFORMASI TERNAK --}}
                @if ($pesanan->ternak)

                    <div class="rounded-xl bg-green-50 border border-green-200 p-5">

                        <div class="flex items-start gap-3">

                            <div class="w-9 h-9 rounded-full
                                        bg-green-100 flex items-center
                                        justify-center flex-shrink-0">

                                <svg
                                    class="w-5 h-5 text-green-600"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 13l4 4L19 7"
                                    />
                                </svg>

                            </div>

                            <div class="flex-1">

                                <h3 class="text-sm font-semibold text-green-800">
                                    Ternak Sudah Dipasangkan
                                </h3>

                                <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm">

                                    <div>
                                        <p class="text-green-600">
                                            Kode Ternak
                                        </p>

                                        <p class="font-semibold text-green-800">
                                            {{ $pesanan->ternak->kode_ternak }}
                                        </p>
                                    </div>


                                    <div>
                                        <p class="text-green-600">
                                            Jenis
                                        </p>

                                        <p class="font-semibold text-green-800">
                                            {{ $pesanan->ternak->jenisTernak->nama_jenis ?? '-' }}
                                        </p>
                                    </div>


                                    <div>
                                        <p class="text-green-600">
                                            Bobot
                                        </p>

                                        <p class="font-semibold text-green-800">
                                            {{ $pesanan->ternak->bobot_terakhir ?? '-' }} kg
                                        </p>
                                    </div>


                                    <div>
                                        <p class="text-green-600">
                                            Lokasi
                                        </p>

                                        <p class="font-semibold text-green-800">
                                            {{ $pesanan->ternak->lokasi->nama ?? '-' }}
                                        </p>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                @else

                    <div class="rounded-xl bg-yellow-50 border border-yellow-200 p-5">

                        <div class="flex items-start gap-3">

                            <div class="w-9 h-9 rounded-full
                                        bg-yellow-100 flex items-center
                                        justify-center flex-shrink-0">

                                <span class="text-yellow-700 font-semibold">
                                    !
                                </span>

                            </div>

                            <div>

                                <h3 class="text-sm font-semibold text-yellow-800">
                                    Ternak Belum Dipasangkan
                                </h3>

                                <p class="text-sm text-yellow-700 mt-1">
                                    Pesanan ini belum memiliki ternak yang dipasangkan.
                                </p>

                            </div>

                        </div>

                    </div>

                @endif

            </div>


            {{-- BUTTON --}}
            <div class="px-6 py-4 bg-gray-50 border-t
                        flex justify-end gap-3">

                <a
                    href="{{ route('pesanan.index') }}"
                    class="px-5 py-2.5 border border-gray-300
                           text-gray-700 rounded-lg
                           hover:bg-gray-100 transition"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="px-5 py-2.5 bg-blue-600 text-white
                           rounded-lg hover:bg-blue-700
                           transition"
                >
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>

@endsection