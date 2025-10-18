{{-- resources/views/checkout.blade.php --}}
@extends('layouts.main')

@section('title', 'Checkout')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Formulir Checkout</h1>
    <div class="row">
        {{-- Kolom Kiri: Form Alamat --}}
        <div class="col-md-7">
            <h4>Alamat Pengiriman</h4>
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Penerima</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Alamat Lengkap</label>
                    <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Buat Pesanan</button>
            </form>
        </div>

        {{-- Kolom Kanan: Ringkasan Pesanan --}}
        <div class="col-md-5">
            <h4>Ringkasan Pesanan</h4>
            <ul class="list-group">
                @php $subtotal = 0; @endphp
                @foreach($cart as $id => $details)
                    @php $subtotal += $details['price'] * $details['quantity']; @endphp
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $details['name'] }} (x{{ $details['quantity'] }})
                        <span>Rp{{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</span>
                    </li>
                @endforeach
                <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                    Subtotal
                    <span>Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Biaya Pengiriman
                    <span>Rp10.000</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center fw-bold fs-5">
                    Total
                    <span>Rp{{ number_format($subtotal + 10000, 0, ',', '.') }}</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection