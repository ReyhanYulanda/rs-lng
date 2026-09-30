<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Poli') }}
            </h2>

            <div class="d-flex gap-2">
                <a href="{{ route('jenis-poli.index') }}" class="btn btn-outline-primary">Jenis Poli</a>
                <a href="{{ route('poli.create') }}" class="btn btn-primary">Tambah Poli</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="table-responsive card p-4">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="GET" action="{{ route('poli.index') }}" class="row g-2 mb-3">
                    <div class="col-sm-8 col-md-6 col-lg-4">
                        <label for="q" class="visually-hidden">Cari data poli</label>
                        <input type="search" name="q" id="q" class="form-control"
                               value="{{ $search }}" placeholder="Cari pasien, dokter, keluhan, atau jenis poli">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Cari</button>
                        @if($search !== '')
                            <a href="{{ route('poli.index') }}" class="btn btn-outline-secondary">Reset</a>
                        @endif
                    </div>
                </form>

                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pasien</th>
                            <th>Dokter</th>
                            <th>Keluhan</th>
                            <th>Jenis Poli</th>
                            <th>Status</th>
                            <th>Penyakit</th>
                            <th>Catatan Medis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($polis as $poli)
                            <tr>
                                <td>{{ $polis->firstItem() + $loop->index }}</td>
                                <td>{{ $poli->pasien->nama ?? 'ID ' . $poli->id_pasien }}</td>
                                <td>{{ $poli->dokter->nama ?? 'ID ' . $poli->id_dokter }}</td>
                                <td>{{ $poli->keluhan }}</td>
                                <td>{{ $poli->jenisPoli->nama ?? $poli->jenis_poli }}</td>
                                <td>{{ $poli->status }}</td>
                                <td>{{ $poli->penyakit ?: '-' }}</td>
                                <td>{{ $poli->catatan_medis ?: '-' }}</td>
                                <td class="text-nowrap">
                                    <a href="{{ route('poli.edit', $poli->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('poli.destroy', $poli->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data poli ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">Tidak ada data poli.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $polis->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</x-app-layout>