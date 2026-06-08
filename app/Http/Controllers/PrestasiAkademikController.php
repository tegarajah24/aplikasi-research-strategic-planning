<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\PrestasiAkademik;
use Illuminate\Http\Request;

class PrestasiAkademikController extends Controller
{
    public function index(Request $request)
    {
        $query = PrestasiAkademik::query();

        // Calculate totals for widgets
        $totalRegional = PrestasiAkademik::sum('regional');
        $totalNasional = PrestasiAkademik::sum('nasional');
        $totalInternasional = PrestasiAkademik::sum('internasional');
        
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('tahun', 'like', "%{$search}%");
        }

        $prestasis = $query->orderBy('tahun', 'desc')->paginate(10);
        return view('prestasi-akademik.index', compact('prestasis', 'totalRegional', 'totalNasional', 'totalInternasional'));
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

        $prestasi = PrestasiAkademik::create($validated);
        ActivityLog::log('Menambahkan prestasi akademik', 'Prestasi Akademik', $prestasi->id, $prestasi->tahun);

        return redirect()->route('prestasi-akademik.index')->with('success', 'Data Prestasi Akademik berhasil ditambahkan.');
    }

    public function update(Request $request, PrestasiAkademik $prestasiAkademik)
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

        $prestasiAkademik->update($validated);
        ActivityLog::log('Memperbarui prestasi akademik', 'Prestasi Akademik', $prestasiAkademik->id, $prestasiAkademik->tahun);

        return redirect()->route('prestasi-akademik.index')->with('success', 'Data Prestasi Akademik berhasil diperbarui.');
    }

    public function destroy(PrestasiAkademik $prestasiAkademik)
    {
        ActivityLog::log('Menghapus prestasi akademik', 'Prestasi Akademik', $prestasiAkademik->id, $prestasiAkademik->tahun);
        $prestasiAkademik->delete();
        return redirect()->route('prestasi-akademik.index')->with('success', 'Data Prestasi Akademik berhasil dihapus.');
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
            
            // Format: Tahun, Regional, Nasional, Internasional
            if (count($data) >= 4) {
                $tahun = (int)($data[0] ?? 0);
                if ($tahun > 0) {
                    PrestasiAkademik::updateOrCreate(
                        ['tahun' => $tahun],
                        [
                            'regional' => (int)($data[1] ?? 0),
                            'nasional' => (int)($data[2] ?? 0),
                            'internasional' => (int)($data[3] ?? 0),
                        ]
                    );
                    $count++;
                }
            }
        }
        
        fclose($handle);

        return redirect()->route('prestasi-akademik.index')->with('success', "$count Data Rekapitulasi Prestasi Akademik berhasil diimport/diperbarui.");
    }
    
    public function export()
    {
        $prestasis = PrestasiAkademik::orderBy('tahun', 'desc')->get();
        $fileName = 'rekap_prestasi_akademik.csv';
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
