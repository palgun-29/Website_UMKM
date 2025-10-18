@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold">Produk Kami</h1>
            {{-- <a href="#" class="btn btn-primary">Tambah Produk</a> --}}
        </div>

        @if ($products->isEmpty())
            <div class="alert alert-info">
                Belum ada produk yang tersedia saat ini.
            </div>
        @else
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach ($products as $product)
                    <div class="col">
                        <div class="card h-100">
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/400x300' }}"
                                class="card-img-top" alt="{{ $product->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                                <p class="card-text fw-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                <a href="#" class="btn btn-primary">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
