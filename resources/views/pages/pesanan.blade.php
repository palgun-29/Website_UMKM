@extends('layouts.main')

@section('title', 'Riwayat Pesanan')

@section('content')
    <div class="container my-5">
        <h1 class="text-center fw-bold mb-5">Riwayat Pesanan Anda</h1>

        @if (empty($orders))
            <div class="alert alert-warning text-center">
                Anda belum memiliki riwayat pesanan.
            </div>
        @else
            {{-- Loop untuk menampilkan setiap pesanan --}}
            @foreach ($orders as $order)
                <div class="card shadow-sm mb-3">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Pesanan #{{ $order->id }}</h5>
                        <span class="badge bg-success">Selesai</span> {{-- Ganti dengan status pesanan sebenarnya --}}
                    </div>
                    <div class="card-body">
                        <p><strong>Tanggal Pesanan:</strong> {{ $order->created_at->format('d M Y') }}</p>
                        <p><strong>Total Pembayaran:</strong> Rp{{ number_format($order->total, 0, ',', '.') }}</p>

                        <h6 class="mt-3">Item Pesanan:</h6>
                        <ul class="list-group list-group-flush">
                            @foreach ($order->items as $item)
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>{{ $item->product_name }} x {{ $item->quantity }}</span>
                                    <span>Rp{{ number_format($item->subtotal, 0, ',', '.') }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
