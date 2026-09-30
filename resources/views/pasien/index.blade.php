<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Pasien') }}
            </h2>

            <button type="button"
                    onclick="window.location='{{ route('pasien.create') }}'"
                    class="btn btn-primary">
                Tambah Pasien
            </button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="table-responsive card p-4">
            <form method="GET" action="{{ route('pasien.index') }}" class="row g-2 mb-3">
                <div class="col-sm-8 col-md-6 col-lg-4">
                    <label for="q" class="visually-hidden">Cari pasien</label>
                    <input type="search" name="q" id="q" class="form-control"
                           value="{{ $search }}" placeholder="Cari nama atau nomor rekam medis">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Cari</button>
                    @if($search !== '')
                        <a href="{{ route('pasien.index') }}" class="btn btn-outline-secondary">Reset</a>
                    @endif
                </div>
            </form>

            <table class="table table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>No Rekam Medis</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($pasiens as $pasien)
                    <tr>
                        <td>{{ $pasiens->firstItem() + $loop->index }}</td>
                        <td>{{ $pasien->nama }}</td>
                        <td>{{ $pasien->no_rekam_medis }}</td>
                        <td>{{ \Carbon\Carbon::parse($pasien->tanggal_lahir)->format('d-m-Y') }}</td>
                        <td>{{ $pasien->alamat }}</td>
                        <td>
                            <button type="button" onclick="window.location='{{ route('pasien.edit', $pasien->id) }}'" class="btn btn-sm btn-warning">Edit</button>
                            <form action="{{ route('pasien.destroy', $pasien->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data pasien ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Tidak ada data pasien.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            {{ $pasiens->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</x-app-layout>