<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $polis = Poli::all();
        return view('poli.index', compact('polis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pasiens = \App\Models\Pasien::all();
        $dokters = \App\Models\Dokter::all();
        $jenisPolis = \App\Models\JenisPoli::all();

        return view('poli.create', compact('pasiens', 'dokters', 'jenisPolis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pasien' => 'required|integer',
            'id_dokter' => 'required|integer',
            'keluhan' => 'required|string|max:255',
            'jenis_poli' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'penyakit' => 'nullable|string|max:255',
            'catatan_medis' => 'nullable|string|max:255',
        ]);

        Poli::create($validated);

        return redirect()->route('poli.index')->with('success', 'Poli berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Poli $poli)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Poli $poli)
    {
        $pasiens = \App\Models\Pasien::all();
        $dokters = \App\Models\Dokter::all();
        $jenisPolis = \App\Models\JenisPoli::all();

        return view('poli.edit', compact('poli', 'pasiens', 'dokters', 'jenisPolis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Poli $poli)
    {
        $validated = $request->validate([
            'id_pasien' => 'required|integer',
            'id_dokter' => 'required|integer',
            'keluhan' => 'required|string|max:255',
            'jenis_poli' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'penyakit' => 'required|string|max:255',
            'catatan_medis' => 'required|string|max:255',
        ]);

        $poli->update($validated);

        return redirect()->route('poli.index')->with('success', 'Poli berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Poli $poli)
    {
        $poli->delete();
        return redirect()->route('poli.index')->with('success', 'Poli berhasil dihapus.');
    }
}
