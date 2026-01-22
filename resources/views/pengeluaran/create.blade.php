@extends('adminlte::page')

@section('title','Tambah Pengeluaran')

@section('content_header')
<h1>Tambah Pengeluaran Obat</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('pengeluaran.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Produk</label>
                <select name="produk_id" class="form-control" required>
                    <option value="">-- Pilih Produk --</option>
                    @foreach($produk as $p)
                    <option value="{{ $p->id }}">
                        {{ $p->nama_produk }} (Stok: {{ $p->stok }})
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Tanggal Keluar</label>
                <input type="date" name="tanggal_keluar" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Jumlah</label>
                <input type="number" name="jumlah" class="form-control" min="1" required>
            </div>

            <div class="form-group">
                <label>Keterangan</label>
                <textarea name="keterangan" class="form-control"></textarea>
            </div>

            <button class="btn btn-success">Simpan</button>
            <a href="{{ route('pengeluaran.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@stop