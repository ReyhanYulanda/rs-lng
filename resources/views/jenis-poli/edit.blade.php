<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Jenis Poli</title>
</head>
<body>
    <h1>Edit Jenis Poli</h1>
    <form action="{{ route('jenis-poli.update', $jenisPoli->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" value="{{ $jenisPoli->nama }}" required>
        </div>
        <div>
            <button type="submit">Simpan</button>
            <a href="{{ route('jenis-poli.index') }}">Batal</a>
        </div>
    </form>
</body>
</html>