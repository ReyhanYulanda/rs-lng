<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Pendaftaran</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card mt-4">
                <div class="card-body p-4">
                    <dl class="row mb-4">
                        <dt class="col-sm-3">Pasien</dt>
                        <dd class="col-sm-9">{{ $pendaftaran->pasien->nama ?? 'ID ' . $pendaftaran->id_pasien }}</dd>
                        <dt class="col-sm-3">Dokter</dt>
                        <dd class="col-sm-9">{{ $pendaftaran->dokter->nama ?? 'ID ' . $pendaftaran->id_dokter }}</dd>
                        <dt class="col-sm-3">Keluhan</dt>
                        <dd class="col-sm-9">{{ $pendaftaran->keluhan }}</dd>
                        <dt class="col-sm-3">Jenis Poli</dt>
                        <dd class="col-sm-9">{{ $pendaftaran->jenisPoli->nama ?? $pendaftaran->jenis_poli }}</dd>
                        <dt class="col-sm-3">Status</dt>
                        <dd class="col-sm-9">{{ $pendaftaran->status }}</dd>
                        <dt class="col-sm-3">Penyakit</dt>
                        <dd class="col-sm-9">{{ $pendaftaran->penyakit ?: '-' }}</dd>
                        <dt class="col-sm-3">Catatan Medis</dt>
                        <dd class="col-sm-9">{{ $pendaftaran->catatan_medis ?: '-' }}</dd>
                    </dl>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('pendaftaran.index') }}" class="btn btn-light">Kembali</a>
                        <a href="{{ route('pendaftaran.edit', $pendaftaran->id) }}" class="btn btn-primary">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>