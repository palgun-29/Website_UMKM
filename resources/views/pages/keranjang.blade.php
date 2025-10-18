@extends('layouts.main')

@section('title', 'Keranjang Belanja')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-8">
                <h2 class="mb-4">Keranjang Belanja Anda</h2>

                {{-- Item di Keranjang --}}
                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <img src="{{ asset('images/balado.jpg') }}" class="img-fluid rounded"
                                    alt="Balado Pedas Manis">
                            </div>
                            <div class="col-md-4">
                                <h5 class="mb-0">Balado Pedas Manis</h5>
                                <small class="text-muted">Rp 15.000</small>
                            </div>
                            <div class="col-md-3">
                                <input type="number" class="form-control" value="2" min="1">
                            </div>
                            <div class="col-md-2">
                                <h6 class="mb-0">Rp 30.000</h6>
                            </div>
                            <div class="col-md-1 text-end">
                                <button class="btn btn-sm btn-outline-danger">&times;</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <img src="{{ asset('images/jagung manis.jpg') }}" class="img-fluid rounded"
                                    alt="Jagung Bakar Gurih">
                            </div>
                            <div class="col-md-4">
                                <h5 class="mb-0">Jagung Bakar Gurih</h5>
                                <small class="text-muted">Rp 15.000</small>
                            </div>
                            <div class="col-md-3">
                                <input type="number" class="form-control" value="1" min="1">
                            </div>
                            <div class="col-md-2">
                                <h6 class="mb-0">Rp 15.000</h6>
                            </div>
                            <div class="col-md-1 text-end">
                                <button class="btn btn-sm btn-outline-danger">&times;</button>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="{{-- route('products.index') --}}" class="btn btn-outline-dark mt-3">
                    <i class="fas fa-arrow-left"></i> Lanjut Belanja
                </a>
            </div>

            {{-- Ringkasan Pesanan --}}
            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Ringkasan Pesanan</h4>
                        <ul class="list-group list-group-flush">
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                Subtotal
                                <span>Rp 45.000</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                Biaya Pengiriman
                                <span>Rp 10.000</span>
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                <div>
                                    <strong>Total</strong>
                                </div>
                                <span><strong>Rp 55.000</strong></span>
                            </li>
                        </ul>
                        <button class="btn btn-success btn-lg w-100">
                            Lanjutkan ke Checkout
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
