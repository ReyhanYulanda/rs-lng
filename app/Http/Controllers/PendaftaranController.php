<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\JenisPoli;
use App\Models\Pasien;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->query('q', ''));

        $pendaftarans = Pendaftaran::with(['pasien', 'dokter', 'jenisPoli'])
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

        return view('pendaftaran.index', compact('pendaftarans', 'search'));
    }

    public function create()
    {
        $pasiens = Pasien::all();
        $dokters = Dokter::all();
        $jenisPolis = JenisPoli::all();

        return view('pendaftaran.create', compact('pasiens', 'dokters', 'jenisPolis'));
    }

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

        Pendaftaran::create($validated);

        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil ditambahkan.');
    }

    public function show(Pendaftaran $pendaftaran)
    {
        return view('pendaftaran.show', compact('pendaftaran'));
    }

    public function edit(Pendaftaran $pendaftaran)
    {
        $pasiens = Pasien::all();
        $dokters = Dokter::all();
        $jenisPolis = JenisPoli::all();

        return view('pendaftaran.edit', compact('pendaftaran', 'pasiens', 'dokters', 'jenisPolis'));
    }

    public function update(Request $request, Pendaftaran $pendaftaran)
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

        $pendaftaran->update($validated);

        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil diperbarui.');
    }

    public function destroy(Pendaftaran $pendaftaran)
    {
        $pendaftaran->delete();

        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil dihapus.');
    }
}