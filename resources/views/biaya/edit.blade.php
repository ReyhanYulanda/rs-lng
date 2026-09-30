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
        <input type="number" name="biaya_dokter" id="biaya_dokter" class="biaya-komponen" min="0" step="1" value="{{ $biaya->biaya_dokter }}" required>
        <br>
        <label for="biaya_obat">Biaya Obat:</label>
        <input type="number" name="biaya_obat" id="biaya_obat" class="biaya-komponen" min="0" step="1" value="{{ $biaya->biaya_obat }}" required>
        <br>
        <label for="biaya_administrasi">Biaya Administrasi:</label>
        <input type="number" name="biaya_administrasi" id="biaya_administrasi" class="biaya-komponen" min="0" step="1" value="{{ $biaya->biaya_administrasi }}" required>
        <br>
        <label for="biaya_lainnya">Biaya Lainnya:</label>
        <input type="number" name="biaya_lainnya" id="biaya_lainnya" class="biaya-komponen" min="0" step="1" value="{{ $biaya->biaya_lainnya }}" required>
        <br>
        <label for="jumlah">Jumlah:</label>
        <input type="number" name="jumlah" id="jumlah" value="{{ $biaya->jumlah }}" readonly>
        <br>
        <button type="submit">Update</button>
    </form>
    <script>
        const biayaKomponen = document.querySelectorAll('.biaya-komponen');
        const jumlah = document.getElementById('jumlah');

        function hitungJumlah() {
            jumlah.value = Array.from(biayaKomponen)
                .reduce((total, input) => total + Number(input.value || 0), 0);
        }

        biayaKomponen.forEach((input) => input.addEventListener('input', hitungJumlah));
        hitungJumlah();
    </script>
</body>
</html>