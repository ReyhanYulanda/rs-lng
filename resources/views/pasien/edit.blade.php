<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Data Pasien</title>
</head>
<body>
    <h1>Edit Data Pasien</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pasien.update', $pasien->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="no_rekam_medis">No Rekam Medis</label>
            <input type="text" id="no_rekam_medis" name="no_rekam_medis" value="{{ $pasien->no_rekam_medis }}" required>
        </div>
        <div>
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" value="{{ $pasien->nama }}" required>
        </div>
        <div>
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ $pasien->tanggal_lahir }}" required>
        </div>
        <div>
            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat" rows="3" required>{{ $pasien->alamat }}</textarea>
        </div>
        <div>
            <button type="submit">Simpan</button>
            <a href="{{ route('pasien.index') }}">Batal</a>
        </div>
    </form>

</body>
</html>