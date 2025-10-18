@extends('layouts.main')

@section('title', 'Lupa Password')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">

                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0">Reset Password Anda</h4>
                    </div>
                    <div class="card-body p-4">

                        <p class="mb-4 text-muted">
                            Lupa password Anda? Tidak masalah. Cukup beritahu kami alamat email Anda dan kami akan
                            mengirimkan tautan untuk mengatur ulang password Anda.
                        </p>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">Alamat Email</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autofocus>

                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-dark py-2">
                                    Kirim Tautan Reset Password
                                </button>
                            </div>

                        </form>

                        <div class="text-center mt-4">
                            <a href="{{ route('login') }}">Kembali ke halaman Login</a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
