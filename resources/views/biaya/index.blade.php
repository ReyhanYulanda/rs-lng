<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Biaya</h2>
            <a href="{{ route('biaya.create') }}" class="btn btn-primary">Tambah Biaya</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="table-responsive card p-4">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="GET" action="{{ route('biaya.index') }}" class="row g-2 mb-3">
                    <div class="col-sm-8 col-md-6 col-lg-4">
                        <label for="q" class="visually-hidden">Cari biaya</label>
                        <input type="search" name="q" id="q" class="form-control"
                               value="{{ $search }}" placeholder="Cari pasien, status, atau nominal">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Cari</button>
                        @if($search !== '')
                            <a href="{{ route('biaya.index') }}" class="btn btn-outline-secondary">Reset</a>
                        @endif
                    </div>
                </form>

                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pasien</th>
                            <th>Dokter</th>
                            <th>Obat</th>
                            <th>Administrasi</th>
                            <th>Lainnya</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($biayas as $biaya)
                            <tr>
                                <td>{{ $biayas->firstItem() + $loop->index }}</td>
                                <td>{{ $biaya->pasien->nama ?? 'ID ' . $biaya->id_pasien }}</td>
                                <td>Rp {{ number_format($biaya->biaya_dokter, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($biaya->biaya_obat, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($biaya->biaya_administrasi, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($biaya->biaya_lainnya, 0, ',', '.') }}</td>
                                <td class="fw-semibold">Rp {{ number_format($biaya->jumlah, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge {{ $biaya->status === 'Lunas' ? 'text-bg-success' : 'text-bg-warning' }}">
                                        {{ $biaya->status }}
                                    </span>
                                </td>
                                <td class="text-nowrap">
                                    <a href="{{ route('biaya.edit', $biaya->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('biaya.destroy', $biaya->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data biaya ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">Tidak ada data biaya.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $biayas->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</x-app-layout>