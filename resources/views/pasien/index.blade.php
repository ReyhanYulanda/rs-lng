<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasien</title>
</head>
<body>
    <main class="container pt-4">
        <div class="d-flex justify-content-between align-items-sm-center gap-4">
            <h1>Daftar Pasien</h1>
            <button onclick="window.location='{{ route('pasien.create') }}'" class="btn btn-primary">Tambah Pasien</button>
        </div>
        <div class="card border-0 shadow-sm mt-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nama</th>
                            <th>No Rekam Medis</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($pasiens as $pasien)
                        <tr>
                            <td>{{ $pasien->nama }}</td>
                            <td>{{ $pasien->no_rekam_medis }}</td>
                            <td>{{ $pasien->tanggal_lahir }}</td>
                            <td>{{ $pasien->alamat }}</td>
                            <td>
                                <a href="{{ route('pasien.edit', $pasien->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                <form action="{{ route('pasien.destroy', $pasien->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data pasien ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>