<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Http\Requests\StoreBidangRequest;
use App\Http\Requests\UpdateBidangRequest;
use Illuminate\Http\Request;

class BidangController extends Controller
{
    public function index(Request $request)
    {
        $query = Bidang::withCount('programs');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_bidang', 'like', "%{$search}%")
                  ->orWhere('kode_bidang', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $bidangs = $query->latest()->paginate(10)->withQueryString();

        $totalBidang   = Bidang::count();
        $totalProgram  = \App\Models\Program::count();
        $totalKegiatan = \App\Models\Kegiatan::count();

        $bidangList = Bidang::withCount('programs')->get();

        return view('master-data.bidang.index', compact(
            'bidangs', 'totalBidang', 'totalProgram', 'totalKegiatan', 'bidangList'
        ));
    }

    public function store(StoreBidangRequest $request)
    {
        Bidang::create($request->validated());
        return redirect()->route('bidang.index')->with('success', 'Bidang berhasil ditambahkan.');
    }

    public function update(UpdateBidangRequest $request, Bidang $bidang)
    {
        $bidang->update($request->validated());
        return redirect()->route('bidang.index')->with('success', 'Bidang berhasil diperbarui.');
    }

    public function destroy(Bidang $bidang)
    {
        $bidang->delete();
        return redirect()->route('bidang.index')->with('success', 'Bidang berhasil dihapus.');
    }
}
