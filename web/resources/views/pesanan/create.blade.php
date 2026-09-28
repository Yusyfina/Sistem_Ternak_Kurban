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
                Form Pesanan
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Pilih pembeli dan kategori harga ternak.
            </p>

        </div>


        {{-- FORM --}}
        <form
            action="{{ route('pesanan.store') }}"
            method="POST"
        >

            @csrf


            <div class="p-6 space-y-6">

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
                                {{ old('kategori_harga_id') == $kategori->id ? 'selected' : '' }}
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


                {{-- INFORMASI --}}
                <div class="rounded-lg bg-blue-50 border border-blue-200 p-4">

                    <div class="flex gap-3">

                        <div class="flex-shrink-0">

                            <div class="w-8 h-8 rounded-full
                                        bg-blue-100 flex items-center
                                        justify-center">

                                <span class="text-blue-600 font-semibold">
                                    i
                                </span>

                            </div>

                        </div>

                        <div>

                            <h3 class="text-sm font-semibold text-blue-800">
                                Informasi Pesanan
                            </h3>

                            <p class="text-sm text-blue-700 mt-1">
                                Setelah pesanan dibuat, status awal akan menjadi
                                <strong>Menunggu Pemasangan</strong>.
                                Ternak dapat dipasangkan setelah pesanan berhasil dibuat.
                            </p>

                        </div>

                    </div>

                </div>

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
                    Simpan Pesanan
                </button>

            </div>

        </form>

    </div>

</div>

@endsection