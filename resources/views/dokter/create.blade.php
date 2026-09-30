<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Dokter</title>
</head>
<body>
    <h1>Tambah Dokter</h1>
    <form action="{{ route('dokter.store') }}" method="POST">
        @csrf
        <label for="nip">NIP:</label>
        <input type="text" id="nip" name="nip" required>
        <br>
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required>
        <br>
        <button type="submit">Simpan</button>
    </form>
    <a href="{{ route('dokter.index') }}">Kembali ke Daftar Dokter</a>
</body>
</html>