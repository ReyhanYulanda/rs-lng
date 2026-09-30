<?php

namespace App\Http\Controllers;

use App\Models\JenisPoli;
use Illuminate\Http\Request;

class JenisPoliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenisPolis = JenisPoli::all();
        return view('jenis-poli.index', compact('jenisPolis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jenis-poli.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        JenisPoli::create($validated);

        return redirect()->route('jenis-poli.index')->with('success', 'Jenis Poli berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisPoli $jenisPoli)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisPoli $jenisPoli)
    {
        return view('jenis-poli.edit', compact('jenisPoli'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JenisPoli $jenisPoli)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $jenisPoli->update($validated);

        return redirect()->route('jenis-poli.index')->with('success', 'Jenis Poli berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisPoli $jenisPoli)
    {
        $jenisPoli->delete();
        return redirect()->route('jenis-poli.index')->with('success', 'Jenis Poli berhasil dihapus.');
    }
}
