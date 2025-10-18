@extends('layouts.main')

@section('title', 'Daftar')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-7 shadow-lg">
                <div id="register-form" class="p-5">
                    <h2 class="fw-bold mb-4">Buat Akun Baru</h2>
                    <form action="{{ route('register') }}" method="POST">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nama Anda" value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="contoh@email.com" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                        </div>

                        <div class="d-flex justify-content-end align-items-center mb-4">
                            <a href="{{ route('login') }}">Sudah punya akun?</a>
                        </div>

                        <button type="submit" class="btn btn-dark w-100 py-2">Daftar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
