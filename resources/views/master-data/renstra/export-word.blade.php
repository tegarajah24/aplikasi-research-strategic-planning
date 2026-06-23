<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Program RENSTRA</title>
    <style>
        body { font-family: Calibri, Arial, sans-serif; font-size: 11pt; margin: 30px; }
        h2 { text-align: center; font-size: 16pt; margin-bottom: 20px; color: #1F3864; }
        table { width: 100%; border-collapse: collapse; font-size: 10pt; }
        th { background-color: #1F3864; color: #ffffff; padding: 8px 6px; text-align: center; font-weight: bold; border: 1px solid #999; }
        td { padding: 6px; border: 1px solid #ccc; vertical-align: top; }
        .bidang-header { background-color: #D6E4F0; color: #1F3864; font-weight: bold; font-size: 11pt; padding: 8px; }
        .tahun { color: #666; font-size: 9pt; }
        .empty { color: #999; font-style: italic; text-align: center; }
    </style>
</head>
<body>
    <h2>DATA PROGRAM RENSTRA</h2>
    <table>
        <thead>
            <tr>
                <th style="width:35%;">Sasaran Strategis</th>
                <th style="width:35%;">Strategi</th>
                <th style="width:30%;">Program Tahunan</th>
            </tr>
        </thead>
        <tbody>
            @php
                $grouped = $sasarans->groupBy(fn($s) => $s->bidang?->nama_bidang ?? 'Tanpa Bidang');
            @endphp
            @foreach($grouped as $bidangName => $sasaranList)
                <tr>
                    <td colspan="3" class="bidang-header">{{ $bidangName }}</td>
                </tr>

                @foreach($sasaranList as $sasaranIdx => $sasaran)
                    @php
                        $strategis = $sasaran->strategis ?? collect();
                        $totalSasaranRows = 0;
                        foreach ($strategis as $st) {
                            $totalSasaranRows += max(1, $st->programs->count());
                        }
                        $totalSasaranRows = max(1, $totalSasaranRows);
                    @endphp

                    @foreach($strategis as $stIdx => $strategi)
                        @php $programRows = max(1, $strategi->programs->count()); @endphp

                        @foreach($strategi->programs as $prIdx => $program)
                            <tr>
                                @if($stIdx === 0 && $prIdx === 0)
                                    <td rowspan="{{ $totalSasaranRows }}" style="font-weight:500;padding:10px 8px;">{{ $sasaran->nama_sasaran }}</td>
                                @endif
                                @if($prIdx === 0)
                                    <td rowspan="{{ $programRows }}" style="color:#555;padding:10px 8px;">{{ $strategi->nama_strategi }}</td>
                                @endif
                                <td style="padding:8px;">
                                    {{ $program->nama_program }}
                                    @if($program->tahun_akademik)
                                        <span class="tahun">({{ $program->tahun_akademik }})</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                        @if($strategi->programs->isEmpty())
                            <tr>
                                @if($stIdx === 0)
                                    <td rowspan="{{ $totalSasaranRows }}" style="font-weight:500;padding:10px 8px;">{{ $sasaran->nama_sasaran }}</td>
                                @endif
                                <td style="color:#555;padding:10px 8px;">{{ $strategi->nama_strategi }}</td>
                                <td class="empty">- Belum ada program -</td>
                            </tr>
                        @endif
                    @endforeach

                    @if($strategis->isEmpty())
                        <tr>
                            <td style="font-weight:500;padding:10px 8px;">{{ $sasaran->nama_sasaran }}</td>
                            <td class="empty">- Belum ada strategi -</td>
                            <td class="empty">- Belum ada program -</td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>
</html>
