<?php

namespace App\Http\Controllers;

use App\Models\Penelitian;
use Illuminate\Http\Request;

class PenelitianController extends Controller
{
    public function index(Request $request)
    {
        $query = Penelitian::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('ketua', 'like', "%{$search}%")
                  ->orWhere('tahun', 'like', "%{$search}%");
            });
        }

        $penelitians = $query->latest()->paginate(10)->withQueryString();

        return view('penelitian.index', compact('penelitians'));
    }
}
