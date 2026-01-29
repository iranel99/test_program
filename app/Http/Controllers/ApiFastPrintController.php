<?php

namespace App\Http\Controllers;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Status;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiFastPrintController extends Controller
{
    public function fetch()
    {
        $date = now();

        $response = Http::asForm()->post(
            'https://recruitment.fastprint.co.id/tes/api_tes_programmer',
            [
                'username' => 'tesprogrammer' . $date->format('dmy') . 'C' . $date->format('H'),
                'password' => md5('bisacoding-' . $date->format('d-m-y')),
            ]
        );

        // dd(
        //     'tesprogrammer' . $date->format('dmy') . 'C' . $date->format('H'),
        //     md5('bisacoding-' . $date->format('d-m-y')),
        //     $response->body()
        // );


        $data = $response->json();

        if ($data['error'] == 1) {
            return response()->json($data['ket']);
        }

        foreach ($data['data'] as $item) {

            // KATEGORI
            $kategori = Kategori::firstOrCreate(
                ['nama_kategori' => $item['kategori']]
            );

            // STATUS
            $status = Status::firstOrCreate(
                ['nama_status' => $item['status']]
            );

            // PRODUK
            Produk::updateOrCreate(
                ['id_produk' => $item['id_produk']],
                [
                    'nama_produk' => $item['nama_produk'],
                    'harga'       => $item['harga'],
                    'kategori_id' => $kategori->id_kategori,
                    'status_id'   => $status->id_status,
                ]
            );
        }

        return response()->json('Data berhasil disimpan');
    }

}
