<?php

namespace App\Http\Controllers;

use App\Models\Biaya;
use App\Models\Pasien;
use Illuminate\Http\Request;

class BiayaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = trim($request->query('q', ''));

        $biayas = Biaya::with('pasien')
            ->when($search !== '', function ($query) use ($search) {
                $like = "%{$search}%";

                $query->where(function ($query) use ($like) {
                    $query->where('status', 'like', $like)
                        ->orWhere('biaya_dokter', 'like', $like)
                        ->orWhere('biaya_obat', 'like', $like)
                        ->orWhere('biaya_administrasi', 'like', $like)
                        ->orWhere('biaya_lainnya', 'like', $like)
                        ->orWhere('jumlah', 'like', $like)
                        ->orWhereHas('pasien', function ($query) use ($like) {
                            $query->where('nama', 'like', $like)
                                ->orWhere('no_rekam_medis', 'like', $like);
                        });
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('biaya.index', compact('biayas', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pasien = Pasien::all();
        return view('biaya.create', compact('pasien'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pasien' => ['required', 'exists:pasiens,id'],
            'biaya_dokter' => ['required', 'integer', 'min:0'],
            'biaya_obat' => ['required', 'integer', 'min:0'],
            'biaya_administrasi' => ['required', 'integer', 'min:0'],
            'biaya_lainnya' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'in:Lunas,Belum Lunas'],
        ]);

        $validated['jumlah'] = array_sum([
            $validated['biaya_dokter'],
            $validated['biaya_obat'],
            $validated['biaya_administrasi'],
            $validated['biaya_lainnya'],
        ]);

        Biaya::create($validated);
        return redirect()->route('biaya.index')->with('success', 'Biaya berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Biaya $biaya)
    {
        return view('biaya.show', compact('biaya'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Biaya $biaya)
    {
        $pasien = Pasien::all();
        return view('biaya.edit', compact('biaya', 'pasien'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Biaya $biaya)
    {
        $validated = $request->validate([
            'id_pasien' => ['required', 'exists:pasiens,id'],
            'biaya_dokter' => ['required', 'integer', 'min:0'],
            'biaya_obat' => ['required', 'integer', 'min:0'],
            'biaya_administrasi' => ['required', 'integer', 'min:0'],
            'biaya_lainnya' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'in:Lunas,Belum Lunas'],
        ]);

        $validated['jumlah'] = array_sum([
            $validated['biaya_dokter'],
            $validated['biaya_obat'],
            $validated['biaya_administrasi'],
            $validated['biaya_lainnya'],
        ]);

        $biaya->update($validated);
        return redirect()->route('biaya.index')->with('success', 'Biaya berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Biaya $biaya)
    {
        $biaya->delete();
        return redirect()->route('biaya.index')->with('success', 'Biaya berhasil dihapus.');
    }
}
