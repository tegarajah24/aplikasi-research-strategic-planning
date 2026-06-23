<?php

namespace App\Exports;

use App\Models\RenstraSasaran;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RenstraTableExport implements WithEvents, WithStyles
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
        $sheet->setTitle('Program RENSTRA');

        $sheet->mergeCells('A1:C1');
        $sheet->setCellValue('A1', 'DATA PROGRAM RENSTRA');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14)->setName('Calibri');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A3', 'Sasaran Strategis');
        $sheet->setCellValue('B3', 'Strategi');
        $sheet->setCellValue('C3', 'Program Tahunan');
        $sheet->getStyle('A3:C3')->getFont()->setBold(true)->setSize(11)->setName('Calibri')->getColor()->setARGB('FFFFFF');
        $sheet->getStyle('A3:C3')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('1F3864');
        $sheet->getStyle('A3:C3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A3:C3')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->getColor()->setARGB('FFFFFF');

        $sheet->getColumnDimension('A')->setWidth(40);
        $sheet->getColumnDimension('B')->setWidth(40);
        $sheet->getColumnDimension('C')->setWidth(45);

        $currentRow = 4;

        $grouped = RenstraSasaran::with(['bidang', 'strategis.programs'])
            ->orderBy('nama_sasaran')
            ->get()
            ->groupBy(fn($s) => $s->bidang?->nama_bidang ?? 'Tanpa Bidang');

        foreach ($grouped as $bidangName => $sasarans) {
            $sheet->setCellValue("A{$currentRow}", $bidangName);
            $sheet->mergeCells("A{$currentRow}:C{$currentRow}");
            $sheet->getStyle("A{$currentRow}")->getFont()->setBold(true)->setSize(11)->setName('Calibri')->getColor()->setARGB('1F3864');
            $sheet->getStyle("A{$currentRow}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('D6E4F0');
            $sheet->getRowDimension($currentRow)->setRowHeight(24);
            $currentRow++;

            foreach ($sasarans as $sasaran) {
                $strategis = $sasaran->strategis ?? collect();
                $sasaranStart = $currentRow;
                $sasaranRowCount = 0;

                foreach ($strategis as $strategi) {
                    $programs = $strategi->programs ?? collect();
                    $strategiStart = $currentRow;
                    $strategiRowCount = 0;

                    if ($programs->isEmpty()) {
                        $sheet->setCellValue("B{$currentRow}", $strategi->nama_strategi);
                        $sheet->setCellValue("C{$currentRow}", '- Belum ada program -');
                        $sheet->getStyle("C{$currentRow}")->getFont()->setItalic(true)->getColor()->setARGB('999999');
                        $currentRow++;
                        $sasaranRowCount++;
                        $strategiRowCount++;
                    } else {
                        foreach ($programs as $program) {
                            $sheet->setCellValue("B{$currentRow}", $strategi->nama_strategi);
                            $tahun = $program->tahun_akademik ? " ({$program->tahun_akademik})" : '';
                            $sheet->setCellValue("C{$currentRow}", 'Tahunan - ' . $program->nama_program . $tahun);
                            $currentRow++;
                            $sasaranRowCount++;
                            $strategiRowCount++;
                        }
                    }

                    if ($strategiRowCount > 1) {
                        $sheet->mergeCells("B{$strategiStart}:B" . ($strategiStart + $strategiRowCount - 1));
                    }
                }

                if ($strategis->isEmpty()) {
                    $sheet->setCellValue("C{$currentRow}", '- Belum ada strategi -');
                    $sheet->getStyle("C{$currentRow}")->getFont()->setItalic(true)->getColor()->setARGB('999999');
                    $currentRow++;
                    $sasaranRowCount++;
                }

                $sheet->setCellValue("A{$sasaranStart}", $sasaran->nama_sasaran);
                if ($sasaranRowCount > 1) {
                    $sheet->mergeCells("A{$sasaranStart}:A" . ($sasaranStart + $sasaranRowCount - 1));
                }
            }
        }

        $lastRow = $currentRow - 1;
        if ($lastRow >= 4) {
            $sheet->getStyle("A4:C{$lastRow}")->getBorders()->getAllBorders()
                ->setBorderStyle(Border::BORDER_THIN)->getColor()->setARGB('999999');
            $sheet->getStyle("A4:C{$lastRow}")->getAlignment()->setVertical(Alignment::VERTICAL_TOP);
            $sheet->getStyle("A4:C{$lastRow}")->getAlignment()->setWrapText(true);
        }

        $sheet->freezePane('A4');
    }
}
