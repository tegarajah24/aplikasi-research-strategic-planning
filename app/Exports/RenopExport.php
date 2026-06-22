<?php

namespace App\Exports;

use App\Models\Kegiatan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RenopExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, WithEvents
{
    protected string $tahunAkademik;
    protected array $grouped;
    protected float $grandTotal;

    public function __construct(string $tahunAkademik)
    {
        $this->tahunAkademik = $tahunAkademik;

        $kegiatans = Kegiatan::with([
            'program.renstraStrategi.renstraSasaran.bidang'
        ])->where('tahun_akademik', $tahunAkademik)->get();

        $this->grouped = $kegiatans->groupBy([
            fn($k) => $k->program?->renstraStrategi?->renstraSasaran?->bidang?->nama_bidang ?? 'Tanpa Bidang',
            fn($k) => $k->program?->nama_program ?? 'Tanpa Program',
        ])->sortKeys();

        $this->grandTotal = $kegiatans->sum('kebutuhan_anggaran');
    }

    public function collection()
    {
        $rows = collect();
        $no = 0;

        foreach ($this->grouped as $bidang => $programs) {
            $programs = $programs->sortKeys();

            foreach ($programs as $program => $items) {
                $items = $items->sortBy('nama_kegiatan');

                foreach ($items as $kegiatan) {
                    $no++;
                    $rows->push([
                        'no' => $no,
                        'bidang' => $bidang,
                        'program' => $program,
                        'kegiatan' => $kegiatan->nama_kegiatan,
                        'indikator' => $kegiatan->indikator_kinerja,
                        'target' => $kegiatan->target_kegiatan,
                        'pj' => $kegiatan->penanggung_jawab,
                        'waktu' => $kegiatan->waktu_pelaksanaan,
                        'anggaran' => $kegiatan->kebutuhan_anggaran,
                    ]);
                }
            }
        }

        return $rows;
    }

    public function headings(): array
    {
        return [
            ['LAPORAN RENCANA OPERASIONAL (RENOP) TAHUNAN'],
            ["Tahun Akademik: {$this->tahunAkademik}"],
            [],
            ['No', 'Bidang', 'Program', 'Kegiatan', 'Indikator Kinerja', 'Target', 'Penanggung Jawab', 'Waktu Pelaksanaan', 'Anggaran'],
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Title row
        $sheet->mergeCells('A1:I1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14)->setName('Calibri');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Subtitle row
        $sheet->mergeCells('A2:I2');
        $sheet->getStyle('A2')->getFont()->setSize(11)->setName('Calibri');
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Header row (row 4)
        $headerRange = 'A4:I4';
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
                $highestRow = $sheet->getHighestRow();
                $colI = $highestRow + 1;

                // ── Styles ──
                $headerColor = '1F3864';
                $bidangColor = 'D6E4F0';
                $programColor = 'E9EFF7';
                $totalColor = '1F3864';

                $currentBidang = null;
                $bidangStartRow = 5;
                $programStartRow = 5;
                $currentProgram = null;
                $rowIdx = 5;

                $anggaranColumn = 'I';

                // First pass: group and merge
                $rawRows = $this->collection();
                $bidangRanges = [];
                $programRanges = [];

                foreach ($rawRows as $i => $row) {
                    $r = $rowIdx + $i;

                    // Track bidang ranges
                    if ($row['bidang'] !== $currentBidang) {
                        if ($currentBidang !== null && $r - 1 >= $bidangStartRow) {
                            $bidangRanges[] = ['start' => $bidangStartRow, 'end' => $r - 1, 'name' => $currentBidang];
                        }
                        $currentBidang = $row['bidang'];
                        $bidangStartRow = $r;
                    }

                    // Track program ranges
                    if ($row['program'] !== $currentProgram) {
                        if ($currentProgram !== null && $r - 1 >= $programStartRow) {
                            $programRanges[] = ['start' => $programStartRow, 'end' => $r - 1, 'name' => $currentProgram];
                        }
                        $currentProgram = $row['program'];
                        $programStartRow = $r;
                    }
                }

                // Last range
                $lastRow = $rowIdx + count($rawRows) - 1;
                if ($currentBidang !== null && $lastRow >= $bidangStartRow) {
                    $bidangRanges[] = ['start' => $bidangStartRow, 'end' => $lastRow, 'name' => $currentBidang];
                }
                if ($currentProgram !== null && $lastRow >= $programStartRow) {
                    $programRanges[] = ['start' => $programStartRow, 'end' => $lastRow, 'name' => $currentProgram];
                }

                // ── Apply bidang styling & merge ──
                foreach ($bidangRanges as $br) {
                    $range = "A{$br['start']}:A{$br['end']}";
                    $sheet->mergeCells($range);
                    $sheet->setCellValue("A{$br['start']}", $br['name']);
                    $sheet->getStyle("A{$br['start']}")->getFont()->setBold(true)->setSize(11)->setName('Calibri');
                    $sheet->getStyle("A{$br['start']}")->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                    $sheet->getStyle("A{$br['start']}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($bidangColor);
                }

                // ── Apply program styling & merge ──
                foreach ($programRanges as $pr) {
                    $range = "B{$pr['start']}:B{$pr['end']}";
                    $sheet->mergeCells($range);
                    $sheet->setCellValue("B{$pr['start']}", $pr['name']);
                    $sheet->getStyle("B{$pr['start']}")->getFont()->setBold(true)->setSize(10)->setName('Calibri');
                    $sheet->getStyle("B{$pr['start']}")->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                    $sheet->getStyle("B{$pr['start']}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($programColor);
                }

                // ── Border all data cells ──
                $dataRange = "A4:{$anggaranColumn}{$lastRow}";
                $sheet->getStyle($dataRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->getColor()->setARGB('999999');

                // ── Anggaran format ──
                $sheet->getStyle("{$anggaranColumn}5:{$anggaranColumn}{$lastRow}")
                    ->getNumberFormat()->setFormatCode('#,##0');

                // ── Row height ──
                for ($r = 5; $r <= $lastRow; $r++) {
                    $sheet->getRowDimension($r)->setRowHeight(22);
                }
                $sheet->getRowDimension(4)->setRowHeight(28);
                $sheet->getRowDimension(1)->setRowHeight(30);
                $sheet->getRowDimension(3)->setRowHeight(6);

                // ── Wrap text for content columns ──
                foreach (['C','D','E','F','G','H'] as $col) {
                    $sheet->getStyle("{$col}5:{$col}{$lastRow}")
                        ->getAlignment()->setWrapText(true);
                }

                // ── TOTAL ROW ──
                $totalRow = $lastRow + 2;
                $sheet->setCellValue("A{$totalRow}", 'TOTAL ANGGARAN');
                $sheet->mergeCells("A{$totalRow}:H{$totalRow}");
                $sheet->getStyle("A{$totalRow}")->getFont()->setBold(true)->setSize(12)->setName('Calibri');
                $sheet->getStyle("A{$totalRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);
                $sheet->getStyle("A{$totalRow}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($totalColor);
                $sheet->getStyle("A{$totalRow}")->getFont()->getColor()->setARGB('FFFFFF');

                // SUM formula
                $sheet->setCellValue("{$anggaranColumn}{$totalRow}", "=SUM({$anggaranColumn}5:{$anggaranColumn}{$lastRow})");
                $sheet->getStyle("{$anggaranColumn}{$totalRow}")->getFont()->setBold(true)->setSize(12)->setName('Calibri');
                $sheet->getStyle("{$anggaranColumn}{$totalRow}")->getNumberFormat()->setFormatCode('#,##0');
                $sheet->getStyle("{$anggaranColumn}{$totalRow}")->getFont()->getColor()->setARGB('FFFFFF');
                $sheet->getStyle("{$anggaranColumn}{$totalRow}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($totalColor);
                $sheet->getStyle("{$anggaranColumn}{$totalRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

                // ── Freeze pane ──
                $sheet->freezePane('A5');
            },
        ];
    }
}
