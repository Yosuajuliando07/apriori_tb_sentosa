@extends('layouts.app_auth')

@section('title', 'Login')

@push('css')
@endpush

@section('content')

    <div class="row align-items-center">
        <div class="col-md-6 col-lg-7">
            <img src="{{ asset('assets/vendors/images/login-page-img.png') }}" alt="">
        </div>
        <div class="col-md-6 col-lg-5">
            <div class="login-box bg-white box-shadow border-radius-10">
                <div class="login-title">
                    <h2 class="text-center text-primary">Silahkan Masuk Untuk Memulai</h2>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group custom">
                        <input value="admin@sptlb.my.id" id="email" type="email"
                            class="form-control form-control-lg @error('email') is-invalid @enderror" name="email"
                            placeholder="Email" required autocomplete="off" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="input-group-append custom">
                            <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                        </div>
                    </div>


                    <div class="input-group custom">
                        <input value="admin123" id="password" type="password"
                            class="form-control form-control-lg @error('password') is-invalid @enderror" name="password"
                            placeholder="**********" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="input-group-append custom">
                            <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                        </div>
                    </div>


                    <div class="row pb-30">
                        <div class="col-6">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="tampilkan-password">
                                <label class="custom-control-label" for="tampilkan-password"><small>Tampilkan
                                        Password</small></label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="forgot-password">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">Lupa Password</a>
                                    {{-- <a type="button" onclick="pesan()">Lupa Password</a> --}}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group mb-0">
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Masuk
                                    Sekarang</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@push('js')
    <script>
        // Sumber : https://codepen.io/JanuriDP/pen/KWMqoB
        $(document).ready(function() {
            $('#tampilkan-password').click(function() {
                if ($(this).is(':checked')) {
                    $('#password').attr('type', 'text');
                } else {
                    $('#password').attr('type', 'password');
                }
            });
        });
    </script>

    {{-- PENGUJIAN --}}
    {{-- <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>

    <script>
        function pesan() {
            swal({
                icon: 'error',
                type: 'error',
                title: 'Fungsi Dinonaktifkan',
                text: 'Fungsi ini dinonaktifkan agar password tidak berubah-ubah selama proses pengujian antarmuka dan kinerja sistem :)',
                timer: 5500
            })
        }
    </script> --}}
    {{-- END PENGUJIAN --}}
@endpush
