<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Menampilkan halaman keranjang belanja.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $subtotal = 0;

        // Hitung subtotal dari semua item di keranjang
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        // Anda bisa menambahkan logika biaya pengiriman di sini jika perlu
        $shippingCost = 10000; // Contoh biaya pengiriman
        $total = $subtotal + $shippingCost;

        return view('pages.keranjang', compact('cart', 'subtotal', 'shippingCost', 'total'));
    }

    /**
     * Menambahkan produk ke keranjang.
     */
    public function add(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Input tidak valid.'], 400);
        }

        // Ambil produk dari database
        $product = Product::find($request->product_id);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Produk tidak ditemukan.'], 404);
        }

        // Ambil keranjang dari session, atau buat array kosong jika belum ada
        $cart = session()->get('cart', []);
        $productId = $product->id;

        // Jika produk sudah ada di keranjang, tambahkan jumlahnya
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $request->quantity;
        } else {
            // Jika belum ada, tambahkan sebagai item baru
            $cart[$productId] = [
                "title" => $product->title,
                "quantity" => $request->quantity,
                "price" => $product->price,
                "image" => $product->image ? asset('storage/' . $product->image) : asset('images/default.jpg')
            ];
        }

        // Simpan kembali keranjang ke session
        session()->put('cart', $cart);

        // Kembalikan response JSON untuk AJAX
        return response()->json([
            'success'   => true,
            'message'   => 'Produk berhasil ditambahkan!',
            'cartCount' => count(session('cart', []))
        ]);
    }

    /**
     * Menghapus item dari keranjang.
     */
    public function remove(Request $request)
    {
        $request->validate(['product_id' => 'required|integer']);

        $cart = session()->get('cart', []);
        $productId = $request->product_id;

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    /**
     * Memperbarui jumlah item di keranjang.
     */
    public function update(Request $request)
    {
        $request->validate([
            'quantities' => 'required|array'
        ]);

        $cart = session()->get('cart', []);

        foreach ($request->quantities as $id => $quantity) {
            if (isset($cart[$id]) && $quantity > 0) {
                $cart[$id]['quantity'] = $quantity;
            }
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil diperbarui.');
    }
}
