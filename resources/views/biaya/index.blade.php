<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Biaya</title>
</head>
<body>
    <h1>Biaya</h1>
    <a href="{{ route('biaya.create') }}">Create New Biaya</a>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Pasien</th>
                <th>Biaya Dokter</th>
                <th>Biaya Obat</th>
                <th>Biaya Administrasi</th>
                <th>Biaya Lainnya</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($biayas as $biaya)
                <tr>
                    <td>{{ $biaya->id }}</td>
                    <td>{{ $pasien->firstWhere('id', $biaya->id_pasien)->nama ?? 'Unknown' }}</td>
                    <td>{{ $biaya->biaya_dokter }}</td>
                    <td>{{ $biaya->biaya_obat }}</td>
                    <td>{{ $biaya->biaya_administrasi }}</td>
                    <td>{{ $biaya->biaya_lainnya }}</td>
                    <td>{{ $biaya->jumlah }}</td>
                    <td>{{ $biaya->status }}</td>
                    <td>
                        <a href="{{ route('biaya.edit', $biaya->id) }}">Edit</a>
                        <form action="{{ route('biaya.destroy', $biaya->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>