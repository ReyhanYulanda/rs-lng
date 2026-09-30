<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Pasien</title>
</head>
<body>
    <h1>Edit Pasien</h1>
    <form action="{{ route('pasiens.update', $pasien->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="no_rekam_medik">No Rekam Medik:</label>
        <input type="text" id="no_rekam_medik" name="no_rekam_medik" value="{{ $pasien->no_rekam_medik }}" required>
        <br>
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" value="{{ $pasien->nama }}" required>
        <br>
        <label for="tanggal_lahir">Tanggal Lahir:</label>
        <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ $pasien->tanggal_lahir }}" required>
        <br>
        <label for="alamat">Alamat:</label>
        <input type="text" id="alamat" name="alamat" value="{{ $pasien->alamat }}" required>
        <br>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>