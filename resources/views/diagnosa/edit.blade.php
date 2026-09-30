<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Diagnosa</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card mt-4">
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">No. RM</label>
                            <input type="text" class="form-control" value="{{ $pendaftaran->pasien->no_rekam_medis ?? 'ID ' . $pendaftaran->id_pasien }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pasien</label>
                            <input type="text" class="form-control" value="{{ $pendaftaran->pasien->nama ?? 'ID ' . $pendaftaran->id_pasien }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Dokter</label>
                            <input type="text" class="form-control" value="{{ $pendaftaran->dokter->nama ?? 'ID ' . $pendaftaran->id_dokter }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Keluhan</label>
                            <input type="text" class="form-control" value="{{ $pendaftaran->keluhan }}" readonly>
                        </div>
                    </div>

                    <form action="{{ route('diagnosa.update', $pendaftaran->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="penyakit" class="form-label">Penyakit</label>
                            <input type="text" name="penyakit" id="penyakit" value="{{ old('penyakit', $pendaftaran->penyakit) }}" class="form-control" maxlength="255">
                        </div>
                        <div class="mb-4">
                            <label for="catatan_medis" class="form-label">Catatan Medis</label>
                            <textarea name="catatan_medis" id="catatan_medis" rows="4" class="form-control" maxlength="255">{{ old('catatan_medis', $pendaftaran->catatan_medis) }}</textarea>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('diagnosa.index') }}" class="btn btn-light">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Diagnosa</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>