@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-3">Edit Produk: {{ $product->title }}</h2>

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="mb-3">
                <label>Nama Produk</label>
                <input type="text" name="title" class="form-control" value="{{ $product->title }}" required>
            </div>
            <div class="mb-3">
                <label>Harga</label>
                <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
            </div>
            <div class="mb-3">
                <label>Stok</label>
                <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
            </div>
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control">{{ $product->description }}</textarea>
            </div>
            <div class="mb-3">
                <label>Gambar Produk</label><br>
                @if ($product->image)
                    <img src="{{ asset($product->image) }}" width="100" class="mb-2">
                @endif
                <input type="file" name="image" class="form-control">
            </div>
            <button type="submit" class="btn btn-warning">Update</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
