@extends('layouts.app_auth')

@section('title', 'Reset Password')

@push('css')
@endpush

@section('content')

    <div class="row align-items-center">
        <div class="col-md-6">
            <img src="{{ asset('assets/vendors/images/forgot-password.png') }}" alt="Riset Password">
        </div>
        <div class="col-md-6">
            <div class="login-box bg-white box-shadow border-radius-10">
                <div class="login-title">
                    <h2 class="text-center text-primary">Reset Password</h2>
                </div>
                <h6 class="mb-20">Masukkan Email, Password Baru, dan Konfirmasi Password Baru</h6>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="input-group custom">
                        <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                            placeholder="Email" name="email" value="{{ $email ?? old('email') }}" required
                            autocomplete="off" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <div class="input-group-append custom">
                            <span class="input-group-text"><i class="dw dw-email"></i></span>
                        </div>
                    </div>

                    <div class="input-group custom">
                        <input type="password"
                            class="password form-control form-control-lg @error('password') is-invalid @enderror"
                            placeholder="Password Baru" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <div class="input-group-append custom">
                            <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                        </div>
                    </div>

                    <div class="input-group custom">
                        <input type="password" class="password form-control form-control-lg"
                            placeholder="Konfirmasi Password Baru" name="password_confirmation" required
                            autocomplete="new-password">
                        <div class="input-group-append custom">
                            <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                        </div>
                    </div>

                    <div class="row align-items-center">
                        <div class="col-7">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="tampilkan-password">
                                <label class="custom-control-label" for="tampilkan-password"><small>Tampilkan
                                        Password</small></label>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="input-group mb-0">
                                <button type="submit" class="btn btn-primary btn-sm btn-block">Kirimkan</button>
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
                    $('.password').attr('type', 'text');
                } else {
                    $('.password').attr('type', 'password');
                }
            });
        });
    </script>
@endpush
