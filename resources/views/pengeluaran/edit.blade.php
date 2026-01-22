@extends('adminlte::page')

@section('title','Edit Pengeluaran')

@section('content_header')
<h1>Edit Pengeluaran Obat</h1>
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
        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form action="{{ route('pengeluaran.update', $pengeluaran->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Produk</label>
                <select name="produk_id" class="form-control" required>
                    @foreach($produk as $p)
                    <option value="{{ $p->id }}" {{ $pengeluaran->produk_id == $p->id ? 'selected' : '' }}>
                        {{ $p->nama_produk }} (Stok: {{ $p->stok }})
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Tanggal Keluar</label>
                <input type="date" name="tanggal_keluar" class="form-control"
                    value="{{ old('tanggal_keluar', $pengeluaran->tanggal_keluar) }}" required>
            </div>

            <div class="form-group">
                <label>Jumlah</label>
                <input type="number" name="jumlah" class="form-control" min="1"
                    value="{{ old('jumlah', $pengeluaran->jumlah) }}" required>
            </div>

            <div class="form-group">
                <label>Keterangan</label>
                <textarea name="keterangan"
                    class="form-control">{{ old('keterangan', $pengeluaran->keterangan) }}</textarea>
            </div>

            <button class="btn btn-success">Update</button>
            <a href="{{ route('pengeluaran.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@stop