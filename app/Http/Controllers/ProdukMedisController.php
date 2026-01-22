<?php

namespace App\Http\Controllers;

use App\Models\KategoriObat;
use App\Models\ProdukMedis;
use Illuminate\Http\Request;

class ProdukMedisController extends Controller
{
    public function index()
    {
        $data = ProdukMedis::with('kategori')->latest()->get();
        return view('produk.index', compact('data'));
    }

    public function create()
    {
        $kategori = KategoriObat::orderBy('nama_kategori')->get();
        return view('produk.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required',
            'nama_produk' => 'required',
            'stok' => 'required|integer|min:0',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
        ]);

        ProdukMedis::create($request->all());
        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambah');
    }

    public function edit(ProdukMedis $produk)
    {
        $kategori = KategoriObat::orderBy('nama_kategori')->get();
        return view('produk.edit', compact('produk', 'kategori'));
    }

    public function update(Request $request, ProdukMedis $produk)
    {
        $request->validate([
            'kategori_id' => 'required',
            'nama_produk' => 'required',
            'stok' => 'required|integer|min:0',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
        ]);

        $produk->update($request->all());
        return redirect()->route('produk.index')->with('success', 'Produk berhasil diupdate');
    }

    public function destroy(ProdukMedis $produk)
    {
        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus');
    }
}
