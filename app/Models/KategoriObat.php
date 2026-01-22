<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriObat extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kategori', 'keterangan'];

    public function produk()
    {
        return $this->hasMany(ProdukMedis::class, 'kategori_id');
    }
}
