<?php

namespace App\Http\Controllers;

use App\Models\Hki;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HkiController extends Controller
{
    public function index(Request $request)
    {
        $query = Hki::query();
        
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('judul', 'like', "%{$search}%")
                  ->orWhere('pencipta', 'like', "%{$search}%")
                  ->orWhere('jenis_hki', 'like', "%{$search}%");
        }

        $hkis = $query->latest()->paginate(10);
        return view('hki.index', compact('hkis'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->canWrite('hki')) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'pencipta' => 'required|string|max:255',
            'jenis_hki' => 'required|string|max:255',
            'nomor_pendaftaran' => 'nullable|string|max:255',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'file_path' => 'nullable|file|mimes:pdf|max:10240', // max 10MB
        ]);

        if ($request->hasFile('file_path')) {
            $validated['file_path'] = $request->file('file_path')->store('hkis', 'public');
        }

        Hki::create($validated);

        return redirect()->route('hki.index')->with('success', 'Data HKI berhasil ditambahkan.');
    }

    public function update(Request $request, Hki $hki)
    {
        if (!auth()->user()->canWrite('hki')) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'pencipta' => 'required|string|max:255',
            'jenis_hki' => 'required|string|max:255',
            'nomor_pendaftaran' => 'nullable|string|max:255',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'file_path' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        if ($request->hasFile('file_path')) {
            if ($hki->file_path && Storage::disk('public')->exists($hki->file_path)) {
                Storage::disk('public')->delete($hki->file_path);
            }
            $validated['file_path'] = $request->file('file_path')->store('hkis', 'public');
        }

        $hki->update($validated);

        return redirect()->route('hki.index')->with('success', 'Data HKI berhasil diperbarui.');
    }

    public function destroy(Hki $hki)
    {
        if (!auth()->user()->canWrite('hki')) {
            abort(403, 'Unauthorized action.');
        }

        if ($hki->file_path && Storage::disk('public')->exists($hki->file_path)) {
            Storage::disk('public')->delete($hki->file_path);
        }
        
        $hki->delete();

        return redirect()->route('hki.index')->with('success', 'Data HKI berhasil dihapus.');
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
            
            // Format yang diharapkan: Judul, Pencipta, Jenis HKI, Nomor Pendaftaran, Tahun
            if (count($data) >= 5) {
                Hki::create([
                    'judul' => $data[0] ?? '',
                    'pencipta' => $data[1] ?? '',
                    'jenis_hki' => $data[2] ?? '',
                    'nomor_pendaftaran' => $data[3] ?? null,
                    'tahun' => (int)($data[4] ?? date('Y')),
                ]);
                $count++;
            }
        }
        
        fclose($handle);

        return redirect()->route('hki.index')->with('success', "$count Data HKI berhasil diimport.");
    }
}
