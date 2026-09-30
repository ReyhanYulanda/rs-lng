<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Biaya</h2>
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

                    <form action="{{ route('biaya.store') }}" method="POST" class="mt-4">
                        @csrf
                        <div class="mb-4">
                            <label for="id_pasien" class="form-label">Pasien</label>
                            <select name="id_pasien" id="id_pasien" class="form-select" required>
                                <option value="">Pilih pasien</option>
                                @foreach($pasien as $p)
                                    <option value="{{ $p->id }}" @selected(old('id_pasien') == $p->id)>
                                        {{ $p->nama }} - {{ $p->no_rekam_medis }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="biaya_dokter" class="form-label">Biaya Dokter</label>
                                <input type="number" name="biaya_dokter" id="biaya_dokter" class="form-control biaya-komponen" min="0" step="1" value="{{ old('biaya_dokter', 0) }}" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="biaya_obat" class="form-label">Biaya Obat</label>
                                <input type="number" name="biaya_obat" id="biaya_obat" class="form-control biaya-komponen" min="0" step="1" value="{{ old('biaya_obat', 0) }}" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="biaya_administrasi" class="form-label">Biaya Administrasi</label>
                                <input type="number" name="biaya_administrasi" id="biaya_administrasi" class="form-control biaya-komponen" min="0" step="1" value="{{ old('biaya_administrasi', 0) }}" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="biaya_lainnya" class="form-label">Biaya Lainnya</label>
                                <input type="number" name="biaya_lainnya" id="biaya_lainnya" class="form-control biaya-komponen" min="0" step="1" value="{{ old('biaya_lainnya', 0) }}" required>
                            </div>
                        </div>
                        <div class="row align-items-end">
                            <div class="col-md-6 mb-4">
                                <label for="jumlah" class="form-label">Total Biaya</label>
                                <input type="number" name="jumlah" id="jumlah" class="form-control" value="0" readonly>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-select" required>
                                    <option value="Belum Lunas" @selected(old('status', 'Belum Lunas') === 'Belum Lunas')>Belum Lunas</option>
                                    <option value="Lunas" @selected(old('status') === 'Lunas')>Lunas</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('biaya.index') }}" class="btn btn-light">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const biayaKomponen = document.querySelectorAll('.biaya-komponen');
        const jumlah = document.getElementById('jumlah');

        function hitungJumlah() {
            jumlah.value = Array.from(biayaKomponen)
                .reduce((total, input) => total + Number(input.value || 0), 0);
        }

        biayaKomponen.forEach((input) => input.addEventListener('input', hitungJumlah));
        hitungJumlah();
    </script>
</x-app-layout>