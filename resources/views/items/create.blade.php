<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Tambah Barang</h1>
        <form action="{{ route('items.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nama Barang</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="quantity">Jumlah</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required min="1">
            </div>
            <div class="form-group">
                <label for="notes">Catatan</label>
                <input type="text" class="form-control" id="notes" name="notes">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('items.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>