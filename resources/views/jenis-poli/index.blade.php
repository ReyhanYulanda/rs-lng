<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Jenis Poli') }}
            </h2>

            <button type="button"
                    onclick="window.location='{{ route('jenis-poli.create') }}'"
                    class="btn btn-primary">
                Tambah Jenis Poli
            </button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="table-responsive card p-4">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="GET" action="{{ route('jenis-poli.index') }}" class="row g-2 mb-3">
                    <div class="col-sm-8 col-md-6 col-lg-4">
                        <label for="q" class="visually-hidden">Cari jenis poli</label>
                        <input type="search" name="q" id="q" class="form-control"
                               value="{{ $search }}" placeholder="Cari nama jenis poli">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Cari</button>
                        @if($search !== '')
                            <a href="{{ route('jenis-poli.index') }}" class="btn btn-outline-secondary">Reset</a>
                        @endif
                    </div>
                </form>

                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Jenis Poli</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jenisPolis as $jenisPoli)
                            <tr>
                                <td>{{ $jenisPolis->firstItem() + $loop->index }}</td>
                                <td>{{ $jenisPoli->nama }}</td>
                                <td>
                                    <a href="{{ route('jenis-poli.edit', $jenisPoli->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('jenis-poli.destroy', $jenisPoli->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus jenis poli ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">Tidak ada data jenis poli.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $jenisPolis->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</x-app-layout>