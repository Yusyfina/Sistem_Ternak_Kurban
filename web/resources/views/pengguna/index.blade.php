@extends('layouts.ternak')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">
        Data Pengguna
    </h1>

    <p class="text-gray-500 mt-1">
        Kelola pengguna, role, lokasi, dan status akun sistem.
    </p>
</div>

{{-- Pesan sukses --}}
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
                Daftar Pengguna
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Total: {{ $pengguna->total() }} pengguna
            </p>
        </div>

        <a
            href="{{ route('pengguna.create') }}"
            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
        >
            + Tambah Pengguna
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
                        Kode
                    </th>

                    <th class="px-5 py-3 text-left">
                        Nama
                    </th>

                    <th class="px-5 py-3 text-left">
                        Email
                    </th>

                    <th class="px-5 py-3 text-left">
                        Role
                    </th>

                    <th class="px-5 py-3 text-left">
                        Lokasi
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

                @forelse ($pengguna as $item)

                    <tr class="border-b hover:bg-gray-50">

                        {{-- No --}}
                        <td class="px-5 py-4">
                            {{ $pengguna->firstItem() + $loop->index }}
                        </td>

                        {{-- Kode --}}
                        <td class="px-5 py-4 font-medium text-gray-800">
                            {{ $item->kode ?? '-' }}
                        </td>

                        {{-- Nama --}}
                        <td class="px-5 py-4">
                            {{ $item->name }}
                        </td>

                        {{-- Email --}}
                        <td class="px-5 py-4">
                            {{ $item->email }}
                        </td>

                        {{-- Role --}}
                        <td class="px-5 py-4">

                            @switch($item->role)

                                @case('super_admin')
                                    <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-700">
                                        Super Admin
                                    </span>
                                    @break

                                @case('admin_pusat')
                                    <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                                        Admin Pusat
                                    </span>
                                    @break

                                @case('admin_lokasi')
                                    <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-700">
                                        Admin Lokasi
                                    </span>
                                    @break

                                @case('operator')
                                    <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                        Operator
                                    </span>
                                    @break

                                @case('mandor')
                                    <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">
                                        Mandor
                                    </span>
                                    @break

                                @default
                                    <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                        {{ $item->role }}
                                    </span>

                            @endswitch

                        </td>

                        {{-- Lokasi --}}
                        <td class="px-5 py-4">
                            {{ $item->lokasi->nama ?? 'Pusat' }}
                        </td>

                        {{-- Status --}}
                        <td class="px-5 py-4">

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

                        {{-- Aksi --}}
                        <td class="px-5 py-4">

                            <a
                                href="{{ route('pengguna.edit', $item) }}"
                                class="text-blue-600 hover:text-blue-800 font-medium"
                            >
                                Edit
                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="8"
                            class="px-5 py-12 text-center text-gray-500"
                        >
                            Belum ada data pengguna.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{-- Pagination --}}
    @if ($pengguna->hasPages())

        <div class="px-5 py-4 border-t">
            {{ $pengguna->links() }}
        </div>

    @endif

</div>

@endsection