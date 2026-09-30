<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Biaya</title>
</head>
<body>
    <h1>Create New Biaya</h1>
    <form action="{{ route('biaya.store') }}" method="POST">
        @csrf
        <label for="id_pasien">ID Pasien:</label>
        <select name="id_pasien" id="id_pasien" required>
            @foreach($pasien as $p)
                <option value="{{ $p->id }}">{{ $p->nama }}</option>
            @endforeach
        </select><br>

        <label for="biaya_dokter">Biaya Dokter:</label>
        <input type="number" name="biaya_dokter" id="biaya_dokter" required><br>

        <label for="biaya_obat">Biaya Obat:</label>
        <input type="number" name="biaya_obat" id="biaya_obat" required><br>

        <label for="biaya_administrasi">Biaya Administrasi:</label>
        <input type="number" name="biaya_administrasi" id="biaya_administrasi" required><br>

        <label for="biaya_lainnya">Biaya Lainnya:</label>
        <input type="number" name="biaya_lainnya" id="biaya_lainnya" required><br>

        <label for="jumlah">Jumlah:</label>
        <input type="number" name="jumlah" id="jumlah" required><br>

        <label for="status">Status:</label>
        <select name="status" id="status" required>
            <option value="Lunas">Lunas</option>
            <option value="Belum Lunas" selected='selected'>Belum Lunas</option>
        </select><br>

        <button type="submit">Create</button>
    </form>
    <a href="{{ route('biaya.index') }}">Back to Biaya List</a>
</body>
</html>