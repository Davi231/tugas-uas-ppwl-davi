@extends('adminlte::page')

@section('title','Dashboard')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
<div class="row">

    <div class="col-md-3">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalKategori }}</h3>
                <p>Total Kategori Obat</p>
            </div>
            <div class="icon">
                <i class="fas fa-tags"></i>
            </div>
            <a href="{{ url('kategori') }}" class="small-box-footer">
                Lihat <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-md-3">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $totalProduk }}</h3>
                <p>Total Produk Medis</p>
            </div>
            <div class="icon">
                <i class="fas fa-pills"></i>
            </div>
            <a href="{{ url('produk') }}" class="small-box-footer">
                Lihat <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-md-3">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $totalStok }}</h3>
                <p>Total Stok Produk</p>
            </div>
            <div class="icon">
                <i class="fas fa-boxes"></i>
            </div>
            <a href="{{ url('produk') }}" class="small-box-footer">
                Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-md-3">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $totalPengeluaranBulanIni }}</h3>
                <p>Pengeluaran Bulan Ini</p>
            </div>
            <div class="icon">
                <i class="fas fa-notes-medical"></i>
            </div>
            <a href="{{ url('pengeluaran') }}" class="small-box-footer">
                Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Produk Stok Menipis (<= 5)</h3>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Satuan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stokMenipis as $p)
                <tr>
                    <td>{{ $p->nama_produk }}</td>
                    <td>{{ $p->kategori->nama_kategori ?? '-' }}</td>
                    <td><b>{{ $p->stok }}</b></td>
                    <td>{{ $p->satuan }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Tidak ada produk stok menipis ✅</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@stop