<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // Menampilkan halaman Beranda
    public function beranda()
    {
        return view('pages.beranda');
    }

    // Menampilkan halaman Produk
    public function produk()
    {
        return view('pages.produk');
    }

    // Menampilkan halaman Tentang Kami
    public function tentang()
    {
        return view('pages.tentang');
    }

    // Menampilkan halaman Kontak
    public function kontak()
    {
        return view('pages.kontak');
    }
}