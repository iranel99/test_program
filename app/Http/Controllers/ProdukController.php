<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use App\Http\Requests\ProdukRequest;
use App\Models\Kategori;
use App\Models\Status;

use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::with(['kategori','status'])
            ->where('status_id', 1)
            ->get();

        return view('produk.index', compact('produk'));
    }

    public function store(ProdukRequest $request)
    {
        Produk::create($request->validated());
        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        return Produk::findOrFail($id);
    }

    public function update(ProdukRequest $request, $id)
    {
        Produk::findOrFail($id)->update($request->validated());
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Produk::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }
}
