<?php

namespace App\Http\Controllers;

use App\Models\KategoriObat;
use App\Models\ProdukMedis;
use App\Models\PengeluaranObat;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKategori = KategoriObat::count();
        $totalProduk   = ProdukMedis::count();
        $totalStok     = ProdukMedis::sum('stok');

        // Pengeluaran bulan ini
        $bulanIni = Carbon::now()->format('Y-m');
        $totalPengeluaranBulanIni = PengeluaranObat::where('tanggal_keluar', 'like', "$bulanIni%")
            ->sum('jumlah');

        // Produk hampir habis stok <= 5
        $stokMenipis = ProdukMedis::with('kategori')
            ->where('stok', '<=', 5)
            ->orderBy('stok', 'asc')
            ->limit(10)
            ->get();

        return view('dashboard', compact(
            'totalKategori',
            'totalProduk',
            'totalStok',
            'totalPengeluaranBulanIni',
            'stokMenipis'
        ));
    }
}
