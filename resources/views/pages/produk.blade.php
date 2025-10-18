@extends('layouts.main')

@section('title', 'Produk Kami')

{{-- CSS Tambahan untuk Tombol Kuantitas --}}
@push('styles')
<style>
    /* CSS BARU */
    .quantity-selector .form-control {
        background-color: #fff !important; /* Agar tidak terlihat abu-abu */
        border-left: 0;
        border-right: 0;
        border-radius: 0;
    }
    .quantity-selector .btn {
        border-color: #ced4da;
    }
</style>
@endpush


@section('content')
    <div class="container my-5">
        <header class="text-center mb-5">
            <h1 class="display-4 fw-bold text-dark">Varian Rasa Juara</h1>
            <p class="lead text-muted">Pilih rasa favoritmu yang siap menemani setiap momen santaimu. 🤩</p>
        </header>

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div id="ajax-notification" class="alert alert-success" style="display:none; position: fixed; top: 80px; right: 20px; z-index: 1050;"></div>

        {{-- Area Tampilan Produk --}}
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @forelse ($products as $product)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0 product-card">
                        <img src="{{ asset($product->image ?? 'images/default.jpg') }}" class="card-img-top p-2"
                            alt="{{ $product->alt ?? $product->title }}"
                            style="object-fit: contain; height: 200px; width: 100%;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">{{ $product->title }}</h5>
                            <p class="card-text text-success fw-bold mb-2">
                                Rp{{ number_format($product->price, 0, ',', '.') }}
                            </p>
                            @php $isAvailable = $product->stock > 0; @endphp
                            <p class="card-text mb-3">
                                <span class="badge rounded-pill {{ $isAvailable ? 'bg-success' : 'bg-danger' }}">
                                    Stok: {{ $isAvailable ? $product->stock : 'Habis' }}
                                </span>
                            </p>
                            <div class="mt-auto">
                                @if ($isAvailable)
                                    <button class="btn btn-warning w-100 fw-bold" type="button" data-bs-toggle="modal"
                                        data-bs-target="#productModal"
                                        data-id="{{ $product->id }}"
                                        data-title="{{ $product->title }}"
                                        data-stock="{{ $product->stock }}"
                                        data-price="{{ number_format($product->price, 0, ',', '.') }}"
                                        data-image="{{ asset($product->image ?? 'images/default.jpg') }}"
                                        data-description="{{ $product->description ?? 'Deskripsi produk ini belum tersedia.' }}">
                                        Lihat Detail & Beli
                                    </button>
                                @else
                                    <button class="btn btn-secondary w-100 mt-2" disabled>Stok Habis</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-box2-heart fs-1 text-muted"></i>
                    <p class="lead text-muted mt-3">Maaf, saat ini belum ada produk yang tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- MODAL UNTUK DETAIL PRODUK --}}
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold" id="modalTitle">Detail Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 d-flex justify-content-center align-items-center mb-3 mb-md-0">
                            <img id="modalImage" src="" alt="Gambar Produk" class="img-fluid rounded shadow-sm" style="max-height: 250px; object-fit: contain;">
                        </div>
                        <div class="col-md-6">
                            <h3 id="modalProductName" class="fw-bold mb-1"></h3>
                            <p id="modalPrice" class="text-success fs-4 fw-bold"></p>
                            <hr>
                            <p class="mb-1"><strong>Deskripsi:</strong></p>
                            <p id="modalDescription" class="text-muted"></p>
                            <p class="mt-3 mb-2"><strong>Stok:</strong> <span id="modalStockBadge" class="badge rounded-pill"></span></p>

                            <form id="modalAddToCartForm" action="{{ route('cart.add') }}" method="POST" class="mt-4">
                                @csrf
                                <input type="hidden" name="product_id" id="modalProductId">

                                {{-- ## BAGIAN YANG DIUBAH (HTML) ## --}}
                                <div class="input-group quantity-selector">
                                    <button class="btn btn-outline-secondary btn-minus" type="button">-</button>
                                    <input type="text" class="form-control text-center quantity-input" name="quantity" value="1" min="1" readonly>
                                    <button class="btn btn-outline-secondary btn-plus" type="button">+</button>
                                    <button class="btn btn-warning fw-bold" type="submit" id="modalSubmitButton" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                                        <i class="fas fa-shopping-cart me-2"></i> Tambah
                                    </button>
                                </div>
                                {{-- ## AKHIR BAGIAN YANG DIUBAH ## --}}

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var modal = $('#productModal');

            // Fungsi untuk mengisi data modal
            modal.on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var stock = button.data('stock');

                // Isi semua data seperti sebelumnya
                modal.find('#modalTitle').text('Detail: ' + button.data('title'));
                modal.find('#modalProductName').text(button.data('title'));
                modal.find('#modalDescription').text(button.data('description'));
                modal.find('#modalImage').attr('src', button.data('image'));
                modal.find('#modalPrice').text('Rp' + button.data('price'));
                modal.find('#modalProductId').val(button.data('id'));

                // Set atribut max pada input kuantitas dan reset nilainya
                var quantityInput = modal.find('.quantity-input');
                quantityInput.attr('max', stock).val(1); // Set max stock dan reset ke 1

                var stockBadge = modal.find('#modalStockBadge');
                var submitButton = modal.find('#modalSubmitButton');

                if (stock > 0) {
                    stockBadge.removeClass('bg-danger').addClass('bg-success').text('Tersedia: ' + stock);
                    submitButton.prop('disabled', false);
                    quantityInput.prop('readonly', false); // Aktifkan input jika ada stok
                } else {
                    stockBadge.removeClass('bg-success').addClass('bg-danger').text('Habis');
                    submitButton.prop('disabled', true);
                    quantityInput.prop('readonly', true); // Non-aktifkan jika stok habis
                }
            });

            // ## LOGIKA BARU UNTUK TOMBOL PLUS DAN MINUS (JAVASCRIPT) ##
            modal.on('click', '.btn-plus', function() {
                var input = $(this).siblings('.quantity-input');
                var max = parseInt(input.attr('max'));
                var currentVal = parseInt(input.val());
                if (currentVal < max) {
                    input.val(currentVal + 1);
                }
            });

            modal.on('click', '.btn-minus', function() {
                var input = $(this).siblings('.quantity-input');
                var currentVal = parseInt(input.val());
                if (currentVal > 1) {
                    input.val(currentVal - 1);
                }
            });
            // ## AKHIR LOGIKA BARU ##

            // Logika AJAX untuk submit form (tetap sama)
            $('#modalAddToCartForm').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);
                $.ajax({
                    type: "POST",
                    url: form.attr('action'),
                    data: form.serialize(),
                    success: function(response) {
                        modal.modal('hide');
                        var notification = $('#ajax-notification');
                        notification.text(response.message || 'Produk berhasil ditambahkan!').fadeIn(300).delay(2500).fadeOut(500);
                        var cartCount = response.cartCount || 0;
                        $('#cart-count').text(cartCount).toggle(cartCount > 0);
                    },
                    error: function(xhr) {
                        alert('Error: ' + (xhr.responseJSON.message || "Gagal menambahkan produk."));
                    }
                });
            });
        });
    </script>
@endpush