<?php

namespace App\Http\Controllers;

use App\Models\PengeluaranObat;
use App\Models\ProdukMedis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengeluaranObatController extends Controller
{
    public function index()
    {
        $data = PengeluaranObat::with('produk')->latest()->get();
        return view('pengeluaran.index', compact('data'));
    }

    public function create()
    {
        $produk = ProdukMedis::orderBy('nama_produk')->get();
        return view('pengeluaran.create', compact('produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required',
            'tanggal_keluar' => 'required|date',
            'jumlah' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {
            $produk = ProdukMedis::findOrFail($request->produk_id);

            if ($produk->stok < $request->jumlah) {
                return redirect()->back()->with('error', 'Stok tidak cukup');
            }
            PengeluaranObat::create($request->all());

            $produk->stok -= $request->jumlah;
            $produk->save();
        });

        return redirect()->route('pengeluaran.index')->with('success', 'Pengeluaran berhasil disimpan & stok berkurang');
    }

    public function edit(PengeluaranObat $pengeluaran)
    {
        $produk = ProdukMedis::orderBy('nama_produk')->get();
        return view('pengeluaran.edit', compact('pengeluaran', 'produk'));
    }

    public function update(Request $request, PengeluaranObat $pengeluaran)
    {
        $request->validate([
            'produk_id' => 'required',
            'tanggal_keluar' => 'required|date',
            'jumlah' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request, $pengeluaran) {
            $produkLama = ProdukMedis::findOrFail($pengeluaran->produk_id);
            $produkBaru = ProdukMedis::findOrFail($request->produk_id);

            // kembalikan stok lama
            $produkLama->stok += $pengeluaran->jumlah;
            $produkLama->save();

            // cek stok baru cukup
            if ($produkBaru->stok < $request->jumlah) {
                abort(400, 'Stok tidak cukup');
            }

            // update pengeluaran
            $pengeluaran->update($request->all());

            // kurangi stok baru
            $produkBaru->stok -= $request->jumlah;
            $produkBaru->save();
        });

        return redirect()->route('pengeluaran.index')->with('success', 'Pengeluaran berhasil diupdate');
    }

    public function destroy(PengeluaranObat $pengeluaran)
    {
        DB::transaction(function () use ($pengeluaran) {
            $produk = ProdukMedis::findOrFail($pengeluaran->produk_id);
            $produk->stok += $pengeluaran->jumlah;
            $produk->save();

            $pengeluaran->delete();
        });

        return redirect()->route('pengeluaran.index')->with('success', 'Pengeluaran dihapus & stok dikembalikan');
    }
}
