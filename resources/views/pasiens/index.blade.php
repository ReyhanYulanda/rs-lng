<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pasien</title>
</head>
<body>
    <h1>Daftar Pasien</h1>
    <a href="{{ route('pasiens.create') }}">Tambah Pasien</a>
    <table border="1">
        <thead>
            <tr>
                <th>Nama</th>
                <th>No Rekam Medik</th>
                <th>NIK</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach($pasiens as $pasien)
            <tr>
                <td>{{ $pasien->nama }}</td>
                <td>{{ $pasien->no_rekam_medik }}</td>
                <td>{{ $pasien->nik }}</td>
                <td>{{ $pasien->tanggal_lahir }}</td>
                <td>{{ $pasien->alamat }}</td>
                <td>
                    <a href="{{ route('pasiens.edit', $pasien->id) }}">Edit</a>
                    <form action="{{ route('pasiens.destroy', $pasien->id) }}" method="POST" style="display:inline;">
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