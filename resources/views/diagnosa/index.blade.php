<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Diagnosa</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="table-responsive card p-4">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="GET" action="{{ route('diagnosa.index') }}" class="row g-2 mb-3 align-items-end">
                    <div class="col-sm-8 col-md-5">
                        <label for="q" class="visually-hidden">Cari diagnosa</label>
                        <input type="search" name="q" id="q" class="form-control"
                               value="{{ $search }}" placeholder="Cari No. RM, pasien, keluhan, atau penyakit">
                    </div>
                    <div class="col-sm-8 col-md-4">
                        <label for="dokter_id" class="form-label">Dokter</label>
                        <select name="dokter_id" id="dokter_id" class="form-select">
                            <option value="">Semua Dokter</option>
                            @foreach($dokters as $dokter)
                                <option value="{{ $dokter->id }}" @selected((string) $dokterId === (string) $dokter->id)>
                                    {{ $dokter->nama }} - {{ $dokter->nip }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        @if($search !== '' || $dokterId !== '')
                            <a href="{{ route('diagnosa.index') }}" class="btn btn-outline-secondary">Reset</a>
                        @endif
                    </div>
                </form>

                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No. RM</th>
                            <th>Pasien</th>
                            <th>Dokter</th>
                            <th>Keluhan</th>
                            <th>Penyakit</th>
                            <th>Catatan Medis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($diagnosas as $diagnosa)
                            <tr>
                                <td>{{ $diagnosas->firstItem() + $loop->index }}</td>
                                <td>{{ $diagnosa->pasien->no_rekam_medis ?? 'ID ' . $diagnosa->id_pasien }}</td>
                                <td>{{ $diagnosa->pasien->nama ?? 'ID ' . $diagnosa->id_pasien }}</td>
                                <td>{{ $diagnosa->dokter->nama ?? 'ID ' . $diagnosa->id_dokter }}</td>
                                <td>{{ $diagnosa->keluhan }}</td>
                                <td>{{ $diagnosa->penyakit ?: '-' }}</td>
                                <td>{{ $diagnosa->catatan_medis ?: '-' }}</td>
                                <td>
                                    <a href="{{ route('diagnosa.edit', $diagnosa->id) }}" class="btn btn-sm btn-primary">Lihat</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">Tidak ada data pendaftaran untuk diagnosa.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $diagnosas->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</x-app-layout>