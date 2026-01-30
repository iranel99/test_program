<!DOCTYPE html>
<html>
<head>
    <title>Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="container mt-4">

<h3>Data Produk</h3>

<button class="btn btn-primary" id="btnTambah">Tambah Produk</button>

<table class="table">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Harga</th>
            <th>Kategori</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($produk as $p)
            <tr>
                <td>{{ $p->nama_produk }}</td>
                <td>{{ number_format($p->harga) }}</td>
                <td>{{ $p->kategori->nama_kategori }}</td>
                <td>{{ $p->status->nama_status }}</td>
                <td>
                    <button class="btn btn-warning btnEdit" data-id="{{ $p->id_produk }}">Edit</button>
                    <button class="btn btn-danger btnDelete" data-id="{{ $p->id_produk }}">Hapus</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="modal fade" id="modalProduk" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <form id="formProduk">
        @csrf
        <input type="hidden" name="_method" id="method">
        <input type="hidden" name="id_produk" id="id_produk">


        <div class="modal-header">
          <h5 class="modal-title">Form Produk</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <input type="text" name="nama_produk" class="form-control mb-2" placeholder="Nama Produk">

          <input type="number" name="harga" class="form-control mb-2">

          <select name="kategori_id" class="form-control mb-2">
            @foreach(\App\Models\Kategori::all() as $k)
              <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
            @endforeach
          </select>

          <select name="status_id" class="form-control mb-2">
            @foreach(\App\Models\Status::all() as $s)
              <option value="{{ $s->id_status }}">{{ $s->nama_status }}</option>
            @endforeach
          </select>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Batal
          </button>
          <button type="submit" class="btn btn-success">
            Simpan
          </button>
        </div>

      </form>

    </div>
  </div>
</div>



</body>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// TAMBAH
$('#btnTambah').click(function () {
    $('#formProduk')[0].reset();
    $('#id_produk').val('');
    $('#method').val('POST');
    $('#modalProduk').modal('show');
});

// SIMPAN (CREATE + UPDATE)
$('#formProduk').submit(function (e) {
    e.preventDefault();

    let id = $('#id_produk').val();
    let url = id ? `/produk/${id}` : `/produk`;

    $('#method').val(id ? 'PUT' : 'POST');

    console.log($(this).serialize());

    $.ajax({
        url: url,
        type: 'POST', // ⬅️ SELALU POST
        data: $(this).serialize(),
        success: function () {
            $('#modalProduk').modal('hide');
            location.reload();
        },
        error: function (err) {
            Swal.fire('Error', 'Gagal menyimpan data', 'error');
        }
    });
});

// EDIT
$('.btnEdit').click(function () {
    let id = $(this).data('id');

    $.get(`/produk/${id}/edit`, function (data) {
        $('#id_produk').val(data.id_produk);
        $('[name=nama_produk]').val(data.nama_produk);
        $('[name=harga]').val(data.harga);
        $('[name=kategori_id]').val(data.kategori_id);
        $('[name=status_id]').val(data.status_id);
        $('#method').val('PUT');
        $('#modalProduk').modal('show');
    });
});

// DELETE
$('.btnDelete').click(function () {
    let id = $(this).data('id');

    Swal.fire({
        title: 'Yakin?',
        text: 'Data akan dihapus permanen',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `/produk/${id}`,
                type: 'POST', // ⬅️ POST
                data: {
                    _method: 'DELETE',
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function () {
                    location.reload();
                }
            });
        }
    });
});
</script>


</html>
