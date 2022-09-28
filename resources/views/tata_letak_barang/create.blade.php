@extends('layouts.app')

@section('title', 'Tata Letak Barang')

@push('css')
    <!-- cdn datetimepicker css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('js/datetimepicker/jquery.datetimepicker.min.css') }}">
@endpush

@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="card-box pd-20 height-100-p mb-30">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <img src="{{ asset('assets/vendors/images/rak.png') }}" alt="">
                </div>
                <div class="col-md-8">
                    <h4 class="font-20 weight-500 mb-10 text-capitalize">
                        Pengenalan Fitur <div class="weight-600 font-30 text-blue">Atur Tata Letak Barang!</div>
                    </h4>
                    <p class="font-18 max-width-600">Pengaturan Tata Letak Barang dilakukan dengan teknik Analisa Asosiasi
                        dari bidang ilmu data mining sehingga menghasilkan pola penjualan produk atau barang yang kemudian
                        dijadikan acuan dalam pengaturan
                        tata letak
                        barang.</p>
                </div>
            </div>
        </div>
        <div class="min-height-200px">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12 mb-30">
                    <div class="pd-20 card-box height-100-p">
                        <h4 class="mb-15 text-blue h4">Hitung Pola Tata Letak</h4>
                        <div class="alert alert-warning" role="alert">
                            <b>Minimum support</b> dan <b>minimum confidence</b> adalah nilai batas <em>(threshold)</em>
                            yang
                            nantinya
                            digunakan
                            untuk menentukan aturan asosiasi yang terbaik.

                            {{-- <dl class="row">
                                <dt class="col-sm-3 text-truncate">Minimum Support</dt>
                                <dd class="col-sm-9">Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum
                                    nibh, ut fermentum massa justo sit amet risus.</dd>
                            </dl> --}}
                        </div>
                        <form action="{{ route('tata-letak-barang.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="tanggal_awal">Tanggal Awal</label>
                                        <input name="tanggal_awal" id="tanggal_awal" class="form-control date-id"
                                            type="text" value="{{ $tanggal_awal }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="tanggal_akhir">Tanggal Akhir</label>
                                        <input name="tanggal_akhir" id="tanggal_akhir" class="form-control date-id"
                                            type="text" value="{{ $tanggal_akhir }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="min_support">Minimum Support (%)</label>
                                        <input name="min_support" id="min_support" class="form-control" type="number"
                                            min="1" max="100" required placeholder="1-100" value="25"
                                            autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="min_confidence">Minimum Confidence (%)</label>
                                        <input name="min_confidence" id="min_confidence" class="form-control" type="number"
                                            min="1" max="100" required placeholder="1-100" value="25"
                                            autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Hitung</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div id="simpleModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Customer Details Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    I love ASPSnippets!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> --}}

@endsection

@push('js')
    <script src="{{ asset('js/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
    <script src="{{ asset('js/datetimepicker/popper.min.js') }}"></script>
    <script src="{{ asset('js/datetimepicker/datetimepicker.js') }}"></script>

    {{-- https://stackoverflow.com/questions/8013429/how-do-i-detect-a-page-refresh-using-jquery --}}
    {{-- https://www.aspsnippets.com/Articles/Open-show-Bootstrap-Modal-Popup-on-Page-Load.aspx --}}
    {{-- https://www.codegrepper.com/code-examples/javascript/jquery+1+second+after+page+load --}}
    {{-- The setTimeout() method calls a function after a number of milliseconds.
        1 second = 1000 milliseconds.
        myTimeout = setTimeout(function, milliseconds); --}}
    <script src="https://unpkg.com/sweetalert2@11.4.20/dist/sweetalert2.all.js"></script>
    <script type="text/javascript">
        window.onbeforeunload = function() {
            setTimeout(function() {
                //https://sweetalert2.github.io/
                let timerInterval
                Swal.fire({
                    title: 'SEDANG MEMPROSES',
                    html: 'Rendahnya minimum support yang ditetapkan, membuat proses ini mungkin memerlukan waktu yang cukup lama',
                    // timer: 100000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                    },

                })
                // OpenBootstrapPopup();
            }, 10000); //10 detik

        };

        // function OpenBootstrapPopup() {
        //     $("#simpleModal").modal('show');
        // }
    </script>
@endpush
