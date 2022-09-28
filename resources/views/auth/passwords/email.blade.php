@extends('layouts.app_auth')

@section('title', 'Reset Password')

@push('css')
@endpush

@section('content')

    <div class="row align-items-center">
        <div class="col-md-6">
            <img src="{{ asset('assets/vendors/images/forgot-password.png') }}" alt="@yield('title')">
        </div>
        <div class="col-md-6">
            <div class="login-box bg-white box-shadow border-radius-10">
                <div class="login-title">
                    <h2 class="text-center text-primary">Reset Password</h2>
                </div>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif


                <h6 class="mb-20">Masukkan alamat email Anda untuk mengatur ulang password yang baru</h6>
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="input-group custom">
                        <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                            placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="off"
                            autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <div class="input-group-append custom">
                            <span class="input-group-text"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                        </div>
                    </div>

                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="input-group mb-0">
                                <!--
                                       use code for form submit
                                       <input class="btn btn-primary btn-lg btn-block" type="submit" value="Submit">
                                      -->
                                {{-- <a class="btn btn-primary btn-lg btn-block" href="index.html">Submit</a> --}}

                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    Kirim Tautan Atur Ulang Password
                                </button>


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
@endpush
