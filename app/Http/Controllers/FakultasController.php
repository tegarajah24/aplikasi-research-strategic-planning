<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
    public function index(Request $request)
    {
        $query = Fakultas::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama_fakultas', 'like', "%{$search}%")
                  ->orWhere('kode_fakultas', 'like', "%{$search}%");
        }

        $fakultas = $query->orderBy('kode_fakultas', 'asc')->paginate(10);
        
        return view('fakultas.index', compact('fakultas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_fakultas' => 'required|string|max:50|unique:fakultas,kode_fakultas',
            'nama_fakultas' => 'required|string|max:255',
            'dekan'         => 'nullable|string|max:255',
        ]);

        Fakultas::create($validated);

        return redirect()->route('fakultas.index')->with('success', 'Data Fakultas berhasil ditambahkan.');
    }

    public function update(Request $request, Fakultas $fakulta)
    {
        // Laravel's route-model binding might inject $fakulta because the resource name is 'fakultas'
        $validated = $request->validate([
            'kode_fakultas' => 'required|string|max:50|unique:fakultas,kode_fakultas,' . $fakulta->id,
            'nama_fakultas' => 'required|string|max:255',
            'dekan'         => 'nullable|string|max:255',
        ]);

        $fakulta->update($validated);

        return redirect()->route('fakultas.index')->with('success', 'Data Fakultas berhasil diperbarui.');
    }

    public function destroy(Fakultas $fakulta)
    {
        $fakulta->delete();
        return redirect()->route('fakultas.index')->with('success', 'Data Fakultas berhasil dihapus.');
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
            
            // Format: Kode Fakultas, Nama Fakultas, Dekan
            if (count($data) >= 2) {
                $kode = trim($data[0] ?? '');
                $nama = trim($data[1] ?? '');
                
                if (!empty($kode) && !empty($nama)) {
                    Fakultas::updateOrCreate(
                        ['kode_fakultas' => $kode],
                        [
                            'nama_fakultas' => $nama,
                            'dekan' => trim($data[2] ?? null),
                        ]
                    );
                    $count++;
                }
            }
        }
        
        fclose($handle);

        return redirect()->route('fakultas.index')->with('success', "$count Data Fakultas berhasil diimport/diperbarui.");
    }
    
    public function export()
    {
        $fakultas = Fakultas::orderBy('kode_fakultas', 'asc')->get();
        $fileName = 'data_fakultas.csv';
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Kode Fakultas', 'Nama Fakultas', 'Dekan');

        $callback = function() use($fakultas, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($fakultas as $item) {
                $row['Kode Fakultas']  = $item->kode_fakultas;
                $row['Nama Fakultas']  = $item->nama_fakultas;
                $row['Dekan']          = $item->dekan;

                fputcsv($file, array($row['Kode Fakultas'], $row['Nama Fakultas'], $row['Dekan']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
