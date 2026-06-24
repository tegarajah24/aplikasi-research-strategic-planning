<?php

namespace App\Exports;

use App\Models\Kegiatan;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KegiatanTableExport implements WithEvents, WithStyles
{
    use Exportable;

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $this->buildSheet($sheet);
            },
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [];
    }

    private function buildSheet(Worksheet $sheet)
    {
        $sheet->setTitle('Data Kegiatan');

        $sheet->mergeCells('A1:G1');
        $sheet->setCellValue('A1', 'DATA KEGIATAN PENELITIAN');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14)->setName('Calibri');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $headers = ['Kode', 'Kegiatan', 'Indikator Kinerja', 'Target', 'Penanggung Jawab', 'Waktu Pelaksanaan', 'Anggaran (Juta Rp)'];
        $cols = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];
        foreach ($headers as $i => $header) {
            $sheet->setCellValue($cols[$i] . '3', $header);
        }
        $sheet->getStyle('A3:G3')->getFont()->setBold(true)->setSize(11)->setName('Calibri')->getColor()->setARGB('FFFFFF');
        $sheet->getStyle('A3:G3')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('1F3864');
        $sheet->getStyle('A3:G3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A3:G3')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->getColor()->setARGB('FFFFFF');

        $sheet->getColumnDimension('A')->setWidth(12);
        $sheet->getColumnDimension('B')->setWidth(40);
        $sheet->getColumnDimension('C')->setWidth(40);
        $sheet->getColumnDimension('D')->setWidth(18);
        $sheet->getColumnDimension('E')->setWidth(22);
        $sheet->getColumnDimension('F')->setWidth(22);
        $sheet->getColumnDimension('G')->setWidth(18);

        $currentRow = 4;
        $grandTotal = 0;

        $allKegiatans = Kegiatan::with('program.renstraStrategi.renstraSasaran.bidang')
            ->orderBy('kode_kegiatan')
            ->get();

        $grouped = $allKegiatans->groupBy(function ($item) {
            return $item->program?->renstraStrategi?->renstraSasaran?->bidang?->nama_bidang ?? 'Tanpa Bidang';
        })->map(function ($bidangGroup) {
            return $bidangGroup->groupBy(function ($item) {
                return $item->program?->nama_program ?? 'Tanpa Program';
            });
        });

        foreach ($grouped as $bidangName => $programs) {
            $sheet->setCellValue("A{$currentRow}", $bidangName);
            $sheet->mergeCells("A{$currentRow}:G{$currentRow}");
            $sheet->getStyle("A{$currentRow}")->getFont()->setBold(true)->setSize(11)->setName('Calibri')->getColor()->setARGB('FFFFFF');
            $sheet->getStyle("A{$currentRow}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('1E3A8A');
            $sheet->getRowDimension($currentRow)->setRowHeight(24);
            $currentRow++;

            foreach ($programs as $programName => $kegiatans) {
                $sheet->setCellValue("A{$currentRow}", $programName);
                $sheet->mergeCells("A{$currentRow}:G{$currentRow}");
                $sheet->getStyle("A{$currentRow}")->getFont()->setItalic(true)->setSize(10)->setName('Calibri');
                $sheet->getStyle("A{$currentRow}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('E2E8F0');
                $currentRow++;

                foreach ($kegiatans as $kegiatan) {
                    $anggaran = is_numeric($kegiatan->kebutuhan_anggaran) ? (float) $kegiatan->kebutuhan_anggaran : 0;
                    $grandTotal += $anggaran;

                    $sheet->setCellValue("A{$currentRow}", $kegiatan->kode_kegiatan);
                    $sheet->setCellValue("B{$currentRow}", $kegiatan->nama_kegiatan);
                    $sheet->setCellValue("C{$currentRow}", $kegiatan->indikator_kinerja);
                    $sheet->setCellValue("D{$currentRow}", $kegiatan->target_kegiatan);
                    $sheet->setCellValue("E{$currentRow}", $kegiatan->penanggung_jawab);
                    $sheet->setCellValue("F{$currentRow}", $kegiatan->waktu_pelaksanaan);
                    $sheet->setCellValue("G{$currentRow}", $anggaran / 1_000_000);
                    $sheet->getStyle("G{$currentRow}")->getNumberFormat()->setFormatCode('#,##0.0');
                    $currentRow++;
                }
            }
        }

        if ($grandTotal > 0) {
            $sheet->setCellValue("A{$currentRow}", 'TOTAL KEBUTUHAN ANGGARAN FAKULTAS');
            $sheet->mergeCells("A{$currentRow}:F{$currentRow}");
            $sheet->setCellValue("G{$currentRow}", $grandTotal / 1_000_000);
            $sheet->getStyle("G{$currentRow}")->getNumberFormat()->setFormatCode('#,##0.0');
            $sheet->getStyle("A{$currentRow}:G{$currentRow}")->getFont()->setBold(true);
            $sheet->getStyle("A{$currentRow}:G{$currentRow}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FEF08A');
            $currentRow++;
        }

        $lastRow = $currentRow - 1;
        if ($lastRow >= 4) {
            $sheet->getStyle("A4:G{$lastRow}")->getBorders()->getAllBorders()
                ->setBorderStyle(Border::BORDER_THIN)->getColor()->setARGB('999999');
            $sheet->getStyle("A4:G{$lastRow}")->getAlignment()->setVertical(Alignment::VERTICAL_TOP);
            $sheet->getStyle("A4:G{$lastRow}")->getAlignment()->setWrapText(true);
        }

        $sheet->freezePane('A4');
    }
}
