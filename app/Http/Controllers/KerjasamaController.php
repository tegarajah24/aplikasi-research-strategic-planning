<?php

namespace App\Http\Controllers;

use App\Models\Kerjasama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KerjasamaController extends Controller
{
    public function index(Request $request)
    {
        $query = Kerjasama::query();
        
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nomor_surat', 'like', "%{$search}%")
                  ->orWhere('mitra', 'like', "%{$search}%")
                  ->orWhere('program_studi', 'like', "%{$search}%");
        }

        $kerjasamas = $query->latest()->paginate(10);
        return view('kerjasama.index', compact('kerjasamas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'mitra' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'tingkat' => 'required|string|max:255',
            'pic' => 'required|string|max:255',
            'program_studi' => 'required|string|max:255',
            'file_path' => 'nullable|file|mimes:pdf|max:10240', // max 10MB
        ]);

        if ($request->hasFile('file_path')) {
            $validated['file_path'] = $request->file('file_path')->store('kerjasamas', 'public');
        }

        Kerjasama::create($validated);

        return redirect()->route('kerjasama.index')->with('success', 'Data Kerja Sama (MoU) berhasil ditambahkan.');
    }

    public function update(Request $request, Kerjasama $kerjasama)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'mitra' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'tingkat' => 'required|string|max:255',
            'pic' => 'required|string|max:255',
            'program_studi' => 'required|string|max:255',
            'file_path' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        if ($request->hasFile('file_path')) {
            if ($kerjasama->file_path && Storage::disk('public')->exists($kerjasama->file_path)) {
                Storage::disk('public')->delete($kerjasama->file_path);
            }
            $validated['file_path'] = $request->file('file_path')->store('kerjasamas', 'public');
        }

        $kerjasama->update($validated);

        return redirect()->route('kerjasama.index')->with('success', 'Data Kerja Sama (MoU) berhasil diperbarui.');
    }

    public function destroy(Kerjasama $kerjasama)
    {
        if ($kerjasama->file_path && Storage::disk('public')->exists($kerjasama->file_path)) {
            Storage::disk('public')->delete($kerjasama->file_path);
        }
        
        $kerjasama->delete();

        return redirect()->route('kerjasama.index')->with('success', 'Data Kerja Sama (MoU) berhasil dihapus.');
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
            
            // Format yang diharapkan: Nomor Surat, Tanggal, Mitra, Jenis, Tingkat, PIC, Program Studi
            if (count($data) >= 7) {
                Kerjasama::create([
                    'nomor_surat' => $data[0] ?? '',
                    'tanggal' => $data[1] ?? date('Y-m-d'),
                    'mitra' => $data[2] ?? '',
                    'jenis' => $data[3] ?? '',
                    'tingkat' => $data[4] ?? '',
                    'pic' => $data[5] ?? '',
                    'program_studi' => $data[6] ?? '',
                ]);
                $count++;
            }
        }
        
        fclose($handle);

        return redirect()->route('kerjasama.index')->with('success', "$count Data Kerja Sama (MoU) berhasil diimport.");
    }
}
