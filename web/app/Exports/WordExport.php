<?php

namespace App\Exports;

use App\Laporan\Laporan;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\SimpleType\TblWidth;
use PhpOffice\PhpWord\Style\Table;
use Symfony\Component\HttpFoundation\StreamedResponse;

class WordExport
{
    public function __construct(private Laporan $laporan)
    {
    }

    public function unduh(string $namaFile): StreamedResponse
    {
        // Tanda & dan < pada data harus di-escape agar XML Word valid.
        Settings::setOutputEscapingEnabled(true);

        $word = new PhpWord();
        $word->setDefaultFontName('Calibri');
        $word->setDefaultFontSize(10);

        $kolom = $this->laporan->kolom();

        $section = $word->addSection([
            'orientation' => count($kolom) > 7 ? 'landscape' : 'portrait',
            'marginLeft'   => 850,
            'marginRight'  => 850,
            'marginTop'    => 850,
            'marginBottom' => 850,
        ]);

        $section->addText('SITERNAK', ['bold' => true, 'size' => 18, 'color' => '164A3A']);
        $section->addText($this->laporan->judul(), ['bold' => true, 'size' => 13]);

        foreach ($this->laporan->ringkasan() as $label => $nilai) {
            $section->addText("{$label}: {$nilai}", ['size' => 9, 'color' => '52606D'], ['spaceAfter' => 0]);
        }

        $section->addTextBreak(1);

        $tabel = $section->addTable([
            'borderSize'  => 4,
            'borderColor' => 'C9D1CA',
            'cellMargin'  => 60,
            'unit'        => TblWidth::PERCENT,
            'width'       => 5000,
            'layout'      => Table::LAYOUT_AUTO,
        ]);

        $tabel->addRow(null, ['tblHeader' => true]);
        foreach ($kolom as $i => $nama) {
            $tabel->addCell($i === 0 ? 600 : null, ['bgColor' => '164A3A'])
                ->addText($nama, ['bold' => true, 'color' => 'FFFFFF', 'size' => 9], ['spaceAfter' => 0]);
        }

        foreach ($this->laporan->data() as $baris) {
            $tabel->addRow();
            foreach ($baris as $i => $sel) {
                $tabel->addCell($i === 0 ? 600 : null)
                    ->addText(Laporan::sel($sel), ['size' => 9], ['spaceAfter' => 0]);
            }
        }

        $section->addFooter()->addPreserveText(
            'Halaman {PAGE} dari {NUMPAGES}',
            ['size' => 8, 'color' => '7B8794'],
            ['alignment' => Jc::CENTER]
        );

        $penulis = IOFactory::createWriter($word, 'Word2007');

        return response()->streamDownload(
            fn () => $penulis->save('php://output'),
            $namaFile,
            ['Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']
        );
    }
}