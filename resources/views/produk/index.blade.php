@extends('adminlte::page')

@section('title','Produk Medis')

@section('content_header')
<h1>Produk Medis</h1>
@stop

@section('content')
<a href="{{ route('produk.create') }}" class="btn btn-primary mb-3">+ Tambah</a>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Nama Produk</th>
                    <th>Satuan</th>
                    <th>Stok</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Expired</th>
                    <th width="170">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $i => $row)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $row->kategori->nama_kategori ?? '-' }}</td>
                    <td>{{ $row->nama_produk }}</td>
                    <td>{{ $row->satuan }}</td>
                    <td>{{ $row->stok }}</td>
                    <td>Rp {{ number_format($row->harga_beli,0,',','.') }}</td>
                    <td>Rp {{ number_format($row->harga_jual,0,',','.') }}</td>
                    <td>{{ $row->expired_at ? \Carbon\Carbon::parse($row->expired_at)->format('d-m-Y') : '-' }}</td>
                    <td>
                        <a href="{{ route('produk.edit',$row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('produk.destroy',$row->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Hapus data?')" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop