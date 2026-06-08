<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Prodi;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index(Request $request)
    {
        $query = Prodi::with('fakultas');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama_prodi', 'like', "%{$search}%")
                  ->orWhere('kode_prodi', 'like', "%{$search}%")
                  ->orWhereHas('fakultas', function($q) use ($search) {
                      $q->where('nama_fakultas', 'like', "%{$search}%");
                  });
        }

        $prodis = $query->orderBy('kode_prodi', 'asc')->paginate(10);
        $fakultas = Fakultas::orderBy('nama_fakultas', 'asc')->get();
        
        return view('prodi.index', compact('prodis', 'fakultas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_prodi'  => 'required|string|max:50|unique:prodis,kode_prodi',
            'nama_prodi'  => 'required|string|max:255',
            'fakultas_id' => 'required|exists:fakultas,id',
        ]);

        $prodi = Prodi::create($validated);
        ActivityLog::log('Menambahkan prodi', 'Prodi', $prodi->id, $prodi->nama_prodi);

        return redirect()->route('prodi.index')->with('success', 'Data Program Studi berhasil ditambahkan.');
    }

    public function update(Request $request, Prodi $prodi)
    {
        $validated = $request->validate([
            'kode_prodi'  => 'required|string|max:50|unique:prodis,kode_prodi,' . $prodi->id,
            'nama_prodi'  => 'required|string|max:255',
            'fakultas_id' => 'required|exists:fakultas,id',
        ]);

        $prodi->update($validated);
        ActivityLog::log('Memperbarui prodi', 'Prodi', $prodi->id, $prodi->nama_prodi);

        return redirect()->route('prodi.index')->with('success', 'Data Program Studi berhasil diperbarui.');
    }

    public function destroy(Prodi $prodi)
    {
        ActivityLog::log('Menghapus prodi', 'Prodi', $prodi->id, $prodi->nama_prodi);
        $prodi->delete();
        return redirect()->route('prodi.index')->with('success', 'Data Program Studi berhasil dihapus.');
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
        
        // Fetch all fakultas to map kode_fakultas to id efficiently
        $fakultasMap = Fakultas::pluck('id', 'kode_fakultas')->toArray();
        
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if ($header) {
                $header = false;
                continue;
            }
            
            // Format: Kode Prodi, Nama Prodi, Kode Fakultas
            if (count($data) >= 3) {
                $kode = trim($data[0] ?? '');
                $nama = trim($data[1] ?? '');
                $kodeFakultas = trim($data[2] ?? '');
                
                if (!empty($kode) && !empty($nama) && isset($fakultasMap[$kodeFakultas])) {
                    Prodi::updateOrCreate(
                        ['kode_prodi' => $kode],
                        [
                            'nama_prodi' => $nama,
                            'fakultas_id' => $fakultasMap[$kodeFakultas],
                        ]
                    );
                    $count++;
                }
            }
        }
        
        fclose($handle);

        return redirect()->route('prodi.index')->with('success', "$count Data Program Studi berhasil diimport/diperbarui.");
    }
    
    public function export()
    {
        $prodis = Prodi::with('fakultas')->orderBy('kode_prodi', 'asc')->get();
        $fileName = 'data_prodi.csv';
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Kode Prodi', 'Nama Program Studi', 'Fakultas');

        $callback = function() use($prodis, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($prodis as $item) {
                $row['Kode Prodi']  = $item->kode_prodi;
                $row['Nama Program Studi']  = $item->nama_prodi;
                $row['Fakultas']    = $item->fakultas ? $item->fakultas->nama_fakultas : '-';

                fputcsv($file, array($row['Kode Prodi'], $row['Nama Program Studi'], $row['Fakultas']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
