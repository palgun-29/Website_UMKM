@extends('layouts.main')

@section('title', 'Login')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-7 shadow-lg">
                <div id="login-form" class="p-5">
                    <h2 class="fw-bold mb-4">Login ke Akun Anda</h2>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="login-email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                id="login-email" placeholder="contoh@email.com" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="login-password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="login-password" required>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label" for="remember">Ingat Saya</label>
                            </div>
                            <a href="{{ route('password.request') }}">Lupa Password?</a>
                        </div>
                        <button type="submit" class="btn btn-dark w-100 py-2">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection