@extends('layouts.app')

@section('title', 'Tambah Data Transaksi Manual')

@push('css')
    <!-- cdn datetimepicker css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('js/datetimepicker/jquery.datetimepicker.min.css') }}">
@endpush

@section('content')

    <!-- Select-2 Start -->
    <div class="pd-20 card-box mb-30">
        <form method="POST" action="{{ route('transaksi.store') }}">
            @csrf
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue h4">Barang</h4>
                    <p class="mb-30">Jenis Bahan Bangunan Baru, <a class="text-primary" data-toggle="modal"
                            data-target="#barang-modal" type="button">
                            klik disini</a></p>
                </div>
                <div class="pull-right">
                    <a href="{{ route('transaksi.index') }}" type="button" class="btn text-primary">Kembali</a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <select class="custom-select2 form-control" name="jenis_bahan_bangunan"
                            style="width: 100%; height: 38px;">
                            <option selected disabled>{{ __('pilih data') }}</option>
                            @foreach ($barang as $item)
                                <option value="{{ $item->id }}">{{ $item->jenis_bahan_bangunan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <hr>
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue h4">Transaksi</h4>
                    <p class="mb-30">Kode Transaksi Baru, <a class="text-primary" data-toggle="modal"
                            data-target="#transaksi-modal" type="button">
                            klik disini</a></p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <select class="custom-select2 form-control" name="kode_transaksi"
                            style="width: 100%; height: 38px;">
                            <option selected disabled>{{ __('pilih data') }}</option>
                            @foreach ($transaksi as $item)
                                <option value="{{ $item->id }}">{{ $item->kode_transaksi }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
        </form>
    </div>


    {{-- BARANG MODAL --}}
    <div class="modal fade" id="barang-modal" tabindex="-1" role="dialog" aria-labelledby="barangModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="barangModalLabel">Tambah Barang</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-md-12 col-sm-12 ">
                            <div class="pd-20 height-100-p">
                                <form action="{{ route('tb.barang.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="jns">Jenis Bahan Bangunan</label>
                                                <input id="jns" name="jenis_bahan_bangunan" type="text"
                                                    class="form-control" autofocus autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block btn-sm">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- END BARANG MODAL --}}


    {{-- TRANSAKSI MODAL --}}
    <div class="modal fade" id="transaksi-modal" tabindex="-1" role="dialog" aria-labelledby="transaksiModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h6 class="modal-title" id="transaksiModalLabel">Tambah Transaksi</h6> --}}
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-md-12 col-sm-12 ">
                            <div class="pd-20 height-100-p">
                                <form action="{{ route('tb.transaksi.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="kode_transaksi">Kode Transaksi</label>
                                                <input id="kode_transaksi" name="kode_transaksi" type="text"
                                                    class="form-control nosymbol" autofocus autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="tanggal_transaksi">Tanggal Transaksi</label>
                                                <input id="tanggal_transaksi" name="tanggal_transaksi" type="text"
                                                    class="form-control date-id" autofocus autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block btn-sm">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- END TRANSAKSI MODAL --}}

@endsection

@push('js')
    <script src="{{ asset('js/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
    <script src="{{ asset('js/datetimepicker/popper.min.js') }}"></script>
    <script src="{{ asset('js/datetimepicker/datetimepicker.js') }}"></script>
    <script src="{{ asset('js/validation/form_input.js') }}"></script>
@endpush
