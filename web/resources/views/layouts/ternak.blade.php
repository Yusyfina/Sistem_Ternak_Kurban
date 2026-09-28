<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @yield('title', config('app.name', 'Sistem Ternak Kurban'))
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body class="bg-[#F5F7F5] text-gray-800">

<div class="min-h-screen">


    {{-- ========================================================= --}}
    {{-- SIDEBAR --}}
    {{-- ========================================================= --}}

    <aside class="fixed inset-y-0 left-0 z-40 w-64 bg-[#164A3A] text-white shadow-xl flex flex-col">


        {{-- ===================================================== --}}
        {{-- LOGO --}}
        {{-- ===================================================== --}}

        <div class="h-20 shrink-0 flex items-center px-6 border-b border-white/10">

            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6 text-white"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 3c-4.5 0-8 3-8 7.5C4 15 7.5 20 12 21c4.5-1 8-6 8-10.5C20 6 16.5 3 12 3Z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M8.5 11.5c1.2.8 2.3 1.2 3.5 1.2s2.3-.4 3.5-1.2"
                        />
                    </svg>

                </div>


                <div>

                    <div class="text-lg font-bold tracking-wide">
                        SITERNAK
                    </div>

                    <div class="text-[10px] text-white/60 uppercase tracking-wider">
                        Sistem Ternak Kurban
                    </div>

                </div>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- MENU --}}
        {{-- ===================================================== --}}

        <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-1.5">


            {{-- DASHBOARD --}}
            <a
                href="{{ route('dashboard') }}"
                class="
                    flex items-center gap-3
                    px-4 py-3
                    rounded-xl
                    text-sm font-medium
                    transition-all duration-200

                    {{ request()->routeIs('dashboard')
                        ? 'bg-white text-[#164A3A] shadow-sm'
                        : 'text-white/75 hover:bg-white/10 hover:text-white'
                    }}
                "
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 shrink-0"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3 13h8V3H3v10Zm10 8h8V11h-8v10ZM3 21h8v-6H3v6Zm10-18v5h8V3h-8Z"
                    />
                </svg>

                <span>Dashboard</span>

            </a>


            {{-- TERNAK --}}
            <a
                href="{{ route('ternak.index') }}"
                class="
                    flex items-center gap-3
                    px-4 py-3
                    rounded-xl
                    text-sm font-medium
                    transition-all duration-200

                    {{ request()->routeIs('ternak.*')
                        ? 'bg-white text-[#164A3A] shadow-sm'
                        : 'text-white/75 hover:bg-white/10 hover:text-white'
                    }}
                "
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 shrink-0"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M7 7V5a2 2 0 0 1 2-2h1v4m7 0V5a2 2 0 0 0-2-2h-1v4M5 9h14l-1 8a3 3 0 0 1-3 3H9a3 3 0 0 1-3-3L5 9Z"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M8 13h.01M16 13h.01"
                    />
                </svg>

                <span>Data Ternak</span>

            </a>


            {{-- PENIMBANGAN --}}
            <a
                href="{{ route('penimbangan.index') }}"
                class="
                    flex items-center gap-3
                    px-4 py-3
                    rounded-xl
                    text-sm font-medium
                    transition-all duration-200

                    {{ request()->routeIs('penimbangan.index')
                        ? 'bg-white text-[#164A3A] shadow-sm'
                        : 'text-white/75 hover:bg-white/10 hover:text-white'
                    }}
                "
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 shrink-0"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 3v18M7 6h10M6 21h12M8 6l-3 6h6L8 6Zm8 0-3 6h6l-3-6Z"
                    />
                </svg>

                <span>Penimbangan</span>

            </a>


            {{-- RIWAYAT --}}
            <a
                href="{{ route('penimbangan.riwayat') }}"
                class="
                    flex items-center gap-3
                    px-4 py-3
                    rounded-xl
                    text-sm font-medium
                    transition-all duration-200

                    {{ request()->routeIs('penimbangan.riwayat')
                        ? 'bg-white text-[#164A3A] shadow-sm'
                        : 'text-white/75 hover:bg-white/10 hover:text-white'
                    }}
                "
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 shrink-0"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 8v4l2.5 2.5"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                    />
                </svg>

                <span>Riwayat Penimbangan</span>

            </a>


            {{-- VERIFIKASI --}}
            <a
                href="{{ route('verifikasi.index') }}"
                class="
                    flex items-center gap-3
                    px-4 py-3
                    rounded-xl
                    text-sm font-medium
                    transition-all duration-200

                    {{ request()->routeIs('verifikasi.*')
                        ? 'bg-white text-[#164A3A] shadow-sm'
                        : 'text-white/75 hover:bg-white/10 hover:text-white'
                    }}
                "
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 shrink-0"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m9 12 2 2 4-4"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 3 5 6v5c0 4.5 3 8.5 7 10 4-1.5 7-5.5 7-10V6l-7-3Z"
                    />
                </svg>

                <span>Verifikasi</span>

            </a>


            {{-- PEMBELI --}}
            <a
                href="{{ route('pembeli.index') }}"
                class="
                    flex items-center gap-3
                    px-4 py-3
                    rounded-xl
                    text-sm font-medium
                    transition-all duration-200

                    {{ request()->routeIs('pembeli.*')
                        ? 'bg-white text-[#164A3A] shadow-sm'
                        : 'text-white/75 hover:bg-white/10 hover:text-white'
                    }}
                "
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 shrink-0"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"
                    />

                    <circle
                        cx="8.5"
                        cy="7"
                        r="4"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M17 11a4 4 0 1 0 0-8"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M22 21v-2a4 4 0 0 0-3-3.87"
                    />
                </svg>

                <span>Pembeli</span>

            </a>


            {{-- PESANAN --}}
            <a
                href="{{ route('pesanan.index') }}"
                class="
                    flex items-center gap-3
                    px-4 py-3
                    rounded-xl
                    text-sm font-medium
                    transition-all duration-200

                    {{ request()->routeIs('pesanan.*')
                        ? 'bg-white text-[#164A3A] shadow-sm'
                        : 'text-white/75 hover:bg-white/10 hover:text-white'
                    }}
                "
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 shrink-0"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3 4h18l-2 12H5L3 4Z"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3 4 2 2M7 20a1 1 0 1 0 0-2 1 1 0 0 0 0 2Zm10 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"
                    />
                </svg>

                <span>Pesanan</span>

            </a>


            {{-- ================================================= --}}
            {{-- MANAJEMEN SISTEM --}}
            {{-- ================================================= --}}

            @if(in_array(auth()->user()->role, ['super_admin', 'admin_pusat']))

                <div class="pt-7 pb-3 px-4">

                    <p class="text-[10px] font-semibold uppercase tracking-widest text-white/40">
                        Manajemen Sistem
                    </p>

                </div>


                {{-- LOKASI --}}
                <a
                    href="{{ route('lokasi.index') }}"
                    class="
                        flex items-center gap-3
                        px-4 py-3
                        rounded-xl
                        text-sm font-medium
                        transition-all duration-200

                        {{ request()->routeIs('lokasi.*')
                            ? 'bg-white text-[#164A3A] shadow-sm'
                            : 'text-white/75 hover:bg-white/10 hover:text-white'
                        }}
                    "
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 shrink-0"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 21s7-6.1 7-12a7 7 0 1 0-14 0c0 5.9 7 12 7 12Z"
                        />

                        <circle
                            cx="12"
                            cy="9"
                            r="2.5"
                        />
                    </svg>

                    <span>Lokasi Peternakan</span>

                </a>


                {{-- PENGGUNA --}}
                <a
                    href="{{ route('pengguna.index') }}"
                    class="
                        flex items-center gap-3
                        px-4 py-3
                        rounded-xl
                        text-sm font-medium
                        transition-all duration-200

                        {{ request()->routeIs('pengguna.*')
                            ? 'bg-white text-[#164A3A] shadow-sm'
                            : 'text-white/75 hover:bg-white/10 hover:text-white'
                        }}
                    "
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 shrink-0"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"
                        />

                        <circle
                            cx="9"
                            cy="7"
                            r="4"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19 8v6M22 11h-6"
                        />
                    </svg>

                    <span>Pengguna</span>

                </a>


                {{-- PENGATURAN --}}
                <a
                    href="{{ route('pengaturan.index') }}"
                    class="
                        flex items-center gap-3
                        px-4 py-3
                        rounded-xl
                        text-sm font-medium
                        transition-all duration-200

                        {{ request()->routeIs('pengaturan.*')
                            ? 'bg-white text-[#164A3A] shadow-sm'
                            : 'text-white/75 hover:bg-white/10 hover:text-white'
                        }}
                    "
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 shrink-0"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 15.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19.4 15a1.8 1.8 0 0 0 .36 1.98l.06.06-1.8 1.8-.06-.06a1.8 1.8 0 0 0-1.98-.36 1.8 1.8 0 0 0-1.1 1.65V22h-2.55v-.09a1.8 1.8 0 0 0-1.1-1.65 1.8 1.8 0 0 0-1.98.36l-.06.06-1.8-1.8.06-.06A1.8 1.8 0 0 0 7.9 15a1.8 1.8 0 0 0-1.65-1.1H6.16v-2.55h.09A1.8 1.8 0 0 0 7.9 10a1.8 1.8 0 0 0-.36-1.98l-.06-.06 1.8-1.8.06.06a1.8 1.8 0 0 0 1.98.36 1.8 1.8 0 0 0 1.1-1.65V4h2.55v.09a1.8 1.8 0 0 0 1.1 1.65 1.8 1.8 0 0 0 1.98-.36l.06-.06 1.8 1.8-.06.06A1.8 1.8 0 0 0 19.4 15Z"
                        />
                    </svg>

                    <span>Pengaturan</span>

                </a>

            @endif

        </nav>


        {{-- ===================================================== --}}
        {{-- PROFILE SIDEBAR --}}
        {{-- ===================================================== --}}

        <div class="shrink-0 px-4 pb-5 pt-3">

            {{-- GARIS PEMISAH --}}
            <div class="border-t border-white/10 mb-4"></div>


            <div class="flex items-center gap-3 px-3">

                {{-- AVATAR --}}
                <div
                    class="
                        w-10 h-10
                        shrink-0
                        rounded-full
                        bg-white/15
                        flex items-center justify-center
                        font-semibold
                        text-white
                    "
                >
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>


                {{-- USER --}}
                <div class="min-w-0">

                    <p class="text-sm font-semibold text-white truncate">
                        {{ auth()->user()->name }}
                    </p>

                    <p class="text-xs text-white/50 truncate">
                        {{ ucwords(str_replace('_', ' ', auth()->user()->role)) }}
                    </p>

                </div>

            </div>

        </div>

    </aside>


    {{-- ========================================================= --}}
    {{-- AREA KANAN --}}
    {{-- ========================================================= --}}

    <div class="ml-64 min-h-screen">


        {{-- HEADER --}}
        <header
            class="
                h-20
                bg-white
                border-b border-gray-200
                flex items-center justify-between
                px-8
                sticky top-0 z-30
            "
        >

            {{-- TITLE --}}
            <div>

                <p class="text-xs text-gray-400 mb-1">
                    Sistem Ternak Kurban
                </p>

                <h1 class="text-xl font-bold text-[#164A3A]">
                    @yield('page-title', 'Dashboard')
                </h1>

            </div>


            {{-- USER --}}
            <div class="flex items-center gap-4">


                {{-- NOTIFICATION --}}
                <button
                    type="button"
                    class="
                        relative
                        w-10 h-10
                        rounded-xl
                        border border-gray-200
                        flex items-center justify-center
                        text-gray-500
                        hover:bg-gray-50
                        transition
                    "
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 17h5l-1.5-2.5V10a6.5 6.5 0 0 0-13 0v4.5L4 17h5m6 0a3 3 0 0 1-6 0"
                        />
                    </svg>

                </button>


                {{-- PROFILE HEADER --}}
                <div class="flex items-center gap-3 pl-3 border-l border-gray-200">

                    <div
                        class="
                            w-10 h-10
                            rounded-full
                            bg-[#DCEBE4]
                            text-[#164A3A]
                            flex items-center justify-center
                            font-bold
                        "
                    >
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>


                    <div class="hidden md:block">

                        <p class="text-sm font-semibold text-gray-800">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="text-xs text-gray-400">
                            {{ ucwords(str_replace('_', ' ', auth()->user()->role)) }}
                        </p>

                    </div>


                    {{-- LOGOUT --}}
                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                        class="ml-2"
                    >

                        @csrf

                        <button
                            type="submit"
                            title="Logout"
                            class="
                                w-9 h-9
                                rounded-lg
                                text-gray-400
                                hover:bg-red-50
                                hover:text-red-500
                                transition
                            "
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 mx-auto"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M10 17l5-5-5-5M15 12H3"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M14 4h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-4"
                                />
                            </svg>

                        </button>

                    </form>

                </div>

            </div>

        </header>


        {{-- ========================================================= --}}
        {{-- CONTENT --}}
        {{-- ========================================================= --}}

        <main class="p-8">


            {{-- SUCCESS --}}
            @if(session('success'))

                <div
                    class="
                        mb-6
                        rounded-xl
                        border border-green-200
                        bg-green-50
                        px-4 py-3
                        text-sm text-green-700
                    "
                >

                    <div class="flex items-center gap-2">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m5 12 4 4L19 6"
                            />
                        </svg>

                        <span>
                            {{ session('success') }}
                        </span>

                    </div>

                </div>

            @endif


            {{-- ERROR --}}
            @if($errors->any())

                <div
                    class="
                        mb-6
                        rounded-xl
                        border border-red-200
                        bg-red-50
                        px-4 py-3
                        text-sm text-red-700
                    "
                >

                    <p class="font-semibold mb-1">
                        Terdapat kesalahan:
                    </p>

                    <ul class="list-disc list-inside space-y-1">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            @yield('content')

        </main>

    </div>

</div>

</body>

</html>