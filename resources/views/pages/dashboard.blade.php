@extends('layouts.main')

@section('title', 'Beranda')

@section('content')
    <div class="container-fluid text-center bg-light p-5">
        <h1 class="display-4">Renyahnya Juara, Bumbunya Meresap Sempurna!</h1>
        <p class="lead">Kriuk Kresna, keripik singkong premium dari bahan baku pilihan dan resep warisan keluarga.</p>
        <a href="/produk" class="btn btn-dark btn-lg">Lihat Varian Rasa</a>
    </div>

    <div class="container text-center my-5">
        <h2>Kenapa Pilih Kriuk Kresna?</h2>
        <div class="row mt-4">
            <div class="col-md-4">
                <h3>Singkong Pilihan</h3>
                <p>Kami hanya menggunakan singkong mentega dari petani lokal terbaik.</p>
            </div>
            <div class="col-md-4">
                <h3>Bumbu Asli</h3>
                <p>Diramu dari rempah-rempah asli Indonesia, tanpa perasa buatan.</p>
            </div>
            <div class="col-md-4">
                <h3>Tanpa Pengawet</h3>
                <p>Aman dan sehat untuk dinikmati oleh seluruh anggota keluarga.</p>
            </div>
        </div>
    </div>
@endsection