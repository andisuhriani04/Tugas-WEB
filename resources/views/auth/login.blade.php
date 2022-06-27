<!DOCTYPE html>
<html lang="en">
@include('layouts/head')

<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
                                    </div>
                                    @if (session()->has('berhasil'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('berhasil') }}
                                    </div>
                                    @endif
                                    @if (session()->has('gagal'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('gagal') }}
                                    </div>
                                    @endif
                                    <form action="{{ route('authenticate') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="nama_pengguna">Nama Pengguna</label>
                                            <input type="text"
                                                class="form-control @error('nama_pengguna')is-invalid @enderror"
                                                id="nama_pengguna" name="nama_pengguna"
                                                value="{{ old('nama_pengguna') }}">
                                            @error('nama_pengguna')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Kata Sandi</label>
                                            <input type="password"
                                                class="form-control @error('password')is-invalid @enderror"
                                                id="password" name="password" value="{{ old('password') }}">
                                            @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <button type="submit"
                                            class="mt-2 col-12 d-none d-sm-inline-block btn btn-primary shadow-sm">
                                            <i class="fas fa-sign-in-alt mr-2"></i>Masuk
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('home') }}">Scrumptious</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('register') }}">Buat akun baru?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts/script')
</body>

</html>