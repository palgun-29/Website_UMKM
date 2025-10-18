@extends('layouts.main')

@section('title', 'Keranjang Belanja')

@section('content')
    <div class="container my-5">
        <h1 class="text-center fw-bold mb-4">Keranjang Belanja Anda</h1>

        @if (empty($cart))
            <div class="alert alert-info text-center">
                Keranjang Anda masih kosong. Yuk, <a href="{{ route('produk') }}">mulai belanja!</a>
            </div>
        @else
            {{-- Form untuk update keranjang --}}
            <form action="{{ route('cart.update') }}" method="POST">
                @csrf
                {{-- Tabel untuk menampilkan item keranjang --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Produk</th>
                                <th class="text-center">Kuantitas</th>
                                <th class="text-end">Harga Satuan</th>
                                <th class="text-end">Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $id => $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}"
                                                class="img-thumbnail me-3" style="width: 50px; height: 50px;">
                                            <span>{{ $item['title'] }}</span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <input type="number" name="quantities[{{ $id }}]"
                                            value="{{ $item['quantity'] }}" min="1" class="form-control"
                                            style="width: 80px;">
                                    </td>
                                    <td class="text-end">Rp{{ number_format($item['price'], 0, ',', '.') }}</td>
                                    <td class="text-end">
                                        Rp{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                                    <td>
                                        <form action="{{ route('cart.remove') }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $id }}">
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">Subtotal:</th>
                                <th class="text-end">Rp{{ number_format($subtotal, 0, ',', '.') }}</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th colspan="3" class="text-end">Biaya Pengiriman:</th>
                                <th class="text-end">Rp{{ number_format($shippingCost, 0, ',', '.') }}</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th colspan="3" class="text-end">Total:</th>
                                <th class="text-end">Rp{{ number_format($total, 0, ',', '.') }}</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="text-end mt-4">
                    <a href="{{ route('produk') }}" class="btn btn-secondary me-2">Lanjut Belanja</a>
                    <button type="submit" class="btn btn-primary me-2">Update Keranjang</button>
                    <a href="{{ route('checkout.show') }}" class="btn btn-success">Checkout</a>
                </div>
            </form>
        @endif
    </div>
@endsection
