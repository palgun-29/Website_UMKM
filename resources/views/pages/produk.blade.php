@extends('layouts.main')

@section('title', 'Produk Kami')

@section('content')
    <div class="container my-5">
        <header class="text-center mb-5">
            <h1 class="display-4 fw-bold text-primary">Varian Rasa Juara</h1>
            <p class="lead text-muted">Pilih rasa favoritmu yang siap menemani setiap momen santaimu. 🤩</p>
        </header>

        {{-- Notifikasi Sukses - Menggunakan Blade Conditional untuk memeriksa session flash --}}
        @if (session('success'))
            <div id="notification" class="alert alert-success alert-dismissible fade show" role="alert"
                style="position: fixed; top: 20px; right: 20px; z-index: 1050;">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Area Tampilan Produk --}}
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            {{-- Menggunakan $products karena data idealnya dikirim dari Controller --}}
            @forelse ($products as $product)
                {{-- Card Produk --}}
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ asset($product['image'] ?? 'images/default.jpg') }}" class="card-img-top"
                            alt="{{ $product['alt'] ?? $product['title'] }}" style="object-fit: cover; height: 200px;">

                        <div class="card-body d-flex flex-column">
                            {{-- Detail Produk --}}
                            <h5 class="card-title fw-bold text-dark">{{ $product['title'] }}</h5>
                            <p class="card-text text-success fw-bold mb-2">
                                Rp{{ number_format($product['price'] ?? 0, 0, ',', '.') }}
                            </p>

                            {{-- Status Stok --}}
                            @php
                                $isAvailable = ($product['stock'] ?? 0) > 0;
                            @endphp
                            <p class="card-text mb-3">
                                <span class="badge rounded-pill {{ $isAvailable ? 'bg-success' : 'bg-danger' }}">
                                    Stok: {{ $isAvailable ? $product['stock'] ?? 0 : 'Habis' }}
                                </span>
                            </p>

                            {{-- Form Aksi (Add to Cart) --}}
                            <div class="mt-auto">
                                @if ($isAvailable)
                                    {{-- Menggunakan route yang sudah Anda definisikan --}}
                                    <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="quantity" value="1"
                                                min="1" max="{{ $product['stock'] ?? 1 }}" aria-label="Jumlah"
                                                required>
                                            <button class="btn btn-dark" type="submit">
                                                <i class="fas fa-cart-plus me-1"></i> Tambah
                                            </button>
                                        </div>
                                    </form>
                                @else
                                    <button class="btn btn-secondary w-100" disabled>Stok Habis</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                {{-- Jika tidak ada produk yang ditemukan --}}
                <div class="col-12 text-center py-5">
                    <p class="lead text-muted">Maaf, saat ini belum ada produk yang tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection


@section('scripts')
    {{-- Skrip JQuery diperlukan untuk AJAX --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Tangani pengiriman form via AJAX
            $('.add-to-cart-form').on('submit', function(e) {
                e.preventDefault(); // Mencegah pengiriman form default

                var form = $(this);
                var productId = form.find('input[name="product_id"]').val(); // Ambil ID produk
                var quantity = form.find('input[name="quantity"]').val(); // Ambil kuantitas
                var url = form.attr('action'); // Ambil URL action dari form

                // Lakukan permintaan AJAX
                $.ajax({
                    type: "POST",
                    url: url, // Sesuaikan dengan route yang sebenarnya
                    data: {
                        _token: form.find('input[name="_token"]').val(), // Ambil token CSRF
                        product_id: productId,
                        quantity: quantity
                    },
                    success: function(response) {
                        // Tampilkan notifikasi sukses
                        var notification = $('#notification');
                        notification.fadeIn(300).delay(2000).fadeOut(
                            500); // Tampilkan, tunggu 2 detik, lalu sembunyikan

                        // Opsional: Perbarui ikon keranjang atau total item di navbar
                        console.log('Berhasil ditambahkan:', response);
                    },
                    error: function(xhr, status, error) {
                        // Tangani jika terjadi error
                        var errorMessage = xhr.responseJSON.message ||
                            "Gagal menambahkan produk.";
                        alert('Error: ' + errorMessage);
                        console.error("AJAX Error:", error);
                    }
                });
            });
        });
    </script>
@endsection
