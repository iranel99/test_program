<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey ='id_kategori';
    public $timestamps = true;

    protected $fillable = [
        'nama_kategori'
    ];

    public function produk()
    {
        return $this->hasMany(
            Produk::class,
            'kategori_id',   // foreign key di tabel produk
            'id_kategori'    // primary key di tabel kategori
        );
    }

}
