<?php

namespace App\Http\Controllers;

use App\Models\Pengabmas;
use Illuminate\Http\Request;

class PengabmasController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengabmas::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_kegiatan', 'like', "%{$search}%")
                  ->orWhere('ketua', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        $pengabmas = $query->latest()->paginate(10)->withQueryString();

        return view('pengabmas.index', compact('pengabmas'));
    }
}
