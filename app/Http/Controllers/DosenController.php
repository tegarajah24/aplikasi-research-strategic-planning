<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Dosen;
use App\Models\Prodi;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        $query = Dosen::with('prodi');

        if (auth()->user()->isKaprodi()) {
            $query->where('prodi_id', auth()->user()->prodi_id);
        }

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama_dosen', 'like', "%{$search}%")
                  ->orWhere('nidn', 'like', "%{$search}%")
                  ->orWhereHas('prodi', function($q) use ($search) {
                      $q->where('nama_prodi', 'like', "%{$search}%");
                  });
        }

        $dosens = $query->orderBy('nama_dosen', 'asc')->paginate(10);
        $prodis = Prodi::orderBy('nama_prodi', 'asc')->get();
        
        return view('dosen.index', compact('dosens', 'prodis'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->canWrite('dosen')) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'nidn'        => 'nullable|string|max:50|unique:dosens,nidn',
            'nama_dosen'  => 'required|string|max:255',
            'prodi_id'    => 'nullable|exists:prodis,id',
        ]);

        $dosen = Dosen::create($validated);
        ActivityLog::log('Menambahkan dosen', 'Dosen', $dosen->id, $dosen->nama_dosen);

        return redirect()->route('dosen.index')->with('success', 'Data Dosen berhasil ditambahkan.');
    }

    public function update(Request $request, Dosen $dosen)
    {
        if (!auth()->user()->canWrite('dosen')) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'nidn'        => 'nullable|string|max:50|unique:dosens,nidn,' . $dosen->id,
            'nama_dosen'  => 'required|string|max:255',
            'prodi_id'    => 'nullable|exists:prodis,id',
        ]);

        $dosen->update($validated);
        ActivityLog::log('Memperbarui dosen', 'Dosen', $dosen->id, $dosen->nama_dosen);

        return redirect()->route('dosen.index')->with('success', 'Data Dosen berhasil diperbarui.');
    }

    public function destroy(Dosen $dosen)
    {
        if (!auth()->user()->canWrite('dosen')) {
            abort(403, 'Unauthorized action.');
        }

        ActivityLog::log('Menghapus dosen', 'Dosen', $dosen->id, $dosen->nama_dosen);
        $dosen->delete();
        return redirect()->route('dosen.index')->with('success', 'Data Dosen berhasil dihapus.');
    }

    public function import(Request $request)
    {
        if (!auth()->user()->canWrite('dosen')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'file_import' => 'required|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('file_import');
        $handle = fopen($file->getPathname(), "r");
        
        $header = true;
        $count = 0;
        
        // Fetch all prodi to map kode_prodi to id efficiently
        $prodiMap = Prodi::pluck('id', 'kode_prodi')->toArray();
        
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if ($header) {
                $header = false;
                continue;
            }
            
            // Format: NIDN, Nama Dosen, Kode Prodi
            if (count($data) >= 2) {
                $nidn = trim($data[0] ?? '');
                $nama = trim($data[1] ?? '');
                $kodeProdi = trim($data[2] ?? '');
                
                if (!empty($nama)) {
                    $prodiId = isset($prodiMap[$kodeProdi]) ? $prodiMap[$kodeProdi] : null;

                    if (!empty($nidn)) {
                        Dosen::updateOrCreate(
                            ['nidn' => $nidn],
                            [
                                'nama_dosen' => $nama,
                                'prodi_id' => $prodiId,
                            ]
                        );
                    } else {
                        Dosen::create([
                            'nama_dosen' => $nama,
                            'prodi_id' => $prodiId,
                        ]);
                    }
                    $count++;
                }
            }
        }
        
        fclose($handle);

        return redirect()->route('dosen.index')->with('success', "Data Dosen berhasil diimport/diperbarui.");
    }
}
