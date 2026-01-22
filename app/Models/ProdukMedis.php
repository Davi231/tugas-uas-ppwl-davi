<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukMedis extends Model
{
    use HasFactory;

    protected $table = 'produk_medis';

    protected $fillable = [
        'kategori_id',
        'nama_produk',
        'satuan',
        'stok',
        'harga_beli',
        'harga_jual',
        'expired_at'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriObat::class, 'kategori_id');
    }

    public function pengeluaran()
    {
        return $this->hasMany(PengeluaranObat::class, 'produk_id');
    }
}
