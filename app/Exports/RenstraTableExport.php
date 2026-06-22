<?php

namespace App\Exports;

use App\Models\RenstraProgram;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class RenstraTableExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, WithEvents
{
    public function collection()
    {
        $programs = RenstraProgram::with([
            'renstraStrategi.renstraSasaran.bidang'
        ])->get()->sortBy(function ($p) {
            return $p->renstraStrategi?->renstraSasaran?->bidang?->nama_bidang
                . $p->renstraStrategi?->renstraSasaran?->nama_sasaran
                . $p->renstraStrategi?->nama_strategi
                . $p->nama_program;
        });

        $rows = collect();
        $no = 0;

        foreach ($programs as $p) {
            $no++;
            $rows->push([
                'no' => $no,
                'bidang' => $p->renstraStrategi?->renstraSasaran?->bidang?->nama_bidang ?? '-',
                'sasaran' => $p->renstraStrategi?->renstraSasaran?->nama_sasaran ?? '-',
                'strategi' => $p->renstraStrategi?->nama_strategi ?? '-',
                'program' => $p->nama_program,
                'tahun' => $p->tahun_akademik ?? '-',
            ]);
        }

        return $rows;
    }

    public function headings(): array
    {
        return [
            ['DATA PROGRAM RENSTRA'],
            [],
            ['No', 'Bidang', 'Sasaran', 'Strategi', 'Program Tahunan', 'Tahun Akademik'],
        ];
    }

    public function styles(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet)
    {
        $sheet->mergeCells('A1:F1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14)->setName('Calibri');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $headerRange = 'A3:F3';
        $sheet->getStyle($headerRange)->getFont()->setBold(true)->setSize(11)->setName('Calibri')->getColor()->setARGB('FFFFFF');
        $sheet->getStyle($headerRange)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('1F3864');
        $sheet->getStyle($headerRange)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle($headerRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->getColor()->setARGB('FFFFFF');
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;
                $lastRow = $sheet->getHighestRow();

                if ($lastRow < 4) return;

                $sheet->getStyle("A3:F{$lastRow}")->getBorders()->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN)->getColor()->setARGB('999999');

                $sheet->getRowDimension(3)->setRowHeight(24);

                for ($r = 4; $r <= $lastRow; $r++) {
                    $sheet->getRowDimension($r)->setRowHeight(20);
                }

                $sheet->getStyle("E4:F{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle("A4:A{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $sheet->freezePane('A4');
            },
        ];
    }
}
