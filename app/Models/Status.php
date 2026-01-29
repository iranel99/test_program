<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';
    protected $primaryKey ='id_status';
    public $timestamps = true;

    protected $fillable = [
        'nama_status'
    ];

    public function status()
    {
        return $this->hasMany(
            Produk::class,
            'status_id',   // foreign key di tabel produk
            'id_status'    // primary key di tabel kategori
        );
    }

}
