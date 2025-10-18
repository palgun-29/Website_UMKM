<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Panggil Model yang dibutuhkan nanti
// use App\Models\Order;
// use App\Models\OrderItem;

class OrderController extends Controller
{
    /**
     * Menampilkan halaman form checkout.
     */
    public function show()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('produk')->with('error', 'Keranjang Anda kosong!');
        }

        // Tampilkan view checkout dan kirim data keranjang ke sana
        return view('checkout', ['cart' => $cart]);
    }

    /**
     * Menyimpan pesanan ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi data dari form (alamat, no. telp, dll.)
        // $request->validate([...]);

        // 2. Ambil data keranjang dari session
        $cart = session()->get('cart', []);

        // 3. Logika untuk menyimpan ke tabel 'orders' dan 'order_items'
        // ... (Ini bagian yang lebih kompleks, melibatkan transaksi database) ...

        // 4. Kosongkan keranjang setelah pesanan berhasil
        session()->forget('cart');

        // 5. Arahkan ke halaman "Terima Kasih" dengan pesan sukses
        return redirect()->route('home')->with('success', 'Pesanan Anda berhasil dibuat!');
    }
}