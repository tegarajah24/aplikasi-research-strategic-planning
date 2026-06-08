<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    public function index(Request $request)
    {
        $query = Artikel::query();
        
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('judul', 'like', "%{$search}%")
                  ->orWhere('penulis', 'like', "%{$search}%")
                  ->orWhere('penerbit', 'like', "%{$search}%");
        }

        $artikels = $query->latest()->paginate(10);
        $dosens = Dosen::orderBy('nama_dosen')->get();
        return view('artikel.index', compact('artikels', 'dosens'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'penerbit' => 'required|string|max:255',
            'doi' => 'nullable|string|max:255',
            'file_path' => 'nullable|file|mimes:pdf|max:10240', // max 10MB
        ]);

        if ($request->hasFile('file_path')) {
            $validated['file_path'] = $request->file('file_path')->store('artikels', 'public');
        }

        Artikel::create($validated);

        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function update(Request $request, Artikel $artikel)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'penerbit' => 'required|string|max:255',
            'doi' => 'nullable|string|max:255',
            'file_path' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        if ($request->hasFile('file_path')) {
            if ($artikel->file_path && Storage::disk('public')->exists($artikel->file_path)) {
                Storage::disk('public')->delete($artikel->file_path);
            }
            $validated['file_path'] = $request->file('file_path')->store('artikels', 'public');
        }

        $artikel->update($validated);

        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Artikel $artikel)
    {
        if ($artikel->file_path && Storage::disk('public')->exists($artikel->file_path)) {
            Storage::disk('public')->delete($artikel->file_path);
        }
        
        $artikel->delete();

        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil dihapus.');
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
            
            // Format yang diharapkan: Judul, Penulis, Tahun, Penerbit, DOI
            if (count($data) >= 4) {
                Artikel::create([
                    'judul' => $data[0] ?? '',
                    'penulis' => $data[1] ?? '',
                    'tahun' => (int)($data[2] ?? date('Y')),
                    'penerbit' => $data[3] ?? '',
                    'doi' => $data[4] ?? null,
                ]);
                $count++;
            }
        }
        
        fclose($handle);

        return redirect()->route('artikel.index')->with('success', "$count Artikel berhasil diimport.");
    }
}
