<!DOCTYPE html>
<html>
<head>
    <title>Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<h3>Data Produk</h3>

<a href="{{ route('produk.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Harga</th>
            <th>Kategori</th>
            <th>Status</th>
            <th width="180">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($produk as $p)
        <tr>
            <td>{{ $p->nama_produk }}</td>
            <td>Rp {{ number_format($p->harga) }}</td>
            <td>{{ $p->kategori->nama_kategori }}</td>
            <td>{{ $p->status->nama_status }}</td>
            <td>
                <a href="{{ route('produk.edit',$p->id_produk) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('produk.destroy',$p->id_produk) }}"
                      method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Hapus data?')"
                        class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
