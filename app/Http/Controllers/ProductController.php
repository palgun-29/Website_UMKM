<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // 1. Ambil data produk dari database
        $products = Product::latest()->get();

        // 2. Kirim (pass) variabel $products ke view
        return view('pages.produk', compact('products'));
    }
}