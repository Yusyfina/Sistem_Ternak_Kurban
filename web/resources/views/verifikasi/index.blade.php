@extends('layouts.ternak')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">
        Verifikasi Penimbangan
    </h1>

    <p class="text-gray-500 mt-1">
        Verifikasi hasil penimbangan ternak yang masih menunggu pemeriksaan.
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
    <div class="p-5 border-b">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-gray-800">
                    Daftar Menunggu Verifikasi
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Data penimbangan yang belum diverifikasi.
                </p>
            </div>

            <div class="px-3 py-2 bg-yellow-50 text-yellow-700 rounded-lg text-sm font-medium">
                {{ $penimbangan->total() }} Menunggu
            </div>
        </div>
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
                        Tanggal
                    </th>

                    <th class="px-5 py-3 text-left">
                        Kode Ternak
                    </th>

                    <th class="px-5 py-3 text-left">
                        Jenis
                    </th>

                    <th class="px-5 py-3 text-left">
                        Lokasi
                    </th>

                    <th class="px-5 py-3 text-left">
                        Bobot
                    </th>

                    <th class="px-5 py-3 text-left">
                        Metode
                    </th>

                    <th class="px-5 py-3 text-left">
                        Operator
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

                @forelse ($penimbangan as $item)

                    <tr class="border-b hover:bg-gray-50">

                        {{-- No --}}
                        <td class="px-5 py-4">
                            {{ $penimbangan->firstItem() + $loop->index }}
                        </td>

                        {{-- Tanggal --}}
                        <td class="px-5 py-4 whitespace-nowrap">
                            @if ($item->ditimbang_at)
                                {{ $item->ditimbang_at->format('d/m/Y H:i') }}
                            @else
                                -
                            @endif
                        </td>

                        {{-- Kode ternak --}}
                        <td class="px-5 py-4 font-medium text-gray-800">
                            {{ $item->ternak->kode_ternak ?? '-' }}
                        </td>

                        {{-- Jenis --}}
                        <td class="px-5 py-4">
                            {{ $item->ternak->jenisTernak->nama_jenis ?? '-' }}
                        </td>

                        {{-- Lokasi --}}
                        <td class="px-5 py-4">
                            {{ $item->ternak->lokasi->nama ?? '-' }}
                        </td>

                        {{-- Bobot --}}
                        <td class="px-5 py-4 font-medium">
                            {{ number_format((float) $item->bobot, 1, ',', '.') }}
                            kg
                        </td>

                        {{-- Metode --}}
                        <td class="px-5 py-4">
                            @php
                                $metode = [
                                    'manual' => 'Manual',
                                    'estimasi' => 'Estimasi',
                                    'otomatis_iot' => 'Otomatis IoT',
                                ];
                            @endphp

                            {{ $metode[$item->metode] ?? ucfirst($item->metode) }}
                        </td>

                        {{-- Operator --}}
                        <td class="px-5 py-4">
                            {{ $item->operator->name ?? '-' }}
                        </td>

                        {{-- Status --}}
                        <td class="px-5 py-4">

                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">
                                Menunggu
                            </span>

                        </td>

                        {{-- Aksi --}}
                        <td class="px-5 py-4">

                            <details class="relative">

                                <summary class="cursor-pointer list-none inline-flex items-center px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                    Verifikasi
                                </summary>

                                <div class="absolute right-0 z-10 mt-2 w-80 bg-white border rounded-lg shadow-lg p-4">

                                    <form
                                        action="{{ route('verifikasi.store', $item) }}"
                                        method="POST"
                                    >

                                        @csrf

                                        {{-- Status verifikasi --}}
                                        <div class="mb-4">

                                            <label
                                                for="status_verifikasi_{{ $item->id }}"
                                                class="block text-sm font-medium text-gray-700 mb-1"
                                            >
                                                Hasil Verifikasi
                                            </label>

                                            <select
                                                name="status_verifikasi"
                                                id="status_verifikasi_{{ $item->id }}"
                                                required
                                                class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500"
                                            >

                                                <option value="">
                                                    Pilih hasil
                                                </option>

                                                <option value="valid">
                                                    Valid
                                                </option>

                                                <option value="kurang_akurat">
                                                    Kurang Akurat
                                                </option>

                                                <option value="tidak_valid">
                                                    Tidak Valid
                                                </option>

                                            </select>

                                        </div>

                                        {{-- Catatan --}}
                                        <div class="mb-4">

                                            <label
                                                for="catatan_verifikasi_{{ $item->id }}"
                                                class="block text-sm font-medium text-gray-700 mb-1"
                                            >
                                                Catatan
                                            </label>

                                            <textarea
                                                name="catatan_verifikasi"
                                                id="catatan_verifikasi_{{ $item->id }}"
                                                rows="3"
                                                placeholder="Tambahkan catatan jika diperlukan..."
                                                class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500"
                                            ></textarea>

                                        </div>

                                        {{-- Tombol --}}
                                        <div class="flex justify-end gap-2">

                                            <button
                                                type="submit"
                                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
                                            >
                                                Simpan Verifikasi
                                            </button>

                                        </div>

                                    </form>

                                </div>

                            </details>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="10"
                            class="px-5 py-12 text-center"
                        >

                            <div class="text-gray-400 mb-2">
                                Tidak ada data
                            </div>

                            <p class="text-gray-500 text-sm">
                                Semua data penimbangan sudah diverifikasi.
                            </p>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{-- Pagination --}}
    @if ($penimbangan->hasPages())

        <div class="px-5 py-4 border-t">
            {{ $penimbangan->links() }}
        </div>

    @endif

</div>

@endsection