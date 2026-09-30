<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Pendaftaran') }}
            </h2>

            <div class="d-flex gap-2">
                <a href="{{ route('jenis-poli.index') }}" class="btn btn-outline-primary">Jenis Poli</a>
                <a href="{{ route('pendaftaran.create') }}" class="btn btn-primary">Tambah Pendaftaran</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="table-responsive card p-4">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="GET" action="{{ route('pendaftaran.index') }}" class="row g-2 mb-3">
                    <div class="col-sm-8 col-md-6 col-lg-4">
                        <label for="q" class="visually-hidden">Cari pendaftaran</label>
                        <input type="search" name="q" id="q" class="form-control"
                               value="{{ $search }}" placeholder="Cari pasien, dokter, keluhan, atau jenis poli">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Cari</button>
                        @if($search !== '')
                            <a href="{{ route('pendaftaran.index') }}" class="btn btn-outline-secondary">Reset</a>
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
                            <th>Jenis Poli</th>
                            <th>Status</th>
                            <th>Penyakit</th>
                            <th>Catatan Medis</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendaftarans as $pendaftaran)
                            <tr>
                                <td>{{ $pendaftarans->firstItem() + $loop->index }}</td>
                                <td>{{ $pendaftaran->pasien->no_rekam_medis ?? 'ID ' . $pendaftaran->id_pasien }}</td>
                                <td>{{ $pendaftaran->pasien->nama ?? 'ID ' . $pendaftaran->id_pasien }}</td>
                                <td>{{ $pendaftaran->dokter->nama ?? 'ID ' . $pendaftaran->id_dokter }}</td>
                                <td>{{ $pendaftaran->keluhan }}</td>
                                <td>{{ $pendaftaran->jenisPoli->nama ?? $pendaftaran->jenis_poli }}</td>
                                <td>{{ $pendaftaran->status }}</td>
                                <td>{{ $pendaftaran->penyakit ?: '-' }}</td>
                                <td>{{ $pendaftaran->catatan_medis ?: '-' }}</td>
                                <td>{{ $pendaftaran->updated_at?->format('H:i d-m-Y') ?? '-' }}</td>
                                <td class="text-nowrap">
                                    <a href="{{ route('pendaftaran.edit', $pendaftaran->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('pendaftaran.destroy', $pendaftaran->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pendaftaran ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center text-muted py-4">Tidak ada data pendaftaran.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $pendaftarans->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</x-app-layout>