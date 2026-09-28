@extends('layouts.ternak')

@section('content')

<div class="mb-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Data Pesanan
            </h1>

            <p class="text-gray-500 mt-1">
                Daftar pesanan kurban dan pemasangan ternak.
            </p>
        </div>

        <a
            href="{{ route('pesanan.create') }}"
            class="inline-flex items-center justify-center px-4 py-2.5
                   bg-blue-600 text-white text-sm font-medium rounded-lg
                   hover:bg-blue-700 transition"
        >
            + Tambah Pesanan
        </a>

    </div>
</div>


{{-- NOTIFIKASI BERHASIL --}}
@if (session('success'))
    <div class="mb-5 rounded-lg bg-green-50 border border-green-200 px-4 py-3">
        <div class="flex items-center gap-2">
            <span class="text-green-600 font-semibold">
                Berhasil
            </span>

            <p class="text-sm text-green-700">
                {{ session('success') }}
            </p>
        </div>
    </div>
@endif


{{-- NOTIFIKASI ERROR --}}
@if (session('error'))
    <div class="mb-5 rounded-lg bg-red-50 border border-red-200 px-4 py-3">
        <div class="flex items-center gap-2">
            <span class="text-red-600 font-semibold">
                Gagal
            </span>

            <p class="text-sm text-red-700">
                {{ session('error') }}
            </p>
        </div>
    </div>
@endif


{{-- ERROR VALIDASI --}}
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


