<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Models\PrestasiNonAkademik;

class PrestasiNonAkademikController extends Controller
{
    public function index(Request $request)
    {
        $query = PrestasiNonAkademik::query();

        // Calculate totals for widgets
        $totalRegional = PrestasiNonAkademik::sum('regional');
        $totalNasional = PrestasiNonAkademik::sum('nasional');
        $totalInternasional = PrestasiNonAkademik::sum('internasional');
        
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('tahun', 'like', "%{$search}%");
        }

        $prestasis = $query->orderBy('tahun', 'desc')->paginate(10);
        return view('prestasi-non-akademik.index', compact('prestasis', 'totalRegional', 'totalNasional', 'totalInternasional'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tahun' => 'required|integer',
            'nama_mahasiswa' => 'nullable|string|max:255',
            'prodi' => 'nullable|string|max:255',
            'fakultas' => 'nullable|string|max:255',
            'regional' => 'required|integer|min:0',
            'nasional' => 'required|integer|min:0',
            'internasional' => 'required|integer|min:0',
        ]);

        $prestasi = PrestasiNonAkademik::create($validated);
        ActivityLog::log('Menambahkan prestasi non-akademik', 'Prestasi Non-Akademik', $prestasi->id, $prestasi->tahun);

        return redirect()->route('prestasi-non-akademik.index')->with('success', 'Data Prestasi Non-Akademik berhasil ditambahkan.');
    }

    public function update(Request $request, PrestasiNonAkademik $prestasi_non_akademik)
    {
        $validated = $request->validate([
            'tahun' => 'required|integer',
            'nama_mahasiswa' => 'nullable|string|max:255',
            'prodi' => 'nullable|string|max:255',
            'fakultas' => 'nullable|string|max:255',
            'regional' => 'required|integer|min:0',
            'nasional' => 'required|integer|min:0',
            'internasional' => 'required|integer|min:0',
        ]);

        $prestasi_non_akademik->update($validated);
        ActivityLog::log('Memperbarui prestasi non-akademik', 'Prestasi Non-Akademik', $prestasi_non_akademik->id, $prestasi_non_akademik->tahun);

        return redirect()->route('prestasi-non-akademik.index')->with('success', 'Data Prestasi Non-Akademik berhasil diperbarui.');
    }

    public function destroy(PrestasiNonAkademik $prestasi_non_akademik)
    {
        ActivityLog::log('Menghapus prestasi non-akademik', 'Prestasi Non-Akademik', $prestasi_non_akademik->id, $prestasi_non_akademik->tahun);
        $prestasi_non_akademik->delete();
        return redirect()->route('prestasi-non-akademik.index')->with('success', 'Data Prestasi Non-Akademik berhasil dihapus.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file_import' => 'required|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('file_import');
        $handle = fopen($file->getPathname(), "r");
        
        $header = true;
        $count = 0;
        
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if ($header) {
                $header = false;
                continue;
            }
            
            // Format: Tahun, Nama Mahasiswa, Prodi, Fakultas, Regional, Nasional, Internasional
            if (count($data) >= 7) {
                $tahun = (int)($data[0] ?? 0);
                if ($tahun > 0) {
                    PrestasiNonAkademik::create([
                        'tahun' => $tahun,
                        'nama_mahasiswa' => $data[1] ?? null,
                        'prodi' => $data[2] ?? null,
                        'fakultas' => $data[3] ?? null,
                        'regional' => (int)($data[4] ?? 0),
                        'nasional' => (int)($data[5] ?? 0),
                        'internasional' => (int)($data[6] ?? 0),
                    ]);
                    $count++;
                }
            }
        }
        
        fclose($handle);

        return redirect()->route('prestasi-non-akademik.index')->with('success', "$count Data Prestasi Non-Akademik berhasil diimport/diperbarui.");
    }
    
    public function export()
    {
        $prestasis = PrestasiNonAkademik::orderBy('tahun', 'desc')->get();
        $fileName = 'data_prestasi_non_akademik.csv';
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Tahun', 'Nama Mahasiswa', 'Prodi', 'Fakultas', 'Regional', 'Nasional', 'Internasional', 'Total');

        $callback = function() use($prestasis, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($prestasis as $item) {
                $row['Tahun']  = $item->tahun;
                $row['Nama Mahasiswa'] = $item->nama_mahasiswa;
                $row['Prodi'] = $item->prodi;
                $row['Fakultas'] = $item->fakultas;
                $row['Regional']    = $item->regional;
                $row['Nasional']    = $item->nasional;
                $row['Internasional']  = $item->internasional;
                $row['Total']  = $item->regional + $item->nasional + $item->internasional;

                fputcsv($file, array($row['Tahun'], $row['Nama Mahasiswa'], $row['Prodi'], $row['Fakultas'], $row['Regional'], $row['Nasional'], $row['Internasional'], $row['Total']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
