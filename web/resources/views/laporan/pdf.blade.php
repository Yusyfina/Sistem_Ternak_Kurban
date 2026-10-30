<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>{{ $laporan->judul() }}</title>
    <style>
        @page { margin: 28px 30px 42px 30px; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 9px; color: #1f2933; }
        h1 { font-size: 16px; margin: 0 0 2px 0; color: #164A3A; }
        .sub { font-size: 11px; font-weight: bold; margin-bottom: 6px; }
        .meta { font-size: 8.5px; color: #52606d; margin: 0 0 10px 0; }
        .meta span { margin-right: 14px; }
        table { width: 100%; border-collapse: collapse; }
        thead { display: table-header-group; }
        th { background: #164A3A; color: #ffffff; text-align: left; padding: 5px 6px; font-size: 8.5px; }
        td { padding: 4px 6px; border-bottom: 1px solid #d9e2dc; vertical-align: top; }
        .no { width: 22px; text-align: center; }
        .kosong { text-align: center; padding: 18px; color: #7b8794; }
        .foot { position: fixed; bottom: -26px; left: 0; right: 0; font-size: 8px; color: #7b8794; text-align: center; }
    </style>
</head>
<body>
    <h1>SITERNAK</h1>
    <div class="sub">{{ $laporan->judul() }}</div>

    <div class="meta">
        @foreach ($laporan->ringkasan() as $label => $nilai)
            <span><strong>{{ $label }}:</strong> {{ $nilai }}</span>
        @endforeach
    </div>

    <table>
        <thead>
            <tr>
                @foreach ($laporan->kolom() as $kolom)
                    <th @class(['no' => $loop->first])>{{ $kolom }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse ($laporan->data() as $baris)
                <tr>
                    @foreach ($baris as $i => $sel)
                        <td @class(['no' => $i === 0])>{{ \App\Laporan\Laporan::sel($sel) }}</td>
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td class="kosong" colspan="{{ count($laporan->kolom()) }}">
                        Tidak ada data pada cakupan dan filter ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="foot">SITERNAK · {{ $laporan->judul() }} · Dokumen ini dibuat otomatis oleh sistem</div>
</body>
</html>