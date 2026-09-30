<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Data Poli</h2>
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

                    <form action="{{ route('poli.store') }}" method="POST" class="mt-4">
                        @csrf
                        <div class="mb-4">
                            <label for="id_pasien" class="form-label">Pasien</label>
                            <select name="id_pasien" id="id_pasien" class="form-select" required>
                                <option value="">Pilih pasien</option>
                                @foreach ($pasiens as $pasien)
                                    <option value="{{ $pasien->id }}" @selected(old('id_pasien') == $pasien->id)>
                                        {{ $pasien->nama }} - {{ $pasien->no_rekam_medis }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="id_dokter" class="form-label">Dokter</label>
                            <select name="id_dokter" id="id_dokter" class="form-select" required>
                                <option value="">Pilih dokter</option>
                                @foreach ($dokters as $dokter)
                                    <option value="{{ $dokter->id }}" @selected(old('id_dokter') == $dokter->id)>
                                        {{ $dokter->nama }} - {{ $dokter->nip }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="keluhan" class="form-label">Keluhan</label>
                            <input type="text" name="keluhan" id="keluhan" value="{{ old('keluhan') }}" class="form-control" maxlength="255" required>
                        </div>
                        <div class="mb-4">
                            <label for="jenis_poli" class="form-label">Jenis Poli</label>
                            <select name="jenis_poli" id="jenis_poli" class="form-select" required>
                                <option value="">Pilih jenis poli</option>
                                @foreach ($jenisPolis as $jenisPoli)
                                    <option value="{{ $jenisPoli->id }}" @selected(old('jenis_poli') == $jenisPoli->id)>
                                        {{ $jenisPoli->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="status" class="form-label">Status</label>
                            <input type="text" name="status" id="status" value="{{ old('status') }}" class="form-control" maxlength="255" required>
                        </div>
                        <div class="mb-4">
                            <label for="penyakit" class="form-label">Penyakit <span class="text-muted">(opsional)</span></label>
                            <input type="text" name="penyakit" id="penyakit" value="{{ old('penyakit') }}" class="form-control" maxlength="255">
                        </div>
                        <div class="mb-4">
                            <label for="catatan_medis" class="form-label">Catatan Medis <span class="text-muted">(opsional)</span></label>
                            <textarea name="catatan_medis" id="catatan_medis" rows="3" class="form-control" maxlength="255">{{ old('catatan_medis') }}</textarea>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('poli.index') }}" class="btn btn-light">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>