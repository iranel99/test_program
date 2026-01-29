<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey ='id_produk';
    public $timestamps = true;

    protected $fillable = [
        'nama_produk', 'harga', 'kategori_id', 'status_id'
     ];

    public function kategori()
    {
        return $this->belongsTo(
            Kategori::class,
            'kategori_id',
            'id_kategori'
        );
    }


    public function status()
    {
        return $this->belongsTo(
            Status::class,
            'status_id',
            'id_status'
        );
    }

}
