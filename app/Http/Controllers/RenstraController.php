<?php

namespace App\Http\Controllers;

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

        return view('master-data.renstra.index', compact('renstras', 'flatRenstra'));
    }
}
