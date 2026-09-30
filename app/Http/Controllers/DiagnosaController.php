<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class DiagnosaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = trim($request->query('q', ''));
        $dokterId = $request->query('dokter_id', '');
        $dokters = Dokter::orderBy('nama')->get();

        $diagnosas = Pendaftaran::with(['pasien', 'dokter'])
            ->when($dokterId !== '', function ($query) use ($dokterId) {
                $query->where('id_dokter', $dokterId);
            })
            ->when($search !== '', function ($query) use ($search) {
                $like = "%{$search}%";

                $query->where(function ($query) use ($like) {
                    $query->where('keluhan', 'like', $like)
                        ->orWhere('penyakit', 'like', $like)
                        ->orWhere('catatan_medis', 'like', $like)
                        ->orWhereHas('pasien', function ($query) use ($like) {
                            $query->where('nama', 'like', $like)
                                ->orWhere('no_rekam_medis', 'like', $like);
                        });
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('diagnosa.index', compact('diagnosas', 'dokters', 'dokterId', 'search'));
    }

    /**
     * Display the specified resource.
     */
    public function edit(Pendaftaran $pendaftaran)
    {
        $pendaftaran->load(['pasien', 'dokter']);

        return view('diagnosa.edit', compact('pendaftaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        $validated = $request->validate([
            'penyakit' => ['nullable', 'string', 'max:255'],
            'catatan_medis' => ['nullable', 'string', 'max:255'],
        ]);

        $pendaftaran->update($validated);

        return redirect()->route('diagnosa.index')->with('success', 'Diagnosa berhasil diperbarui.');
    }
}
