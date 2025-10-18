<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // 1. Siapkan data produk (Idealnya ambil dari database, misal Product::all())
        //    Di sini, kita gunakan data simulasi sementara:
        $products = [
            [
                'id' => 1,
                'image' => 'images/balado.jpg',
                'alt' => 'Keripik Balado',
                'title' => 'Balado Pedas Manis',
                'stock' => 15,
                'price' => 15000,
            ],
            [
                'id' => 2,
                'image' => 'images/jagung manis.jpg',
                'alt' => 'Keripik Jagung Manis',
                'title' => 'Jagung Manis Gurih',
                'stock' => 20,
                'price' => 14000,
            ],
            // ... masukkan semua data produk lainnya di sini
        ];

        // 2. Kirim (pass) variabel $products ke view
        return view('pages.produk', [
            'products' => $products // Kunci 'products' adalah nama variabel ($products) di view
        ]);
        
        // Atau menggunakan metode compact:
        // return view('pages.produk', compact('products'));
    }
}