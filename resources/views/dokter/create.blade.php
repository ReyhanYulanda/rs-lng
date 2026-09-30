<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Dokter
        </h2>
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

                    <form action="{{ route('dokter.store') }}" method="POST" class="mt-4">
                        @csrf
                        <div class="mb-4">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" id="nip" name="nip" value="{{ old('nip') }}" class="form-control" maxlength="255" required>
                        </div>
                        <div class="mb-4">
                            <label for="nama" class="form-label">Nama Dokter</label>
                            <input type="text" id="nama" name="nama" value="{{ old('nama') }}" class="form-control" maxlength="255" required>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('dokter.index') }}" class="btn btn-light">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>