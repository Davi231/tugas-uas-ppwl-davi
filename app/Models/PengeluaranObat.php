<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengeluaranObat extends Model
{
    use HasFactory;

    protected $fillable = ['produk_id', 'tanggal_keluar', 'jumlah', 'keterangan'];

    public function produk()
    {
        return $this->belongsTo(ProdukMedis::class, 'produk_id');
    }
}
