<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jenis Poli</title>
</head>
<body>
    <h1>Jenis Poli</h1>
    <a href="{{ route('jenis-poli.create') }}">Tambah Jenis Poli</a>
    <table border="1">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jenisPolis as $jenisPoli)
                <tr>
                    <td>{{ $jenisPoli->nama }}</td>
                    <td>
                        <a href="{{ route('jenis-poli.edit', $jenisPoli->id) }}">Edit</a>
                        <form action="{{ route('jenis-poli.destroy', $jenisPoli->id) }}" method="POST" style="display:inline;">
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