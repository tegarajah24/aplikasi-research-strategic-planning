<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Renstra;
use Illuminate\Http\Request;

class RenstraController extends Controller
{
    public function index(Request $request)
    {
        $query = Renstra::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('sasaran', 'like', "%{$search}%")
                  ->orWhere('strategi', 'like', "%{$search}%")
                  ->orWhere('program_tahunan', 'like', "%{$search}%");
            });
        }

        $renstras = $query->latest()->paginate(10)->withQueryString();

        $fakultasList = Fakultas::orderBy('kode_fakultas', 'asc')->get();

        $flatRenstra = $renstras->map(function ($r) {
            return [
                'id' => $r->id,
                'tahun' => (int) $r->periode,
                'fakultas' => 'Semua',
                'sasaranKode' => $r->kode,
                'sasaranNama' => $r->sasaran,
                'strategiKode' => 'STR1',
                'strategiNama' => $r->strategi,
                'programKode' => 'PT' . $r->id,
                'programNama' => $r->program_tahunan,
            ];
        })->toArray();

        return view('master-data.renstra.index', compact('renstras', 'flatRenstra', 'fakultasList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode'            => 'nullable|string|max:20',
            'sasaran'         => 'required|string|max:255',
            'strategi'        => 'nullable|string|max:255',
            'program_tahunan' => 'nullable|string|max:255',
            'periode'         => 'nullable|string|max:10',
        ]);

        Renstra::create($validated);
        return redirect()->route('renstra.index')->with('success', 'Data RENSTRA berhasil ditambahkan.');
    }

    public function update(Request $request, Renstra $renstra)
    {
        $validated = $request->validate([
            'kode'            => 'nullable|string|max:20',
            'sasaran'         => 'required|string|max:255',
            'strategi'        => 'nullable|string|max:255',
            'program_tahunan' => 'nullable|string|max:255',
            'periode'         => 'nullable|string|max:10',
        ]);

        $renstra->update($validated);
        return redirect()->route('renstra.index')->with('success', 'Data RENSTRA berhasil diperbarui.');
    }

    public function destroy(Renstra $renstra)
    {
        $renstra->delete();
        return redirect()->route('renstra.index')->with('success', 'Data RENSTRA berhasil dihapus.');
    }
}
