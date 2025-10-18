<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AppController extends Controller
{
    // --- 1. Method untuk Halaman Beranda ---
    public function home()
    {
        // Beranda tidak memerlukan data spesifik saat ini
        return view('pages.dashboard');
    }

    // --- 2. Method untuk Halaman Produk ---
    public function produk()
    {
        // 1. Ambil SEMUA data dari tabel products
        $products = Product::all();

        // 2. Kirim data itu ke view dengan nama variabel 'products'
        return view('pages.produk', ['products' => $products]);
    }

    // --- 3. Method untuk Logika Tambah ke Keranjang (Cart) ---
    public function addToCart(Request $request)
    {
        // Di sini Anda akan menambahkan logika untuk menyimpan
        // product_id dan quantity ke Session atau database.

        // Contoh sederhana:
        // session()->push('cart', [
        //     'product_id' => $request->product_id,
        //     'quantity' => $request->quantity
        // ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function keranjang()
    {
        // Logika untuk mengambil data keranjang dari Session atau Database
        $cartItems = session('cart', []); // Ambil item dari session

        // Kirim data ke view
        return view('pages.keranjang', compact('cartItems'));
    }

    public function pesanan()
    {
        // Logika untuk mengambil riwayat pesanan (biasanya untuk user yang sedang login)
        // $orders = auth()->user()->orders; // Jika sudah menggunakan sistem Auth

        $orders = []; // Data simulasi jika belum ada sistem Auth

        // Kirim data ke view
        return view('pages.pesanan', compact('orders'));
    }
}