@extends('layouts.app')

@section('title', 'Edit Data Transaksi')

@push('css')
    <!-- cdn datetimepicker css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('js/datetimepicker/jquery.datetimepicker.min.css') }}">
@endpush

@section('content')

    <!-- Select-2 Start -->
    <div class="pd-20 card-box mb-30">
        <form method="POST" action="{{ route('transaksi.update', $transaksiBarang->id) }}">
            @csrf
            @method('PUT')
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue h4">Barang</h4>
                    <p class="mb-30">Jenis bahan bangunan</p>
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
                                <option value="{{ $item->id }}" @if ($item->id == $transaksiBarang->barang_id) selected @endif>
                                    {{ $item->jenis_bahan_bangunan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <hr>
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue h4">Transaksi</h4>
                    <p class="mb-30">Kode Transaksi</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <select class="custom-select2 form-control" name="kode_transaksi"
                            style="width: 100%; height: 38px;">
                            <option selected disabled>{{ __('pilih data') }}</option>
                            @foreach ($transaksi as $item)
                                <option value="{{ $item->id }}" @if ($item->id == $transaksiBarang->transaksi_id) selected @endif>
                                    {{ $item->kode_transaksi }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
        </form>
    </div>

@endsection

@push('js')
    <script src="{{ asset('js/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
    <script src="{{ asset('js/datetimepicker/popper.min.js') }}"></script>
    <script src="{{ asset('js/datetimepicker/datetimepicker.js') }}"></script>
    <script src="{{ asset('js/validation/form_input.js') }}"></script>
@endpush
