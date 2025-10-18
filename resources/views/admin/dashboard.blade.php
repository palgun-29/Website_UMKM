@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12 mb-3">
            <h1 class="fw-bold">👑 Dashboard Admin</h1>
            <p class="text-muted">Selamat datang, {{ Auth::user()->name }} — Anda login sebagai <strong>Admin</strong></p>
            <hr>
        </div>
    </div>

    <div class="row">
        <!-- Card Statistik Produk -->
        <div class="col-md-4 mb-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="bi bi-box-seam display-5 text-primary"></i>
                    <h5 class="card-title mt-2">Produk</h5>
                    <p class="card-text fs-4 fw-bold">{{ \App\Models\Product::count() }}</p>
                    <a href="#" class="btn btn-primary btn-sm">Kelola Produk</a>
                </div>
            </div>
        </div>

        <!-- Card Statistik Pengguna -->
        <div class="col-md-4 mb-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="bi bi-people-fill display-5 text-success"></i>
                    <h5 class="card-title mt-2">Pelanggan</h5>
                    <p class="card-text fs-4 fw-bold">{{ \App\Models\User::where('role', 'user')->count() }}</p>
                    <a href="#" class="btn btn-success btn-sm">Kelola Pengguna</a>
                </div>
            </div>
        </div>

        <!-- Card Statistik Transaksi -->
        <div class="col-md-4 mb-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="bi bi-cash-coin display-5 text-warning"></i>
                    <h5 class="card-title mt-2">Transaksi</h5>
                    <p class="card-text fs-4 fw-bold">0</p>
                    <a href="#" class="btn btn-warning btn-sm">Lihat Transaksi</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Tabel Produk -->
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">📦 Daftar Produk</h5>
                    <a href="#" class="btn btn-light btn-sm">+ Tambah Produk</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Gambar</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\Product::take(5)->get() as $index => $product)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><img src="{{ asset($product->image) }}" alt="{{ $product->alt }}" width="50"></td>
                                <td>{{ $product->title }}</td>
                                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="#" class="btn btn-sm btn-danger">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="#" class="btn btn-outline-primary btn-sm mt-2">Lihat Semua Produk</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
