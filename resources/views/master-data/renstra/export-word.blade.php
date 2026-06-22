<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Program RENSTRA</title>
    <style>
        body { font-family: Calibri, Arial, sans-serif; font-size: 11pt; margin: 30px; }
        h2 { text-align: center; font-size: 16pt; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; font-size: 10pt; }
        th { background-color: #1F3864; color: #ffffff; padding: 8px 6px; text-align: center; font-weight: bold; border: 1px solid #999; }
        td { padding: 6px; border: 1px solid #ccc; vertical-align: top; }
        tr:nth-child(even) { background-color: #f5f5f5; }
        .no { text-align: center; width: 30px; }
        .tahun { text-align: center; }
    </style>
</head>
<body>
    <h2>DATA PROGRAM RENSTRA</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Bidang</th>
                <th>Sasaran</th>
                <th>Strategi</th>
                <th>Program Tahunan</th>
                <th>Tahun Akademik</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 0; @endphp
            @foreach($programs as $p)
                @php $no++; @endphp
                <tr>
                    <td class="no">{{ $no }}</td>
                    <td>{{ $p->renstraStrategi?->renstraSasaran?->bidang?->nama_bidang ?? '-' }}</td>
                    <td>{{ $p->renstraStrategi?->renstraSasaran?->nama_sasaran ?? '-' }}</td>
                    <td>{{ $p->renstraStrategi?->nama_strategi ?? '-' }}</td>
                    <td>{{ $p->nama_program }}</td>
                    <td class="tahun">{{ $p->tahun_akademik ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
