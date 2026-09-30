<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Dokter') }}
            </h2>

            <button type="button"
                    onclick="window.location='{{ route('dokter.create') }}'"
                    class="btn btn-primary">
                Tambah Dokter
            </button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="table-responsive card p-4">
                <form method="GET" action="{{ route('dokter.index') }}" class="row g-2 mb-3">
                    <div class="col-sm-8 col-md-6 col-lg-4">
                        <label for="q" class="visually-hidden">Cari dokter</label>
                        <input type="search" name="q" id="q" class="form-control"
                               value="{{ $search }}" placeholder="Cari nama atau NIP">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Cari</button>
                        @if($search !== '')
                            <a href="{{ route('dokter.index') }}" class="btn btn-outline-secondary">Reset</a>
                        @endif
                    </div>
                </form>

                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dokters as $dokter)
                            <tr>
                                <td>{{ $dokters->firstItem() + $loop->index }}</td>
                                <td>{{ $dokter->nip }}</td>
                                <td>{{ $dokter->nama }}</td>
                                <td>
                                    <a href="{{ route('dokter.edit', $dokter->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('dokter.destroy', $dokter->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data dokter ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Tidak ada data dokter.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $dokters->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</x-app-layout>