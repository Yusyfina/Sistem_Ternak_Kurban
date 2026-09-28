@extends('layouts.ternak')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">
        Data Pesanan
    </h1>

    <p class="text-gray-500 mt-1">
        Daftar pesanan kurban dan pemasangan ternak.
    </p>
</div>

{{-- Pesan berhasil --}}
@if (session('success'))
    <div class="mb-5 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-green-700">
        {{ session('success') }}
    </div>
@endif

{{-- Pesan error --}}
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
    <div class="p-5 border-b flex justify-between items-center">

        <div>
            <h2 class="font-semibold text-gray-800">
                Daftar Pesanan
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Total: {{ $pesanan->count() }} pesanan
            </p>
        </div>

        <a
            href="{{ route('pesanan.create') }}"
            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
        >
            + Tambah Pesanan
        </a>

    </div>

    {{-- Tabel --}}
    <div class="overflow-x-auto">

        <table class="w-full text-sm">

            <thead class="bg-gray-50 border-b">

                <tr>

                    <th class="px-5 py-3 text-left">
                        No
                    </th>

                    <th class="px-5 py-3 text-left">
                        No. Pesanan
                    </th>

                    <th class="px-5 py-3 text-left">
                        Pembeli
                    </th>

                    <th class="px-5 py-3 text-left">
                        Kategori
                    </th>

                    <th class="px-5 py-3 text-left">
                        Harga
                    </th>

                    <th class="px-5 py-3 text-left">
                        Ternak
                    </th>

                    <th class="px-5 py-3 text-left">
                        Status
                    </th>

                    <th class="px-5 py-3 text-left">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse ($pesanan as $item)

                    <tr class="border-b hover:bg-gray-50">

                        {{-- No --}}
                        <td class="px-5 py-4">
                            {{ $loop->iteration }}
                        </td>

                        {{-- No Pesanan --}}
                        <td class="px-5 py-4 font-medium text-gray-800">
                            {{ $item->no_pesanan }}
                        </td>

                        {{-- Pembeli --}}
                        <td class="px-5 py-4">
                            {{ $item->pembeli->nama ?? '-' }}
                        </td>

                        {{-- Kategori --}}
                        <td class="px-5 py-4">
                            {{ $item->kategoriHarga->kategori ?? '-' }}
                        </td>

                        {{-- Harga --}}
                        <td class="px-5 py-4 whitespace-nowrap">
                            Rp {{ number_format((float) $item->harga, 0, ',', '.') }}
                        </td>

                        {{-- Ternak --}}
                        <td class="px-5 py-4">

                            @if ($item->ternak)

                                <div>
                                    <p class="font-medium text-gray-800">
                                        {{ $item->ternak->kode_ternak }}
                                    </p>

                                    <p class="text-xs text-gray-500">
                                        {{ $item->ternak->bobot_terakhir ?? '-' }} kg
                                    </p>
                                </div>

                            @else

                                <span class="text-gray-400">
                                    Belum dipasangkan
                                </span>

                            @endif

                        </td>

                        {{-- Status --}}
                        <td class="px-5 py-4">

                            @if ($item->status === 'menunggu_pemasangan')

                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">
                                    Menunggu Pemasangan
                                </span>

                            @elseif ($item->status === 'terpasang')

                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                    Terpasang
                                </span>

                            @elseif ($item->status === 'dibatalkan')

                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                    Dibatalkan
                                </span>

                            @else

                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                    {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                </span>

                            @endif

                        </td>

                        {{-- Aksi --}}
                        <td class="px-5 py-4">

                            <div class="flex items-center gap-3">

                                @if ($item->status === 'menunggu_pemasangan')

                                    <a
                                        href="{{ route('pesanan.edit', $item) }}"
                                        class="text-blue-600 hover:text-blue-800 font-medium"
                                    >
                                        Edit
                                    </a>

                                    <button
                                        type="button"
                                        onclick="document.getElementById('modal-pasangkan-{{ $item->id }}').classList.remove('hidden')"
                                        class="text-green-600 hover:text-green-800 font-medium"
                                    >
                                        Pasangkan
                                    </button>

                                @else

                                    <a
                                        href="{{ route('pesanan.edit', $item) }}"
                                        class="text-blue-600 hover:text-blue-800 font-medium"
                                    >
                                        Edit
                                    </a>

                                @endif

                                <form
                                    action="{{ route('pesanan.destroy', $item) }}"
                                    method="POST"
                                    onsubmit="return confirm('Apakah kamu yakin ingin menghapus pesanan ini?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="text-red-600 hover:text-red-800 font-medium"
                                    >
                                        Hapus
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    {{-- Modal Pasangkan --}}
                    @if ($item->status === 'menunggu_pemasangan')

                        <div
                            id="modal-pasangkan-{{ $item->id }}"
                            class="hidden fixed inset-0 z-50 overflow-y-auto"
                        >

                            <div class="flex items-center justify-center min-h-screen px-4">

                                {{-- Background --}}
                                <div
                                    class="fixed inset-0 bg-black bg-opacity-40"
                                    onclick="document.getElementById('modal-pasangkan-{{ $item->id }}').classList.add('hidden')"
                                ></div>

                                {{-- Modal --}}
                                <div class="relative bg-white rounded-lg shadow-xl w-full max-w-lg p-6">

                                    <div class="flex justify-between items-center mb-5">

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
                                            class="text-gray-400 hover:text-gray-600 text-xl"
                                        >
                                            &times;
                                        </button>

                                    </div>

                                    <form
                                        action="{{ route('pesanan.pasangkan', $item) }}"
                                        method="POST"
                                    >

                                        @csrf

                                        <div class="mb-5">

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
                                                class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500"
                                            >

                                                <option value="">
                                                    Pilih ternak
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

                                        <div class="flex justify-end gap-3">

                                            <button
                                                type="button"
                                                onclick="document.getElementById('modal-pasangkan-{{ $item->id }}').classList.add('hidden')"
                                                class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50"
                                            >
                                                Batal
                                            </button>

                                            <button
                                                type="submit"
                                                class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700"
                                            >
                                                Pasangkan Ternak
                                            </button>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                    @endif

                @empty

                    <tr>

                        <td
                            colspan="8"
                            class="px-5 py-12 text-center text-gray-500"
                        >
                            Belum ada data pesanan.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection