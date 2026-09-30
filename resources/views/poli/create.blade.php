<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Poli</title>
</head>
<body>
    <h1>Tambah Poli</h1>
    <form action="{{ route('poli.store') }}" method="POST">
        @csrf
        <label for="id_pasien">Pasien:</label>
        <select name="id_pasien" id="id_pasien" required>
            @foreach ($pasiens as $pasien)
                <option value="{{ $pasien->id }}">{{ $pasien->nama }}</option>
            @endforeach
        </select><br>

        <label for="id_dokter">Dokter:</label>
        <select name="id_dokter" id="id_dokter" required>
            @foreach ($dokters as $dokter)
                <option value="{{ $dokter->id }}">{{ $dokter->nama }}</option>
            @endforeach
        </select><br>

        <label for="keluhan">Keluhan:</label>
        <input type="text" name="keluhan" id="keluhan" required><br>

        <label for="jenis_poli">Jenis Poli:</label>
        <select name="jenis_poli" id="jenis_poli" required>
            @foreach ($jenisPolis as $jenisPoli)
                <option value="{{ $jenisPoli->id }}">{{ $jenisPoli->nama }}</option>
            @endforeach
        </select><br>

        <label for="status">Status:</label>
        <input type="text" name="status" id="status" required><br>

        <label for="penyakit">Penyakit:</label>
        <input type="text" name="penyakit" id="penyakit" ><br>

        <label for="catatan_medis">Catatan Medis:</label>
        <input type="text" name="catatan_medis" id="catatan_medis" ><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>