<form action="{{ route('produk.update',$produk->id_produk) }}" method="POST">
@csrf
@method('PUT')

<input type="text" name="nama_produk" value="{{ $produk->nama_produk }}" class="form-control mb-2">
<input type="number" name="harga" value="{{ $produk->harga }}" class="form-control mb-2">

<select name="kategori_id" class="form-control mb-2">
@foreach($kategori as $k)
    <option value="{{ $k->id_kategori }}"
        {{ $produk->kategori_id == $k->id_kategori ? 'selected' : '' }}>
        {{ $k->nama_kategori }}
    </option>
@endforeach
</select>

<select name="status_id" class="form-control mb-2">
@foreach($status as $s)
    <option value="{{ $s->id_status }}"
        {{ $produk->status_id == $s->id_status ? 'selected' : '' }}>
        {{ $s->nama_status }}
    </option>
@endforeach
</select>

<button class="btn btn-primary">Update</button>
</form>
