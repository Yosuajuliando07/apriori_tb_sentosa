@extends('layouts.app')

@section('title', 'Edit Profil')

@push('css')
@endpush

@section('content')

    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="pull-right">
            <a href="{{ route('pengaturan.akun') }}" type="button" class="btn text-primary">Kembali</a>
        </div>
        <div class="min-height-200px">
            <div class="row justify-content-md-center mt-5">
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
                    <div class="card height-100-p overflow-hidden">

                        <div class="profile-tab height-100-p">
                            <div class="tab height-100-p">
                                <ul class="nav nav-tabs customtab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#edit-profil" role="tab">Edit
                                            Profil</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#ubah-password" role="tab"
                                            aria-selected="false">Ubah Password</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <!-- Setting Tab start -->
                                    <div class="tab-pane fade height-100-p show active" id="edit-profil" role="tabpanel">
                                        <div class="profile-setting">
                                            <div class="pd-20 card-box mb-30">
                                                <form method="POST" action="{{ route('update.profil') }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label for="nama">Nama</label>
                                                                <input id="nama" value="{{ Auth::user()->nama }}"
                                                                    name="nama"
                                                                    class="form-control form-control-sm only_alphabets"
                                                                    type="text" required autocomplete="off">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label for="email">Email</label>
                                                                <input id="email" value="{{ Auth::user()->email }}"
                                                                    name="email" class="form-control form-control-sm"
                                                                    type="email" required autocomplete="off">
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-0 col-md-12">
                                                            <button type="submit"
                                                                class="btn btn-primary btn-sm">Simpan</button>
                                                        </div>
                                                        {{-- <div class="form-group mb-0 col-md-12">
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                disabled>Simpan</button>
                                                        </div> --}}
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Setting Tab End -->



                                    <!-- Setting Tab start -->
                                    <div class="tab-pane fade height-100-p" id="ubah-password" role="tabpanel">
                                        <div class="profile-setting">
                                            <div class="pd-20 card-box mb-30">
                                                <form method="POST" action="{{ route('ubah.password') }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label for="old_password">Password Lama</label>
                                                                <input id="old_password" name="old_password"
                                                                    class="form-control form-control-sm inp-password"
                                                                    type="password" required autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label for="password">Password Baru</label>
                                                                <input id="password" name="password"
                                                                    class="form-control form-control-sm inp-password"
                                                                    type="password" required autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                <label for="password-confirm">Konfirmasi Password
                                                                    Baru</label>
                                                                <input id="password-confirm" name="password_confirmation"
                                                                    class="form-control form-control-sm inp-password @error('password') is-invalid @enderror"
                                                                    type="password" required autocomplete="off">
                                                                @error('password')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="form-group ml-3 col-md-6 custom-control custom-checkbox">
                                                            <input id="tampilkan-password" type="checkbox"
                                                                class="custom-control-input">
                                                            <label for="tampilkan-password"
                                                                class="custom-control-label">Tampilkan
                                                                password</label>
                                                        </div>
                                                        <div class="form-group mb-0 col-md-12">
                                                            <button type="submit"
                                                                class="btn btn-primary btn-sm">Simpan</button>
                                                        </div>
                                                        {{-- <div class="form-group mb-0 col-md-12">
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                disabled>Simpan</button>
                                                        </div> --}}
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Setting Tab End -->

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        //Sumber : https://codepen.io/sreerajavk/pen/OBWrjM
        function ambilGambar() {
            $('#gambar').click();
        }
        $('#gambar').change(function() {
            var imgPath = this.value;
            var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            if (ext == "gif" || ext == "png" || ext == "jpg" || ext == "jpeg")
                readURL(this);
            else
                alert("Silakan pilih file gambar format(jpg, jpeg, png).")
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.readAsDataURL(input.files[0]);
                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result);
                };
            }
        }
        // Sumber : https://codepen.io/JanuriDP/pen/KWMqoB
        $(document).ready(function() {
            $('#tampilkan-password').click(function() {
                if ($(this).is(':checked')) {
                    $('.inp-password').attr('type', 'text');
                } else {
                    $('.inp-password').attr('type', 'password');
                }
            });
        });
    </script>
    <script src="{{ asset('js/validation/form_input.js') }}"></script>
@endpush
