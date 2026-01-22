@extends('adminlte::page')

@section('title','Edit Produk')

@section('content_header')
<h1>Edit Produk Medis</h1>
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
        <form action="{{ route('produk.update', $produk->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Kategori</label>
                <select name="kategori_id" class="form-control" required>
                    @foreach($kategori as $k)
                    <option value="{{ $k->id }}" {{ $produk->kategori_id == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kategori }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="nama_produk" class="form-control"
                    value="{{ old('nama_produk', $produk->nama_produk) }}" required>
            </div>

            <div class="form-group">
                <label>Satuan</label>
                <select name="satuan" class="form-control" required>
                    <option value="">-- Pilih Satuan --</option>
                    <option value="tablet" {{ old('satuan', $produk->satuan) == 'tablet' ? 'selected' : '' }}>Tablet
                    </option>
                    <option value="botol" {{ old('satuan', $produk->satuan) == 'botol' ? 'selected' : '' }}>Botol
                    </option>
                    <option value="pcs" {{ old('satuan', $produk->satuan) == 'pcs' ? 'selected' : '' }}>PCS</option>
                </select>
            </div>

            <div class="form-group">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control" min="0" value="{{ old('stok', $produk->stok) }}"
                    required>
            </div>

            <div class="form-group">
                <label>Harga Beli</label>
                <input type="number" name="harga_beli" class="form-control" min="0"
                    value="{{ old('harga_beli', $produk->harga_beli) }}" required>
            </div>

            <div class="form-group">
                <label>Harga Jual</label>
                <input type="number" name="harga_jual" class="form-control" min="0"
                    value="{{ old('harga_jual', $produk->harga_jual) }}" required>
            </div>

            <div class="form-group">
                <label>Expired Date</label>
                <input type="date" name="expired_at" class="form-control"
                    value="{{ old('expired_at', $produk->expired_at) }}">
            </div>

            <button class="btn btn-success">Update</button>
            <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@stop