<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang Belanja</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
      .highlight {
          background-color: yellow;
          font-weight: bold;
      }
    </style>
</head>

<script>
document.querySelector('input[name="search"]').addEventListener('keyup', function(e) {
    fetch(`/items?search=${e.target.value}`)
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            document.querySelector('tbody').innerHTML = doc.querySelector('tbody').innerHTML;
        });
});
</script>

<body>
    <div class="container mt-5">
        <h1>Daftar Barang Belanja</h1>

        <form action="{{ route('items.index') }}" method="GET" class="mb-4">
          <div class="input-group">
            <input 
                type="text" 
                name="search" 
                class="form-control" 
                placeholder="Cari barang/catatan..."
                value="{{ request('search') }}"
            >
            <button type="submit" class="btn btn-primary">Cari</button>
            @if(request('search'))
                <a href="{{ route('items.index') }}" class="btn btn-secondary">Reset</a>
            @endif
          </div>
        </form>

        <a href="{{ route('items.create') }}" class="btn btn-primary mb-3">Tambah Barang Baru</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Catatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>
                          @if(request('search'))
                              {!! preg_replace('/('.request('search').')/i', '<span class="highlight">$1</span>', $item->name) !!}
                          @else
                              {{ $item->name }}
                          @endif
                        </td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->notes }}</td>
                        <td>
                            <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>