{{-- CARD UTAMA --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">

    {{-- HEADER --}}
    <div class="p-5 border-b border-gray-200">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">

            <div>
                <h2 class="font-semibold text-gray-800">
                    Daftar Pesanan
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Total
                    <span class="font-medium text-gray-700">
                        {{ method_exists($pesanan, 'total') ? $pesanan->total() : $pesanan->count() }}
                    </span>
                    pesanan
                </p>
            </div>

        </div>

    </div>


    {{-- TABLE --}}
    <div class="overflow-x-auto">

        <table class="w-full text-sm">

            <thead class="bg-gray-50 border-b border-gray-200">

                <tr>

                    <th class="px-5 py-3 text-left font-semibold text-gray-600 whitespace-nowrap">
                        No
                    </th>

                    <th class="px-5 py-3 text-left font-semibold text-gray-600 whitespace-nowrap">
                        No. Pesanan
                    </th>

                    <th class="px-5 py-3 text-left font-semibold text-gray-600">
                        Pembeli
                    </th>

                    <th class="px-5 py-3 text-left font-semibold text-gray-600">
                        Kategori
                    </th>

                    <th class="px-5 py-3 text-left font-semibold text-gray-600 whitespace-nowrap">
                        Harga
                    </th>

                    <th class="px-5 py-3 text-left font-semibold text-gray-600">
                        Ternak
                    </th>

                    <th class="px-5 py-3 text-left font-semibold text-gray-600">
                        Status
                    </th>

                    <th class="px-5 py-3 text-left font-semibold text-gray-600 whitespace-nowrap">
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody class="divide-y divide-gray-100">

                @forelse ($pesanan as $item)

                    <tr class="hover:bg-gray-50 transition">

                        {{-- NO --}}
                        <td class="px-5 py-4 text-gray-500">
                            {{ method_exists($pesanan, 'firstItem') && $pesanan->firstItem() !== null
                                ? $pesanan->firstItem() + $loop->index
                                : $loop->iteration }}
                        </td>


                        {{-- NO PESANAN --}}
                        <td class="px-5 py-4">

                            <div class="font-semibold text-gray-800">
                                {{ $item->no_pesanan }}
                            </div>

                        </td>


                        {{-- PEMBELI --}}
                        <td class="px-5 py-4">

                            <div>
                                <p class="font-medium text-gray-800">
                                    {{ $item->pembeli->nama ?? '-' }}
                                </p>

                                @if ($item->pembeli?->telepon)
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $item->pembeli->telepon }}
                                    </p>
                                @endif
                            </div>

                        </td>


                        {{-- KATEGORI --}}
                        <td class="px-5 py-4">

                            <div>
                                <p class="font-medium text-gray-700">
                                    {{ $item->kategoriHarga->kategori ?? '-' }}
                                </p>

                                @if ($item->kategoriHarga)
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ ucfirst($item->kategoriHarga->spesies) }}
                                        ·
                                        {{ $item->kategoriHarga->bobot_min }} -
                                        {{ $item->kategoriHarga->bobot_max }} kg
                                    </p>
                                @endif
                            </div>

                        </td>


                        {{-- HARGA --}}
                        <td class="px-5 py-4 whitespace-nowrap">

                            <span class="font-semibold text-gray-800">
                                Rp {{ number_format((float) $item->harga, 0, ',', '.') }}
                            </span>

                        </td>


                        {{-- TERNAK --}}
                        <td class="px-5 py-4">

                            @if ($item->ternak)

                                <div>

                                    <p class="font-semibold text-gray-800">
                                        {{ $item->ternak->kode_ternak }}
                                    </p>

                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $item->ternak->jenisTernak->nama_jenis ?? '-' }}
                                    </p>

                                    <p class="text-xs text-gray-500">
                                        {{ $item->ternak->bobot_terakhir ?? '-' }} kg
                                    </p>

                                </div>

                            @else

                                <span class="inline-flex px-2.5 py-1 rounded-full
                                             text-xs font-medium
                                             bg-gray-100 text-gray-500">
                                    Belum dipasangkan
                                </span>

                            @endif

                        </td>


                        {{-- STATUS --}}
                        <td class="px-5 py-4">

                            @if ($item->status === 'menunggu_pemasangan')

                                <span class="inline-flex items-center px-2.5 py-1
                                             rounded-full text-xs font-medium
                                             bg-yellow-100 text-yellow-700">
                                    Menunggu Pemasangan
                                </span>

                            @elseif ($item->status === 'terpasang')

                                <span class="inline-flex items-center px-2.5 py-1
                                             rounded-full text-xs font-medium
                                             bg-green-100 text-green-700">
                                    Terpasang
                                </span>

                            @elseif ($item->status === 'dibatalkan')

                                <span class="inline-flex items-center px-2.5 py-1
                                             rounded-full text-xs font-medium
                                             bg-red-100 text-red-700">
                                    Dibatalkan
                                </span>

                            @else

                                <span class="inline-flex items-center px-2.5 py-1
                                             rounded-full text-xs font-medium
                                             bg-gray-100 text-gray-600">
                                    {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                </span>

                            @endif

                        </td>


                        {{-- AKSI --}}
                        <td class="px-5 py-4">

                            <div class="flex items-center gap-3">

                                {{-- EDIT --}}
                                <a
                                    href="{{ route('pesanan.edit', $item) }}"
                                    class="text-blue-600 hover:text-blue-800
                                           font-medium transition"
                                >
                                    Edit
                                </a>


                                {{-- PASANGKAN --}}
                                @if ($item->status === 'menunggu_pemasangan')

                                    <button
                                        type="button"
                                        onclick="document.getElementById('modal-pasangkan-{{ $item->id }}').classList.remove('hidden')"
                                        class="text-green-600 hover:text-green-800
                                               font-medium transition"
                                    >
                                        Pasangkan
                                    </button>

                                @endif


                                {{-- HAPUS --}}
                                <button
                                    type="button"
                                    onclick="document.getElementById('modal-hapus-{{ $item->id }}').classList.remove('hidden')"
                                    class="text-red-600 hover:text-red-800
                                           font-medium transition"
                                >
                                    Hapus
                                </button>

                            </div>

                        </td>

                    </tr>


                    {{-- ================================================= --}}
                    {{-- MODAL PASANGKAN --}}
                    {{-- ================================================= --}}

                    @if ($item->status === 'menunggu_pemasangan')

                        <div
                            id="modal-pasangkan-{{ $item->id }}"
                            class="hidden fixed inset-0 z-50 overflow-y-auto"
                        >

                            <div class="flex items-center justify-center min-h-screen px-4">

                                {{-- OVERLAY --}}
                                <div
                                    class="fixed inset-0 bg-black/40"
                                    onclick="document.getElementById('modal-pasangkan-{{ $item->id }}').classList.add('hidden')"
                                ></div>


                                {{-- MODAL --}}
                                <div class="relative bg-white rounded-xl shadow-xl
                                            w-full max-w-lg overflow-hidden">

                                    {{-- HEADER --}}
                                    <div class="px-6 py-5 border-b border-gray-200">

                                        <div class="flex items-start justify-between">

                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-800">
                                                    Pasangkan Pesanan
                                                </h3>

                                                <p class="text-sm text-gray-500 mt-1">
                                                    {{ $item->no_pesanan }}
                                                </p>
                                            </div>

                                            <button
                                                type="button"
                                                onclick="document.getElementById('modal-pasangkan-{{ $item->id }}').classList.add('hidden')"
                                                class="text-gray-400 hover:text-gray-600
                                                       text-2xl leading-none"
                                            >
                                                &times;
                                            </button>

                                        </div>

                                    </div>


                                    {{-- FORM --}}
                                    <form
                                        action="{{ route('pesanan.pasangkan', $item) }}"
                                        method="POST"
                                    >
                                        @csrf

                                        <div class="p-6">

                                            <label
                                                for="ternak_id_{{ $item->id }}"
                                                class="block text-sm font-medium text-gray-700 mb-2"
                                            >
                                                Pilih Ternak
                                            </label>

                                            <select
                                                name="ternak_id"
                                                id="ternak_id_{{ $item->id }}"
                                                required
                                                class="w-full rounded-lg border-gray-300
                                                       focus:border-green-500
                                                       focus:ring-green-500"
                                            >

                                                <option value="">
                                                    -- Pilih Ternak --
                                                </option>

                                                @foreach ($ternakTersedia ?? [] as $ternak)

                                                    <option value="{{ $ternak->id }}">

                                                        {{ $ternak->kode_ternak }}

                                                        -

                                                        {{ $ternak->jenisTernak->nama_jenis ?? '-' }}

                                                        -

                                                        {{ $ternak->bobot_terakhir ?? '-' }} kg

                                                        -

                                                        {{ $ternak->lokasi->nama ?? '-' }}

                                                    </option>

                                                @endforeach

                                            </select>


                                            <p class="mt-2 text-xs text-gray-500">
                                                Hanya ternak dengan status tersedia yang dapat dipasangkan.
                                            </p>

                                        </div>


                                        {{-- BUTTON --}}
                                        <div class="px-6 py-4 bg-gray-50 border-t
                                                    flex justify-end gap-3">

                                            <button
                                                type="button"
                                                onclick="document.getElementById('modal-pasangkan-{{ $item->id }}').classList.add('hidden')"
                                                class="px-4 py-2 border border-gray-300
                                                       text-gray-700 rounded-lg
                                                       hover:bg-gray-100 transition"
                                            >
                                                Batal
                                            </button>

                                            <button
                                                type="submit"
                                                class="px-4 py-2 bg-green-600 text-white
                                                       rounded-lg hover:bg-green-700
                                                       transition"
                                            >
                                                Pasangkan Ternak
                                            </button>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                    @endif


                    {{-- ================================================= --}}
                    {{-- MODAL HAPUS --}}
                    {{-- ================================================= --}}

                    <div
                        id="modal-hapus-{{ $item->id }}"
                        class="hidden fixed inset-0 z-50 overflow-y-auto"
                    >

                        <div class="flex items-center justify-center min-h-screen px-4">

                            {{-- OVERLAY --}}
                            <div
                                class="fixed inset-0 bg-black/40"
                                onclick="document.getElementById('modal-hapus-{{ $item->id }}').classList.add('hidden')"
                            ></div>


                            {{-- MODAL --}}
                            <div class="relative bg-white rounded-xl shadow-xl
                                        w-full max-w-md overflow-hidden">

                                {{-- ICON --}}
                                <div class="pt-6 flex justify-center">

                                    <div class="w-12 h-12 rounded-full
                                                bg-red-100 flex items-center
                                                justify-center">

                                        <svg
                                            class="w-6 h-6 text-red-600"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3m-4 0h14"
                                            />
                                        </svg>

                                    </div>

                                </div>


                                {{-- CONTENT --}}
                                <div class="px-6 py-5 text-center">

                                    <h3 class="text-lg font-semibold text-gray-800">
                                        Hapus Pesanan?
                                    </h3>

                                    <p class="text-sm text-gray-500 mt-2">
                                        Apakah kamu yakin ingin menghapus pesanan
                                        <span class="font-semibold text-gray-700">
                                            {{ $item->no_pesanan }}
                                        </span>
                                        ?
                                    </p>

                                    <p class="text-xs text-gray-400 mt-2">
                                        Data yang sudah dihapus tidak dapat dikembalikan.
                                    </p>

                                </div>


                                {{-- BUTTON --}}
                                <div class="px-6 py-4 bg-gray-50 border-t
                                            flex justify-end gap-3">

                                    <button
                                        type="button"
                                        onclick="document.getElementById('modal-hapus-{{ $item->id }}').classList.add('hidden')"
                                        class="px-4 py-2 border border-gray-300
                                               text-gray-700 rounded-lg
                                               hover:bg-gray-100 transition"
                                    >
                                        Batal
                                    </button>


                                    <form
                                        action="{{ route('pesanan.destroy', $item) }}"
                                        method="POST"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="px-4 py-2 bg-red-600 text-white
                                                   rounded-lg hover:bg-red-700
                                                   transition"
                                        >
                                            Ya, Hapus
                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                @empty

                    <tr>

                        <td
                            colspan="8"
                            class="px-5 py-14 text-center"
                        >

                            <div class="flex flex-col items-center">

                                <div class="w-12 h-12 rounded-full
                                            bg-gray-100 flex items-center
                                            justify-center mb-3">

                                    <svg
                                        class="w-6 h-6 text-gray-400"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 14h6m-7 4h8M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"
                                        />
                                    </svg>

                                </div>

                                <p class="font-medium text-gray-600">
                                    Belum ada data pesanan.
                                </p>

                                <p class="text-sm text-gray-400 mt-1">
                                    Silakan tambahkan pesanan baru.
                                </p>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- PAGINATION --}}
    @if (method_exists($pesanan, 'hasPages') && $pesanan->hasPages())

        <div class="px-5 py-4 border-t border-gray-200">
            {{ $pesanan->links() }}
        </div>

    @endif

</div>

@endsection