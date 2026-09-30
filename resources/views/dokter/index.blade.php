<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dokter</title>
</head>
<body>
    <h1>Daftar Dokter</h1>
    <a href="{{ route('dokter.create') }}">Tambah Dokter</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dokters as $dokter)
                <tr>
                    <td>{{ $dokter->id }}</td>
                    <td>{{ $dokter->nip }}</td>
                    <td>{{ $dokter->nama }}</td>
                    <td>
                        <a href="{{ route('dokter.edit', $dokter->id) }}">Edit</a>
                        <form action="{{ route('dokter.destroy', $dokter->id) }}" method="POST" style="display:inline;">
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