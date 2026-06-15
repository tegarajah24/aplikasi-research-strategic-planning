<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->with('prodi')->latest()->paginate(10)->withQueryString();

        $prodiList = Prodi::orderBy('nama_prodi')->get();

        return view('pengguna.index', compact('users', 'prodiList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:8',
            'role'     => 'required|in:Admin,Dekan,LPPM,Kaprodi',
            'status'   => 'required|in:Aktif,Nonaktif',
            'prodi_id' => 'nullable|exists:prodis,id',
        ]);

        if ($validated['role'] === 'Kaprodi' && !$validated['prodi_id']) {
            return back()->withErrors(['prodi_id' => 'Prodi wajib dipilih untuk role Kaprodi.'])->withInput();
        }

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);
        ActivityLog::log('Menambahkan pengguna', 'Pengguna', $user->id, $user->name);

        return redirect()->route('pengguna')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role'     => 'required|in:Admin,Dekan,LPPM,Kaprodi',
            'status'   => 'required|in:Aktif,Nonaktif',
            'prodi_id' => 'nullable|exists:prodis,id',
        ]);

        if ($validated['role'] === 'Kaprodi' && !$validated['prodi_id']) {
            return back()->withErrors(['prodi_id' => 'Prodi wajib dipilih untuk role Kaprodi.'])->withInput();
        }

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);
        ActivityLog::log('Memperbarui pengguna', 'Pengguna', $user->id, $user->name);

        return redirect()->route('pengguna')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('pengguna')->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        ActivityLog::log('Menghapus pengguna', 'Pengguna', $user->id, $user->name);
        $user->delete();

        return redirect()->route('pengguna')->with('success', 'Pengguna berhasil dihapus.');
    }
}
