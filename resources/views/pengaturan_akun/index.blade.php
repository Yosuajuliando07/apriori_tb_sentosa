@extends('layouts.app')

@section('title', 'Pengaturan Akun')

@push('css')
@endpush

@section('content')
    <div class="pd-20 bg-white border-radius-4 box-shadow">
        <div class="min-height-200px">
            <div class="row justify-content-md-center mt-5">
                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 mb-30">
                    <div class="pd-20 card ">
                        <form method="POST" action="{{ route('ubah.foto.profil') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="profile-photo">
                                <a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i
                                        class="fa fa-pencil"></i></a>
                                <img src="{{ asset('/storage/akun/' . Auth::user()->gambar) }}"
                                    alt="{{ Auth::user()->nama }}" class="avatar-photo">
                                <div class="modal fade" id="modal" tabindex="-1" role="dialog"
                                    aria-labelledby="modalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body card">
                                                <img id="preview" class="avatar-photo"
                                                    src="{{ asset('/storage/akun/' . Auth::user()->gambar) }}"
                                                    alt="Card image">
                                                <input name="gambar" type="file" id="gambar"
                                                    style="display: none;" />
                                                <a href="javascript:ambilGambar()"
                                                    class="btn btn-block btn-sm text-primary"><b>Ubah Foto
                                                        Profil</b></a>
                                                <div class="form-group text-center">
                                                    <button type="button" data-dismiss="modal" class="btn"
                                                        data-bgcolor="#f46f30" data-color="#ffffff"
                                                        style="color: rgb(255, 255, 255); background-color: #f46f30;">
                                                        Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <h5 class="text-center h5 mb-0">{{ Auth::user()->nama }} </h5>
                        <p class="text-center text-muted font-14">Administrator </p>
                        <a href="{{ route('edit.profil') }}" type="button" class="btn btn-light btn-sm btn-block">Edit
                            Profil</a>
                        <br>

                        <div class="profile-info">
                            <ul>
                                <li>
                                    <span><b style="color:rgb(88, 73, 73);">Nama :</b> {{ Auth::user()->nama }}</span>

                                </li>
                                <li>
                                    <span><b style="color:rgb(88, 73, 73);">Email :</b> {{ Auth::user()->email }}</span>

                                </li>
                            </ul>
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
            if (ext == "png" || ext == "jpg" || ext == "jpeg")
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
    </script>
@endpush
