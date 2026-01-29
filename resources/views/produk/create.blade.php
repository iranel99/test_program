<form action="{{ route('produk.store') }}" method="POST">
@csrf

<input type="text" name="nama_produk" class="form-control mb-2" placeholder="Nama Produk">
<input type="number" name="harga" class="form-control mb-2" placeholder="Harga">

<select name="kategori_id" class="form-control mb-2">
    @foreach($kategori as $k)
        <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
    @endforeach
</select>

<select name="status_id" class="form-control mb-2">
    @foreach($status as $s)
        <option value="{{ $s->id_status }}">{{ $s->nama_status }}</option>
    @endforeach
</select>

<button class="btn btn-success">Simpan</button>
</form>
