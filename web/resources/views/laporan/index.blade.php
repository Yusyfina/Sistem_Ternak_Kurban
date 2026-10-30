@extends('layouts.ternak')

@section('title', 'Laporan')
@section('page-title', 'Laporan')

@section('content')
<div class="space-y-6">

    <div>
        <h2 class="text-2xl font-bold text-gray-900">Pusat Laporan</h2>
        <p class="mt-1 text-sm text-gray-500">
            Unduh data dalam format Excel, CSV, PDF, atau Word sesuai hak akses Anda.
        </p>
    </div>

    @php
        $namaFormat = ['xlsx' => 'Excel', 'csv' => 'CSV', 'pdf' => 'PDF', 'docx' => 'Word'];
    @endphp

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
        @foreach ($daftar as $kode => $m)
            <form method="GET" class="bg-white border border-gray-200 rounded-2xl p-6 space-y-4">

                <div>
                    <h3 class="text-lg font-semibold text-gray-900">{{ $m['label'] }}</h3>
                    <p class="text-sm text-gray-500">{{ $m['info'] }}</p>
                </div>

                @if (count($m['filter']))
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm">

                        @if (in_array('periode', $m['filter'], true))
                            <label class="block">
                                <span class="text-gray-600">Dari tanggal</span>
                                <input type="date" name="dari"
                                       class="mt-1 w-full rounded-lg border-gray-300">
                            </label>
                            <label class="block">
                                <span class="text-gray-600">Sampai tanggal</span>
                                <input type="date" name="sampai"
                                       class="mt-1 w-full rounded-lg border-gray-300">
                            </label>
                        @endif

                        @if (in_array('lokasi', $m['filter'], true) && $lokasi->isNotEmpty())
                            <label class="block">
                                <span class="text-gray-600">Lokasi</span>
                                <select name="lokasi_id"
                                        class="mt-1 w-full rounded-lg border-gray-300">
                                    <option value="">Semua lokasi</option>
                                    @foreach ($lokasi as $l)
                                        <option value="{{ $l->id }}">{{ $l->nama }}</option>
                                    @endforeach
                                </select>
                            </label>
                        @endif

                        @if (in_array('status', $m['filter'], true))
                            <label class="block">
                                <span class="text-gray-600">Status</span>
                                <select name="{{ $m['status']['field'] }}"
                                        class="mt-1 w-full rounded-lg border-gray-300">
                                    <option value="">Semua status</option>
                                    @foreach ($m['status']['opsi'] as $nilai => $label)
                                        <option value="{{ $nilai }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </label>
                        @endif

                    </div>
                @endif

                <div class="flex flex-wrap gap-2 pt-1">
                    @foreach ($namaFormat as $f => $nama)
                        <button type="submit"
                                formaction="{{ route('laporan.export', ['modul' => $kode, 'format' => $f]) }}"
                                class="px-4 py-2 rounded-lg bg-[#164A3A] text-white text-sm
                                       font-medium hover:bg-[#0f382c] transition">
                            {{ $nama }}
                        </button>
                    @endforeach
                </div>

            </form>
        @endforeach
    </div>
</div>
@endsection