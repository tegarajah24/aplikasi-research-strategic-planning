<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $query = Buku::query();
        
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('judul', 'like', "%{$search}%")
                  ->orWhere('penulis', 'like', "%{$search}%")
                  ->orWhere('penerbit', 'like', "%{$search}%");
        }

        $bukus = $query->latest()->paginate(10);
        return view('buku.index', compact('bukus'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->canWrite('buku')) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'isbn' => 'nullable|string|max:255',
            'file_path' => 'nullable|file|mimes:pdf|max:10240', // max 10MB
        ]);

        if ($request->hasFile('file_path')) {
            $validated['file_path'] = $request->file('file_path')->store('bukus', 'public');
        }

        $buku = Buku::create($validated);
        ActivityLog::log('Menambahkan buku', 'Buku', $buku->id, $buku->judul);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function update(Request $request, Buku $buku)
    {
        if (!auth()->user()->canWrite('buku')) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'isbn' => 'nullable|string|max:255',
            'file_path' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        if ($request->hasFile('file_path')) {
            if ($buku->file_path && Storage::disk('public')->exists($buku->file_path)) {
                Storage::disk('public')->delete($buku->file_path);
            }
            $validated['file_path'] = $request->file('file_path')->store('bukus', 'public');
        }

        $buku->update($validated);
        ActivityLog::log('Memperbarui buku', 'Buku', $buku->id, $buku->judul);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Buku $buku)
    {
        if (!auth()->user()->canWrite('buku')) {
            abort(403, 'Unauthorized action.');
        }

        if ($buku->file_path && Storage::disk('public')->exists($buku->file_path)) {
            Storage::disk('public')->delete($buku->file_path);
        }
        ActivityLog::log('Menghapus buku', 'Buku', $buku->id, $buku->judul);
        $buku->delete();

        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus.');
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
            
            // Format yang diharapkan: Judul, Penulis, Penerbit, Tahun Terbit, ISBN
            if (count($data) >= 4) {
                Buku::create([
                    'judul' => $data[0] ?? '',
                    'penulis' => $data[1] ?? '',
                    'penerbit' => $data[2] ?? '',
                    'tahun_terbit' => (int)($data[3] ?? date('Y')),
                    'isbn' => $data[4] ?? null,
                ]);
                $count++;
            }
        }
        
        fclose($handle);

        return redirect()->route('buku.index')->with('success', "$count Buku berhasil diimport.");
    }
}
