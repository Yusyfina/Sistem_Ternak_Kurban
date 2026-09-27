<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Sistem Ternak Kurban') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-800">

<div class="min-h-screen flex">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-white border-r border-gray-200 fixed inset-y-0 left-0">

        {{-- LOGO --}}
        <div class="h-20 flex items-center px-6 border-b border-gray-200">
            <div class="text-xl font-bold">
                SITERNAK
            </div>
        </div>

        {{-- MENU --}}
        <nav class="p-4 space-y-1">

            <a href="{{ route('dashboard') }}"
               class="flex items-center px-4 py-3 rounded-lg
                      hover:bg-gray-100 transition">
                <span>Dashboard</span>
            </a>

            <a href="{{ route('ternak.index') }}"
               class="flex items-center px-4 py-3 rounded-lg
                      hover:bg-gray-100 transition">
                <span>Ternak</span>
            </a>

            <a href="{{ route('penimbangan.index') }}"
               class="flex items-center px-4 py-3 rounded-lg
                      hover:bg-gray-100 transition">
                <span>Penimbangan</span>
            </a>

            <a href="{{ route('penimbangan.riwayat') }}"
               class="flex items-center px-4 py-3 rounded-lg
                      hover:bg-gray-100 transition">
                <span>Riwayat Penimbangan</span>
            </a>

            <a href="{{ route('verifikasi.index') }}"
               class="flex items-center px-4 py-3 rounded-lg
                      hover:bg-gray-100 transition">
                <span>Verifikasi</span>
            </a>

            <a href="{{ route('pembeli.index') }}"
               class="flex items-center px-4 py-3 rounded-lg
                      hover:bg-gray-100 transition">
                <span>Pembeli</span>
            </a>

            <a href="{{ route('pesanan.index') }}"
               class="flex items-center px-4 py-3 rounded-lg
                      hover:bg-gray-100 transition">
                <span>Pesanan</span>
            </a>

            @if(in_array(auth()->user()->role, ['super_admin', 'admin_pusat']))

                <a href="{{ route('lokasi.index') }}"
                   class="flex items-center px-4 py-3 rounded-lg
                          hover:bg-gray-100 transition">
                    <span>Lokasi</span>
                </a>

                <a href="{{ route('pengguna.index') }}"
                   class="flex items-center px-4 py-3 rounded-lg
                          hover:bg-gray-100 transition">
                    <span>Pengguna</span>
                </a>

                <a href="{{ route('pengaturan.index') }}"
                   class="flex items-center px-4 py-3 rounded-lg
                          hover:bg-gray-100 transition">
                    <span>Pengaturan</span>
                </a>

            @endif

        </nav>

    </aside>


    {{-- AREA KANAN --}}
    <div class="ml-64 flex-1">

        {{-- HEADER --}}
        <header class="h-20 bg-white border-b border-gray-200
                       flex items-center justify-between px-8">

            <div>
                <h1 class="text-xl font-semibold">
                    Sistem Ternak Kurban
                </h1>
            </div>

            <div class="flex items-center gap-4">

                <div class="text-right">
                    <div class="font-medium">
                        {{ auth()->user()->name }}
                    </div>

                    <div class="text-sm text-gray-500">
                        {{ auth()->user()->role }}
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="text-sm text-red-600 hover:text-red-800">
                        Logout
                    </button>
                </form>

            </div>

        </header>


        {{-- CONTENT --}}
        <main class="p-8">

            @yield('content')

        </main>

    </div>

</div>

</body>
</html>