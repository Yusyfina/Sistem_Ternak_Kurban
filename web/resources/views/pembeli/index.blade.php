@extends('layouts.ternak')

@section('content')

<div class="mb-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Data Pembeli
            </h1>

            <p class="text-gray-500 mt-1">
                Kelola data pembeli yang terdaftar dalam sistem.
            </p>
        </div>

        <a
            href="{{ route('pembeli.create') }}"
            class="inline-flex items-center justify-center gap-2 px-5 py-2.5
                   bg-green-700 text-white text-sm font-medium rounded-lg
                   hover:bg-green-800 transition"
        >
            <span class="text-lg leading-none">+</span>
            Tambah Pembeli
        </a>

    </div>
</div>


{{-- NOTIFIKASI BERHASIL --}}
@if (session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl">
        <p class="text-sm font-medium text-green-700">
            {{ session('success') }}
        </p>
    </div>
@endif


{{-- NOTIFIKASI ERROR --}}
@if (session('error'))
    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
        <p class="text-sm font-medium text-red-700">
            {{ session('error') }}
        </p>
    </div>
@endif


{{-- CARD UTAMA --}}
<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">

    {{-- HEADER --}}
    <div class="px-6 py-5 border-b border-gray-200">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">

            <div>
                <h2 class="text-lg font-semibold text-gray-800">
                    Daftar Pembeli
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Total {{ $pembeli->total() }} pembeli terdaftar.
                </p>
            </div>

        </div>

    </div>


    {{-- TABEL --}}
    <div class="overflow-x-auto">

        <table class="w-full text-sm">

            <thead class="bg-gray-50 border-b border-gray-200">

                <tr>

                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">
                        No
                    </th>

                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">
                        Nama Pembeli
                    </th>

                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">
                        No. Telepon
                    </th>

                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">
                        Alamat
                    </th>

                    <th class="px-6 py-3.5 text-center text-xs font-semibold text-gray-500 uppercase tracking-wide">
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody class="divide-y divide-gray-100">

                @forelse ($pembeli as $item)

                    <tr class="hover:bg-gray-50 transition">

                        {{-- NOMOR --}}
                        <td class="px-6 py-4 text-gray-500">
                            {{ $pembeli->firstItem() + $loop->index }}
                        </td>


                        {{-- NAMA --}}
                        <td class="px-6 py-4">

                            <div class="flex items-center gap-3">

                                <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center">
                                    <span class="text-sm font-semibold text-green-700">
                                        {{ strtoupper(substr($item->nama, 0, 1)) }}
                                    </span>
                                </div>

                                <div>
                                    <p class="font-semibold text-gray-800">
                                        {{ $item->nama }}
                                    </p>

                                    <p class="text-xs text-gray-400 mt-0.5">
                                        Pembeli
                                    </p>
                                </div>

                            </div>

                        </td>


                        {{-- TELEPON --}}
                        <td class="px-6 py-4">

                            @if ($item->telepon)

                                <span class="text-gray-700">
                                    {{ $item->telepon }}
                                </span>

                            @else

                                <span class="text-gray-400">
                                    -
                                </span>

                            @endif

                        </td>


                        {{-- ALAMAT --}}
                        <td class="px-6 py-4 max-w-xs">

                            @if ($item->alamat)

                                <p class="text-gray-700 truncate" title="{{ $item->alamat }}">
                                    {{ $item->alamat }}
                                </p>

                            @else

                                <span class="text-gray-400">
                                    -
                                </span>

                            @endif

                        </td>


                        {{-- AKSI --}}
                        <td class="px-6 py-4">

                            <div class="flex items-center justify-center gap-2">

                                {{-- DETAIL --}}
                                <a
                                    href="{{ route('pembeli.show', $item) }}"
                                    class="px-3 py-1.5 text-xs font-medium
                                           text-gray-700 bg-gray-100 rounded-lg
                                           hover:bg-gray-200 transition"
                                >
                                    Detail
                                </a>


                                {{-- EDIT --}}
                                <a
                                    href="{{ route('pembeli.edit', $item) }}"
                                    class="px-3 py-1.5 text-xs font-medium
                                           text-blue-700 bg-blue-50 rounded-lg
                                           hover:bg-blue-100 transition"
                                >
                                    Edit
                                </a>


                                {{-- HAPUS --}}
                                <form
                                    action="{{ route('pembeli.destroy', $item) }}"
                                    method="POST"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        onclick="return confirm('Yakin ingin menghapus data pembeli {{ $item->nama }}?')"
                                        class="px-3 py-1.5 text-xs font-medium
                                               text-red-700 bg-red-50 rounded-lg
                                               hover:bg-red-100 transition"
                                    >
                                        Hapus
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="5"
                            class="px-6 py-14 text-center"
                        >

                            <div class="flex flex-col items-center">

                                <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center mb-4">

                                    <svg
                                        class="w-7 h-7 text-gray-400"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                                        />
                                    </svg>

                                </div>

                                <h3 class="text-sm font-semibold text-gray-800">
                                    Belum ada data pembeli
                                </h3>

                                <p class="text-sm text-gray-500 mt-1">
                                    Tambahkan pembeli baru untuk mulai menggunakan data pembeli.
                                </p>

                                <a
                                    href="{{ route('pembeli.create') }}"
                                    class="mt-4 text-sm font-medium text-green-700 hover:text-green-800"
                                >
                                    + Tambah Pembeli
                                </a>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- PAGINATION --}}
    @if ($pembeli->hasPages())

        <div class="px-6 py-4 border-t border-gray-200">
            {{ $pembeli->links() }}
        </div>

    @endif

</div>

@endsection