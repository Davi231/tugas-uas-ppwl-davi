@extends('adminlte::page')

@section('title','Pengeluaran Obat')

@section('content_header')
<h1>Pengeluaran Obat</h1>
@stop

@section('content')
<a href="{{ route('pengeluaran.create') }}" class="btn btn-primary mb-3">+ Tambah</a>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@elseif(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif
<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Keluar</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th width="170">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $i => $row)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($row->tanggal_keluar)->format('d-m-Y') }}</td>
                    <td>{{ $row->produk->nama_produk ?? '-' }}</td>
                    <td>{{ $row->jumlah }}</td>
                    <td>{{ $row->keterangan }}</td>
                    <td>
                        <a href="{{ route('pengeluaran.edit',$row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('pengeluaran.destroy',$row->id) }}" method="POST" class="d-inline">
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