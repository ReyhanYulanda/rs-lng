<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Poli</title>
</head>
<body>
    <h1>Daftar Poli</h1>
    <a href="{{ route('poli.create') }}">Tambah Poli</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Pasien</th>
                <th>ID Dokter</th>
                <th>Keluhan</th>
                <th>Jenis Poli</th>
                <th>Status</th>
                <th>Penyakit</th>
                <th>Catatan Medis</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($polis as $poli)
                <tr>
                    <td>{{ $poli->id }}</td>
                    <td>{{ $poli->id_pasien }}</td>
                    <td>{{ $poli->id_dokter }}</td>
                    <td>{{ $poli->keluhan }}</td>
                    <td>{{ $poli->jenis_poli }}</td>
                    <td>{{ $poli->status }}</td>
                    <td>{{ $poli->penyakit }}</td>
                    <td>{{ $poli->catatan_medis }}</td>
                    <td>
                        <a href="{{ route('poli.edit', $poli->id) }}">Edit</a>
                        <form action="{{ route('poli.destroy', $poli->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>