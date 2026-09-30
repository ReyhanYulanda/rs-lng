<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = trim($request->query('q', ''));

        $polis = Poli::with(['pasien', 'dokter', 'jenisPoli'])
            ->when($search !== '', function ($query) use ($search) {
                $like = "%{$search}%";

                $query->where(function ($query) use ($like) {
                    $query->where('keluhan', 'like', $like)
                        ->orWhere('jenis_poli', 'like', $like)
                        ->orWhere('status', 'like', $like)
                        ->orWhere('penyakit', 'like', $like)
                        ->orWhere('catatan_medis', 'like', $like)
                        ->orWhereHas('pasien', function ($query) use ($like) {
                            $query->where('nama', 'like', $like)
                                ->orWhere('no_rekam_medis', 'like', $like);
                        })
                        ->orWhereHas('dokter', function ($query) use ($like) {
                            $query->where('nama', 'like', $like)
                                ->orWhere('nip', 'like', $like);
                        })
                        ->orWhereHas('jenisPoli', function ($query) use ($like) {
                            $query->where('nama', 'like', $like);
                        });
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('poli.index', compact('polis', 'search'));
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
            'id_pasien' => 'required|exists:pasiens,id',
            'id_dokter' => 'required|exists:dokters,id',
            'keluhan' => 'required|string|max:255',
            'jenis_poli' => 'required|exists:jenis_polis,id',
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
            'id_pasien' => 'required|exists:pasiens,id',
            'id_dokter' => 'required|exists:dokters,id',
            'keluhan' => 'required|string|max:255',
            'jenis_poli' => 'required|exists:jenis_polis,id',
            'status' => 'required|string|max:255',
            'penyakit' => 'nullable|string|max:255',
            'catatan_medis' => 'nullable|string|max:255',
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
