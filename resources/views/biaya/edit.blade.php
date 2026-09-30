<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Biaya</title>
</head>
<body>
    <h1>Edit Biaya</h1>
    <form action="{{ route('biaya.update', $biaya->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="id_pasien">ID Pasien:</label>
        <select name="id_pasien" id="id_pasien" required>
            @foreach($pasien as $p)
                <option value="{{ $p->id }}" {{ $biaya->id_pasien == $p->id ? 'selected' : '' }}>{{ $p->nama }}</option>
            @endforeach
        </select>
        <br>
        <label for="biaya_dokter">Biaya Dokter:</label>
        <input type="text" name="biaya_dokter" id="biaya_dokter" value="{{ $biaya->biaya_dokter }}">
        <br>
        <label for="biaya_obat">Biaya Obat:</label>
        <input type="text" name="biaya_obat" id="biaya_obat" value="{{ $biaya->biaya_obat }}">
        <br>
        <label for="biaya_administrasi">Biaya Administrasi:</label>
        <input type="text" name="biaya_administrasi" id="biaya_administrasi" value="{{ $biaya->biaya_administrasi }}">
        <br>
        <label for="biaya_lainnya">Biaya Lainnya:</label>
        <input type="text" name="biaya_lainnya" id="biaya_lainnya" value="{{ $biaya->biaya_lainnya }}">
        <br>
        <label for="jumlah">Jumlah:</label>
        <input type="text" name="jumlah" id="jumlah" value="{{ $biaya->jumlah }}">
        <br>
        <button type="submit">Update</button>
    </form>
</body>
</html>