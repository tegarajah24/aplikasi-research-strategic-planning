<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Kegiatan Penelitian</title>
    <style>
        body { font-family: Calibri, Arial, sans-serif; font-size: 11pt; margin: 30px; }
        h2 { text-align: center; font-size: 16pt; margin-bottom: 20px; color: #1F3864; }
        table { width: 100%; border-collapse: collapse; font-size: 10pt; }
        th { background-color: #1F3864; color: #ffffff; padding: 8px 6px; text-align: center; font-weight: bold; border: 1px solid #999; }
        td { padding: 6px; border: 1px solid #ccc; vertical-align: top; }
        .bidang-header { background-color: #1E3A8A; color: #ffffff; font-weight: bold; font-size: 11pt; padding: 8px; }
        .program-header { background-color: #E2E8F0; color: #0F172A; font-style: italic; font-weight: 600; padding: 8px; }
        .anggaran { text-align: right; font-weight: bold; }
        .total-row { background-color: #FEF08A; font-weight: bold; }
        .total-label { text-align: center; text-transform: uppercase; }
        .empty { color: #999; font-style: italic; text-align: center; }
    </style>
</head>
<body>
    <h2>DATA KEGIATAN PENELITIAN</h2>
    <table>
        <thead>
            <tr>
                <th style="width:10%;">Kode</th>
                <th style="width:25%;">Kegiatan</th>
                <th style="width:25%;">Indikator Kinerja</th>
                <th style="width:12%;">Target</th>
                <th style="width:12%;">Penanggung Jawab</th>
                <th style="width:10%;">Waktu</th>
                <th style="width:8%;">Anggaran (Juta Rp)</th>
            </tr>
        </thead>
        <tbody>
            @php
                $allKegiatans = \App\Models\Kegiatan::with('program.renstraStrategi.renstraSasaran.bidang')
                    ->orderBy('kode_kegiatan')
                    ->get();

                $grouped = $allKegiatans->groupBy(function ($item) {
                    return $item->program?->renstraStrategi?->renstraSasaran?->bidang?->nama_bidang ?? 'Tanpa Bidang';
                })->map(function ($bidangGroup) {
                    return $bidangGroup->groupBy(function ($item) {
                        return $item->program?->nama_program ?? 'Tanpa Program';
                    });
                });

                $grandTotalAnggaran = 0;
            @endphp

            @foreach($grouped as $bidangName => $programs)
                <tr>
                    <td colspan="7" class="bidang-header">{{ $bidangName }}</td>
                </tr>

                @foreach($programs as $programName => $kegiatans)
                    <tr>
                        <td colspan="7" class="program-header">{{ $programName }}</td>
                    </tr>

                    @foreach($kegiatans as $kegiatan)
                        @php
                            $anggaranNumeric = is_numeric($kegiatan->kebutuhan_anggaran) ? (float) $kegiatan->kebutuhan_anggaran : 0;
                            $grandTotalAnggaran += $anggaranNumeric;
                        @endphp
                        <tr>
                            <td style="text-align:center;">{{ $kegiatan->kode_kegiatan }}</td>
                            <td>{{ $kegiatan->nama_kegiatan }}</td>
                            <td>{{ $kegiatan->indikator_kinerja }}</td>
                            <td style="text-align:center;">{{ $kegiatan->target_kegiatan }}</td>
                            <td style="text-align:center;">{{ $kegiatan->penanggung_jawab }}</td>
                            <td style="text-align:center;">{{ $kegiatan->waktu_pelaksanaan }}</td>
                            <td class="anggaran">{{ number_format($anggaranNumeric / 1_000_000, 1) }}</td>
                        </tr>
                    @endforeach
                @endforeach
            @endforeach

            @if($grandTotalAnggaran > 0)
                <tr class="total-row">
                    <td colspan="6" class="total-label">TOTAL KEBUTUHAN ANGGARAN FAKULTAS</td>
                    <td class="anggaran">{{ number_format($grandTotalAnggaran / 1_000_000, 1) }}</td>
                </tr>
            @else
                <tr>
                    <td colspan="7" class="empty">Tidak ada data kegiatan.</td>
                </tr>
            @endif
        </tbody>
    </table>
</body>
</html>
