<?php

namespace App\Http\Controllers;

use App\Exports\TabelExport;
use App\Exports\WordExport;
use App\Laporan\Laporan;
use App\Models\LokasiPeternakan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel as TipeExcel;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    /**
     * Pusat Laporan: daftar laporan yang boleh diakses role ini.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $daftar = collect(config('laporan.modul'))
            ->filter(fn (array $m) => in_array($user->role, $m['roles'], true));

        $lokasi = $user->bolehLihatSemuaLokasi()
            ? LokasiPeternakan::orderBy('nama')->get()
            : collect();

        return view('laporan.index', compact('daftar', 'lokasi'));
    }

    /**
     * Unduh satu laporan dalam satu format.
     */
    public function export(Request $request, string $modul, string $format)
    {
        $konfig = config("laporan.modul.{$modul}");

        abort_if($konfig === null, 404);
        abort_unless(
            in_array($request->user()->role, $konfig['roles'], true),
            403,
            'Anda tidak memiliki akses ke laporan ini.'
        );

        /** @var Laporan $laporan */
        $laporan = new $konfig['class']($request->user(), $request);
        $nama    = $laporan->namaFile();

        return match ($format) {
            'xlsx' => Excel::download(new TabelExport($laporan), "{$nama}.xlsx"),
            'csv'  => Excel::download(new TabelExport($laporan), "{$nama}.csv", TipeExcel::CSV),
            'pdf'  => $this->pdf($laporan, "{$nama}.pdf"),
            'docx' => (new WordExport($laporan))->unduh("{$nama}.docx"),
        };
    }

    private function pdf(Laporan $laporan, string $namaFile)
    {
        return Pdf::loadView('laporan.pdf', ['laporan' => $laporan])
            ->setPaper('a4', count($laporan->kolom()) > 7 ? 'landscape' : 'portrait')
            ->download($namaFile);
    }
}