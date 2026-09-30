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
        <input type="number" name="biaya_dokter" id="biaya_dokter" class="biaya-komponen" min="0" step="1" value="{{ old('biaya_dokter', 0) }}" required><br>

        <label for="biaya_obat">Biaya Obat:</label>
        <input type="number" name="biaya_obat" id="biaya_obat" class="biaya-komponen" min="0" step="1" value="{{ old('biaya_obat', 0) }}" required><br>

        <label for="biaya_administrasi">Biaya Administrasi:</label>
        <input type="number" name="biaya_administrasi" id="biaya_administrasi" class="biaya-komponen" min="0" step="1" value="{{ old('biaya_administrasi', 0) }}" required><br>

        <label for="biaya_lainnya">Biaya Lainnya:</label>
        <input type="number" name="biaya_lainnya" id="biaya_lainnya" class="biaya-komponen" min="0" step="1" value="{{ old('biaya_lainnya', 0) }}" required><br>

        <label for="jumlah">Jumlah:</label>
        <input type="number" name="jumlah" id="jumlah" value="0" readonly><br>

        <label for="status">Status:</label>
        <select name="status" id="status" required>
            <option value="Lunas">Lunas</option>
            <option value="Belum Lunas" selected='selected'>Belum Lunas</option>
        </select><br>

        <button type="submit">Create</button>
    </form>
    <a href="{{ route('biaya.index') }}">Back to Biaya List</a>
    
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