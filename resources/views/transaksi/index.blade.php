@extends('layouts.app')

@section('title', 'Kelola Data Transaksi')

@push('css')
    <!-- CSS -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
    <!-- cdn datetimepicker css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('js/datetimepicker/jquery.datetimepicker.min.css') }}">
@endpush

@section('content')
    @include('transaksi.modal-import')
    @include('transaksi.modal-export')

    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">

            <!-- Simple Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">

                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Data Transaksi</h4>
                            <p class="mb-0 text-right">Kelola data lebih lanjut
                                <button type="button" class="btn btn-light btn-sm text-primary" data-toggle="modal"
                                    data-target="#modal-export-data-transaksi">Export</button>
                            </p>

                        </div>
                        <div class="pull-right">
                            <div class="dropdown show">
                                <a class="btn btn-primary btn-sm dropdown-toggle" href="javascript:void(0)" role="button"
                                    data-toggle="dropdown" aria-expanded="true">
                                    Tambah Data
                                </a>
                                <div class="dropdown-menu dropdown-menu-right"
                                    style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(170px, 40px, 0px);"
                                    x-placement="bottom-end">
                                    <a class="dropdown-item" data-toggle="modal" data-target="#modal-import-data-transaksi"
                                        type="button">Import Data</a>
                                    <a class="dropdown-item" href="{{ route('transaksi.create') }}">Tambah Data Manual</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-20">
                    <table id="tb_transaksi" class="table stripe hover nowrap dataTable no-footer dtr-inline collapsed">
                        <thead>
                            <tr>
                                <th>No. Tabel</th>
                                <th>Kode Transaksi</th>
                                <th>Tanggal Transaksi</th>
                                <th>Jenis Bahan Bangunan</th>
                                <th class="datatable-nosort">Aksi</th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
            <!-- Simple Datatable End -->







        </div>
    </div>



    {{-- MODAL HAPUS --}}
    <div class="modal fade" id="konfirmasi-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h4 class="padding-top-30 mb-30 weight-500">Anda yakin tetap melanjutkan penghapusan data?</h4>
                    <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                        <div class="col-6">
                            <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn"
                                data-dismiss="modal"><i class="fa fa-times"></i></button>
                            TIDAK
                        </div>
                        <div class="col-6">
                            <button name="tombol-hapus" id="tombol-hapus" type="button"
                                class="btn btn-primary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i
                                    class="fa fa-check"></i></button>
                            YA
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- END MODAL HAPUS --}}

@endsection

@push('js')
    <!-- js -->
    <script src="{{ asset('assets/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
        $(document).ready(function() {
            $('#tb_transaksi').DataTable({
                "autoWidth": false,
                "responsive": true,
                processing: true,
                serverSide: true,

                //https://www.youtube.com/watch?v=ukyrS43kbSc
                //https://datatables.net/plug-ins/i18n/Indonesian
                language: {
                    url: "{{ asset('js/datatable_indonesia.json') }}"
                },

                ajax: {
                    url: "{{ route('transaksi.index') }}",
                    type: 'GET'
                },
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: true,
                        orderable: false
                    },
                    {
                        data: 'kode_transaksi',
                        name: 'kode_transaksi'
                    },

                    {
                        data: 'tgl_transaksi',
                        name: 'tgl_transaksi'
                    },

                    {
                        data: 'jenis_bahan_bangunan',
                        name: 'jenis_bahan_bangunan'
                    },

                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
            });
        });

        $(document).on('click', '.delete', function() {
            dataId = $(this).attr('id');
            $('#konfirmasi-modal').modal('show');
        });
        $('#tombol-hapus').click(function() {
            $.ajax({
                url: "transaksi/" + dataId,
                type: 'delete',
                beforeSend: function() {
                    $('#tombol-hapus').text('Hapus Data');
                },
                success: function(data) {
                    setTimeout(function() {
                        $('#konfirmasi-modal').modal('hide');
                        var oTable = $('#tb_transaksi').dataTable();
                        oTable.fnDraw(false);
                    });
                }
            })
        });
    </script>

    <script>
        $('#inputGroupFile02').on('change', function() {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
    </script>
    <script src="{{ asset('js/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
    <script src="{{ asset('js/datetimepicker/popper.min.js') }}"></script>
    <script src="{{ asset('js/datetimepicker/datetimepicker.js') }}"></script>
@endpush
