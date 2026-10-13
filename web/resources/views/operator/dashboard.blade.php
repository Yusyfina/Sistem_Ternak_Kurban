
@extends('layouts.ternak')

@section('title', 'Dashboard Operator Lapangan')

@push('styles')
    <link rel="stylesheet"
          href="{{ asset('css/operator-dashboard.css') }}">
@endpush

@section('content')
<div class="operator-dashboard">

    {{-- Header --}}
    <div class="operator-header">
        <div>
            <h1>Dashboard Operator</h1>
            <p>
                Lokasi:
                {{ $user->lokasi->nama ?? 'Lokasi belum ditentukan' }}
            </p>
        </div>

        <div class="operator-account">
            <span>Lihat sebagai</span>
            <span class="account-label">
                {{ $user->name }} (Operator Lapangan)
            </span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">
                    Keluar
                </button>
            </form>
        </div>
    </div>

    {{-- Tombol aksi --}}
    <div class="operator-action">
        <a href="{{ route('penimbangan.create') }}"
           class="btn-input">
            + Input Penimbangan
        </a>
    </div>

    {{-- Statistik --}}
    <div class="operator-stats">
        <div class="stat-card">
            <p>Total Penimbangan</p>
            <h2>{{ $totalPenimbangan }}</h2>
            <span>Seluruh data di lokasi tugas</span>
        </div>

        <div class="stat-card stat-waiting">
            <p>Menunggu Verifikasi</p>
            <h2>{{ $menunggu }}</h2>
            <span>Perlu diperiksa</span>
        </div>

        <div class="stat-card stat-valid">
            <p>Valid</p>
            <h2>{{ $valid }}</h2>
            <span>Data diterima</span>
        </div>

        <div class="stat-card stat-invalid">
            <p>Tidak Valid</p>
            <h2>{{ $tidakValid }}</h2>
            <span>Perlu ditindaklanjuti</span>
        </div>
    </div>

    {{-- Pie chart --}}
    <div class="operator-panel chart-panel">
        <div class="panel-heading">
            <div>
                <h2>Statistik Verifikasi Penimbangan</h2>
                <p>
                    Perbandingan status penimbangan
                    pada lokasi operator.
                </p>
            </div>
        </div>

        <div class="chart-container">
            <canvas id="verificationChart"></canvas>
        </div>

        <div class="chart-legend">
            <span>
                <i class="legend-dot waiting"></i>
                Menunggu ({{ $menunggu }})
            </span>

            <span>
                <i class="legend-dot valid"></i>
                Valid ({{ $valid }})
            </span>

            <span>
                <i class="legend-dot invalid"></i>
                Tidak valid ({{ $tidakValid }})
            </span>
        </div>

        @if ($totalPenimbangan === 0)
            <p class="empty-state">
                Belum ada data penimbangan untuk ditampilkan.
            </p>
        @endif
    </div>

    {{-- Riwayat penimbangan --}}
    <div class="operator-panel history-panel">
        <div class="panel-heading">
            <div>
                <h2>Riwayat Penimbangan Terbaru</h2>
                <p>Lima penimbangan terakhir di lokasi tugas.</p>
            </div>

            <a href="{{ route('penimbangan.riwayat') }}"
               class="btn-history">
                Lihat Semua
            </a>
        </div>

        <div class="table-wrapper">
            <table class="operator-table">
                <thead>
                    <tr>
                        <th>Kode Ternak</th>
                        <th>Bobot</th>
                        <th>Sumber</th>
                        <th>Verifikasi</th>
                        <th>Ditimbang</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($riwayatTerbaru as $item)
                        @php
                            $status = $item->status_verifikasi
                                ?? 'menunggu';

                            $statusClass = match ($status) {
                                'valid' => 'status-valid',
                                'tidak_valid' => 'status-invalid',
                                default => 'status-waiting',
                            };
                        @endphp

                        <tr>
                            <td>
                                {{ $item->ternak->kode_ternak ?? '-' }}
                            </td>

                            <td>
                                {{ number_format(
                                    (float) $item->bobot,
                                    1,
                                    ',',
                                    '.'
                                ) }} kg
                            </td>

                            <td>
                                <span class="source-label">
                                    {{ str($item->sumber ?? '-')
                                        ->replace('_', ' ')
                                        ->title() }}
                                </span>
                            </td>

                            <td>
                                <span class="status-label {{ $statusClass }}">
                                    {{ str($status)
                                        ->replace('_', ' ')
                                        ->title() }}
                                </span>
                            </td>

                            <td>
                                {{ $item->ditimbang_at
                                    ? \Illuminate\Support\Carbon::parse(
                                        $item->ditimbang_at
                                    )->format('d M Y H.i')
                                    : '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty-state">
                                Belum ada data penimbangan
                                pada lokasi ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('verificationChart');

    if (!canvas || typeof Chart === 'undefined') {
        return;
    }

    const labels = @json($dataPie['labels']);
    const values = @json($dataPie['values']);

    new Chart(canvas, {
        type: 'pie',

        data: {
            labels: labels,
            datasets: [{
                data: values,
                backgroundColor: [
                    '#D69E2E',
                    '#26965B',
                    '#D9473F'
                ],
                borderColor: '#FFFFFF',
                borderWidth: 3,
                hoverOffset: 8
            }]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,

            plugins: {
                legend: {
                    display: false
                },

                tooltip: {
                    callbacks: {
                        label: function (context) {
                            const total = context.dataset.data
                                .reduce((sum, value) => sum + value, 0);

                            const value = context.raw;
                            const percent = total > 0
                                ? ((value / total) * 100).toFixed(1)
                                : '0.0';

                            return `${context.label}: ${value} (${percent}%)`;
                        }
                    }
                }
            }
        }
    });
});
</script>
@endpush