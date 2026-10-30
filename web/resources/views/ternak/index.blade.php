
@extends('layouts.ternak')

@section('title', 'Data Ternak')

@section('page-title', 'Data Ternak')

@section('content')

<div class="space-y-6">

    {{-- HEADER HALAMAN --}}
    <div class="flex items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">
                Data Ternak
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Kelola data ternak yang terdaftar pada sistem
            </p>
        </div>

        <a href="{{ route('ternak.create') }}"
           class="inline-flex items-center gap-2 px-5 py-3
                  bg-[#164A3A] text-white text-sm font-medium
                  rounded-lg hover:bg-[#0f382c] transition shrink-0">

            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>

            Tambah Ternak
        </a>
    </div>

    {{-- ALERT SUKSES --}}
    @if(session('success'))
        <div class="p-4 bg-green-50 border border-green-200
                    text-green-700 rounded-xl text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- ALERT ERROR --}}
    @if(session('error'))
        <div class="flex items-center gap-3 p-4 bg-red-50
                    border border-red-200 text-red-700 rounded-xl">
            <span class="text-sm font-medium">
                {{ session('error') }}
            </span>
        </div>
    @endif

    {{-- VALIDATION ERROR --}}
    @if($errors->any())
        <div class="p-4 bg-red-50 border border-red-200
                    text-red-700 rounded-xl">
            <p class="font-semibold text-sm mb-2">
                Terdapat kesalahan:
            </p>

            <ul class="list-disc list-inside text-sm space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- CARD DATA TERNAK --}}
    <div class="bg-white rounded-xl border border-gray-200
                shadow-sm overflow-hidden">

        {{-- FILTER --}}
        <div class="p-5 border-b border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                {{-- PENCARIAN --}}
                <div>
                    <label for="searchTernak"
                           class="block text-sm font-medium
                                  text-gray-700 mb-2">
                        Cari Ternak
                    </label>

                    <div class="relative">
                        <svg class="absolute left-3 top-1/2
                                    -translate-y-1/2 w-5 h-5
                                    text-gray-400"
                             fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M21 21l-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z" />
                        </svg>

                        <input type="text"
                               id="searchTernak"
                               placeholder="Cari berdasarkan kode ternak..."
                               class="w-full pl-10 pr-4 py-2.5
                                      border border-gray-300 rounded-lg
                                      text-sm focus:ring-2
                                      focus:ring-[#164A3A]
                                      focus:border-[#164A3A]">
                    </div>
                </div>

                {{-- FILTER STATUS --}}
                <div>
                    <label for="filterStatus"
                           class="block text-sm font-medium
                                  text-gray-700 mb-2">
                        Status
                    </label>

                    <select id="filterStatus"
                            class="w-full px-4 py-2.5 border
                                   border-gray-300 rounded-lg
                                   text-sm focus:ring-2
                                   focus:ring-[#164A3A]
                                   focus:border-[#164A3A]">
                        <option value="">Semua Status</option>
                        <option value="tersedia">Tersedia</option>
                        <option value="dipesan">Dipesan</option>
                        <option value="terkirim">Terkirim</option>
                        <option value="disembelih">Disembelih</option>
                    </select>
                </div>

                {{-- FILTER LOKASI --}}
                <div>
                    <label for="filterLokasi"
                           class="block text-sm font-medium
                                  text-gray-700 mb-2">
                        Lokasi
                    </label>

                    <select id="filterLokasi"
                            class="w-full px-4 py-2.5 border
                                   border-gray-300 rounded-lg
                                   text-sm focus:ring-2
                                   focus:ring-[#164A3A]
                                   focus:border-[#164A3A]">
                        <option value="">Semua Lokasi</option>

                        @foreach($lokasi as $itemLokasi)
                            <option value="{{ strtolower($itemLokasi->nama) }}">
                                {{ $itemLokasi->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>
        </div>

        {{-- INFO JUMLAH DATA --}}
        <div class="px-5 py-4 border-b border-gray-200">
            <p class="text-sm text-gray-500">
                Menampilkan
                <span id="jumlahData"
                      class="font-semibold text-gray-700">
                    {{ $ternak->count() }}
                </span>
                data pada halaman ini
            </p>
        </div>

        {{-- TABEL DATA TERNAK --}}
        <div class="w-full overflow-hidden">

            <table class="w-full table-fixed text-xs text-left">

                {{-- PENGATURAN LEBAR KOLOM --}}
                <colgroup>
                    <col style="width: 4%">
                    <col style="width: 9%">
                    <col style="width: 8%">
                    <col style="width: 11%">
                    <col style="width: 6%">
                    <col style="width: 9%">
                    <col style="width: 7%">
                    <col style="width: 13%">
                    <col style="width: 13%">
                    <col style="width: 20%">
                </colgroup>

                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-2 py-3 text-center font-semibold text-gray-600">
                            No.
                        </th>

                        <th class="px-2 py-3 font-semibold text-gray-600">
                            KODE TERNAK
                        </th>

                        <th class="px-2 py-3 font-semibold text-gray-600">
                            JENIS
                        </th>

                        <th class="px-2 py-3 font-semibold text-gray-600">
                            LOKASI
                        </th>

                        <th class="px-2 py-3 font-semibold text-gray-600">
                            RFID
                        </th>

                        <th class="px-2 py-3 font-semibold text-gray-600">
                            BOBOT TERAKHIR
                        </th>

                        <th class="px-2 py-3 font-semibold text-gray-600">
                            STATUS
                        </th>

                        <th class="px-2 py-3 font-semibold text-gray-600">
                            DIBUAT (WIB)
                        </th>

                        <th class="px-2 py-3 font-semibold text-gray-600">
                            DIUBAH (WIB)
                        </th>

                        <th class="px-2 py-3 text-center font-semibold text-gray-600">
                            AKSI
                        </th>
                    </tr>
                </thead>

                <tbody id="ternakTableBody"
                       class="divide-y divide-gray-100">

                    @forelse($ternak as $item)

                        <tr class="ternak-row hover:bg-gray-50 transition"
                            data-kode="{{ strtolower($item->kode_ternak ?? '') }}"
                            data-status="{{ strtolower($item->status ?? '') }}"
                            data-lokasi="{{ strtolower($item->lokasi?->nama ?? '') }}">

                            {{-- NOMOR --}}
                            <td class="px-2 py-3 text-center text-gray-600">
                                {{ ($ternak->firstItem() ?? 1) + $loop->index }}
                            </td>

                            {{-- KODE TERNAK --}}
                            <td class="px-2 py-3 font-semibold text-gray-900 break-words">
                                {{ $item->kode_ternak ?? '-' }}
                            </td>

                            {{-- JENIS --}}
                            <td class="px-2 py-3 text-gray-800 break-words">
                                <div class="font-medium">
                                    {{ $item->jenisTernak?->nama_jenis ?? '-' }}
                                </div>

                                <div class="text-[11px] text-gray-400 mt-1">
                                    {{ $item->jenisTernak?->spesies ?? '-' }}
                                </div>
                            </td>

                            {{-- LOKASI --}}
                            <td class="px-2 py-3 text-gray-600 text-xs break-words">
                                @php
                                    $namaLokasi = $item->lokasi?->nama ?? '-';
                                    $bagianLokasi = preg_split('/\s+/', trim($namaLokasi), 2);
                                @endphp

                                <div>
                                    {{ $bagianLokasi[0] }}
                                </div>

                                @if(isset($bagianLokasi[1]))
                                    <div>
                                        {{ $bagianLokasi[1] }}
                                    </div>
                                @endif
                            </td>

                            {{-- RFID --}}
                            <td class="px-2 py-3 text-gray-600 break-words">
                                {{ $item->kode_rfid ?: '-' }}
                            </td>

                            {{-- BOBOT TERAKHIR --}}
                            <td class="px-2 py-3 text-gray-800">
                                @if($item->bobot_terakhir !== null)
                                    <span class="font-semibold">
                                        {{ number_format($item->bobot_terakhir, 1, ',', '.') }}
                                    </span>
                                    <span class="text-gray-500">kg</span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>

                            {{-- STATUS --}}
                            <td class="px-2 py-3">
                                @php
                                    $statusClass = match($item->status) {
                                        'tersedia' => 'bg-green-100 text-green-700',
                                        'dipesan' => 'bg-yellow-100 text-yellow-700',
                                        'terkirim' => 'bg-blue-100 text-blue-700',
                                        'disembelih' => 'bg-gray-100 text-gray-700',
                                        default => 'bg-gray-100 text-gray-700',
                                    };

                                    $statusLabel = match($item->status) {
                                        'tersedia' => 'Tersedia',
                                        'dipesan' => 'Dipesan',
                                        'terkirim' => 'Terkirim',
                                        'disembelih' => 'Disembelih',
                                        default => ucfirst($item->status ?? '-'),
                                    };
                                @endphp

                                <span class="inline-flex items-center
                                             px-2 py-1 rounded-full
                                             text-[11px] font-medium
                                             whitespace-nowrap
                                             {{ $statusClass }}">
                                    {{ $statusLabel }}
                                </span>
                            </td>

                            {{-- DITAMBAHKAN --}}
                            <td class="px-2 py-3 text-gray-700 text-xs">
                                @if($item->created_at)
                                    @php
                                        $waktuDitambahkan = $item->created_at
                                            ->copy()
                                            ->timezone('Asia/Jakarta');
                                    @endphp

                                    <div class="whitespace-nowrap">
                                        {{ $waktuDitambahkan->format('d/m/Y') }}
                                    </div>

                                    <div class="whitespace-nowrap mt-1">
                                        {{ $waktuDitambahkan->format('H.i.s') }} WIB
                                    </div>
                                @else
                                    -
                                @endif
                            </td>

                            {{-- TERAKHIR DIUBAH --}}
                            <td class="px-2 py-3 text-gray-700 text-xs">
                                @if($item->updated_at)
                                    @php
                                        $waktuDiubah = $item->updated_at
                                            ->copy()
                                            ->timezone('Asia/Jakarta');
                                    @endphp

                                    <div class="whitespace-nowrap">
                                        {{ $waktuDiubah->format('d/m/Y') }}
                                    </div>

                                    <div class="whitespace-nowrap mt-1">
                                        {{ $waktuDiubah->format('H.i.s') }} WIB
                                    </div>
                                @else
                                    -
                                @endif
                            </td>

                            {{-- AKSI --}}
                            <td class="px-2 py-3">
                                <div class="flex items-center justify-center gap-1">

                                    {{-- DETAIL --}}
                                    <a href="{{ route('ternak.show', $item) }}"
                                       class="px-2 py-1.5 text-[11px]
                                              font-medium text-gray-700
                                              bg-gray-100 rounded-md
                                              hover:bg-gray-200 whitespace-nowrap">
                                        Detail
                                    </a>

                                    {{-- EDIT --}}
                                    <a href="{{ route('ternak.edit', $item) }}"
                                       class="px-2 py-1.5 text-[11px]
                                              font-medium text-white
                                              bg-[#164A3A] rounded-md
                                              hover:bg-[#0f382c] whitespace-nowrap">
                                        Edit
                                    </a>

                                    {{-- HAPUS --}}
                                    <button type="button"
                                            onclick="openDeleteModal(
                                                {{ $item->id }},
                                                @js($item->kode_ternak)
                                            )"
                                            class="px-2 py-1.5 text-[11px]
                                                   font-medium text-red-600
                                                   bg-red-50 rounded-md
                                                   hover:bg-red-100 whitespace-nowrap">
                                        Hapus
                                    </button>

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="10"
                                class="px-5 py-12 text-center">

                                <div class="flex flex-col items-center">
                                    <div class="w-14 h-14 rounded-full
                                                bg-gray-100 flex items-center
                                                justify-center mb-4">
                                        <svg class="w-7 h-7 text-gray-400"
                                             fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M12 6v6l4 2" />
                                        </svg>
                                    </div>

                                    <h3 class="font-semibold text-gray-800">
                                        Belum ada data ternak
                                    </h3>

                                    <p class="text-sm text-gray-500 mt-1">
                                        Silakan tambahkan data ternak terlebih dahulu.
                                    </p>
                                </div>

                            </td>
                        </tr>

                    @endforelse

                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if($ternak->hasPages())
            <div class="px-5 py-4 border-t border-gray-200">
                {{ $ternak->links() }}
            </div>
        @endif

    </div>
</div>

{{-- MODAL KONFIRMASI HAPUS --}}
<div id="deleteModal"
     class="hidden fixed inset-0 z-[100] items-center justify-center
            bg-black/50 backdrop-blur-sm px-4">

    <div class="w-full max-w-md bg-white rounded-2xl
                shadow-2xl overflow-hidden">

        {{-- ICON --}}
        <div class="flex justify-center pt-7">
            <div class="w-16 h-16 rounded-full bg-red-100
                        flex items-center justify-center">
                <svg class="w-8 h-8 text-red-600"
                     fill="none" stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 9v4m0 4h.01M10.29 3.86l-7.82 13.5A2 2 0 004.2 20h15.6a2 2 0 001.73-2.64l-7.82-13.5a2 2 0 00-3.42 0z" />
                </svg>
            </div>
        </div>

        {{-- TEKS --}}
        <div class="px-7 pt-5 text-center">
            <h3 class="text-xl font-bold text-gray-900">
                Hapus Data Ternak?
            </h3>

            <p class="mt-3 text-sm text-gray-500 leading-relaxed">
                Apakah kamu yakin ingin menghapus data ternak
                <span id="deleteKode" class="font-semibold text-gray-800"></span>?
            </p>

            <p class="mt-2 text-xs text-gray-400">
                Data yang sudah dihapus tidak dapat dikembalikan.
            </p>
        </div>

        {{-- TOMBOL --}}
        <div class="flex gap-3 px-7 py-6">

            <button type="button"
                    onclick="closeDeleteModal()"
                    class="flex-1 px-4 py-2.5 rounded-lg
                           border border-gray-300 text-gray-700
                           text-sm font-medium hover:bg-gray-50 transition">
                Batal
            </button>

            <form id="deleteForm" method="POST" class="flex-1">
                @csrf
                @method('DELETE')

                <button type="submit"
                        class="w-full px-4 py-2.5 rounded-lg
                               bg-red-600 text-white text-sm font-medium
                               hover:bg-red-700 transition">
                    Ya, Hapus
                </button>
            </form>

        </div>
    </div>
</div>

{{-- JAVASCRIPT --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {

        /*
        |--------------------------------------------------------------------------
        | MODAL HAPUS
        |--------------------------------------------------------------------------
        */

        const modal = document.getElementById('deleteModal');
        const kodeText = document.getElementById('deleteKode');
        const deleteForm = document.getElementById('deleteForm');

        window.openDeleteModal = function (id, kode) {
            kodeText.textContent = kode;
            deleteForm.action = "{{ url('/ternak') }}/" + id;

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        };

        window.closeDeleteModal = function () {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        };

        modal.addEventListener('click', function (event) {
            if (event.target === modal) {
                window.closeDeleteModal();
            }
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                window.closeDeleteModal();
            }
        });

        /*
        |--------------------------------------------------------------------------
        | PENCARIAN DAN FILTER TABEL
        |--------------------------------------------------------------------------
        */

        const searchInput = document.getElementById('searchTernak');
        const filterStatus = document.getElementById('filterStatus');
        const filterLokasi = document.getElementById('filterLokasi');
        const jumlahData = document.getElementById('jumlahData');

        function filterTernak() {
            const search = searchInput.value.toLowerCase().trim();
            const status = filterStatus.value.toLowerCase();
            const lokasi = filterLokasi.value.toLowerCase();

            const rows = document.querySelectorAll('.ternak-row');
            let jumlah = 0;

            rows.forEach(function (row) {
                const kode = row.dataset.kode || '';
                const rowStatus = row.dataset.status || '';
                const rowLokasi = row.dataset.lokasi || '';

                const cocokSearch = kode.includes(search);
                const cocokStatus = status === '' || rowStatus === status;
                const cocokLokasi = lokasi === '' || rowLokasi === lokasi;

                const tampil = cocokSearch && cocokStatus && cocokLokasi;

                row.style.display = tampil ? '' : 'none';

                if (tampil) {
                    jumlah++;
                }
            });

            jumlahData.textContent = jumlah;
        }

        searchInput.addEventListener('input', filterTernak);
        filterStatus.addEventListener('change', filterTernak);
        filterLokasi.addEventListener('change', filterTernak);

    });
</script>

@endsection
