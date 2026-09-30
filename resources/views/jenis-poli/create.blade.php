<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Jenis Poli</title>
</head>
<body>
    <h1>Tambah Jenis Poli</h1>
    <form action="{{ route('jenis-poli.store') }}" method="POST">
        @csrf
        <div>
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" required>
        </div>
        <div>
            <button type="submit">Simpan</button>
            <a href="{{ route('jenis-poli.index') }}">Batal</a>
        </div>
    </form>
</body>
</html>