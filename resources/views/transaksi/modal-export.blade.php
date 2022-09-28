<!-- Modal Export-->
<div class="modal fade" id="modal-export-data-transaksi" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="myLargeModalLabel">Filter Data (Export)</h6>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-12 col-sm-12 ">
                        <div class="pd-20 height-100-p">
                            <form action="{{ route('export.transaksi') }}" method="GET">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="filterTglAwal">Tanggal Awal</label>
                                            <input name="filterTglAwal" id="filterTglAwal" class="form-control date-id"
                                                type="text" required value="{{ $tanggal_awal }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="filterTglAkhir">Tanggal Akhir</label>
                                            <input name="filterTglAkhir" id="filterTglAkhir"
                                                class="form-control date-id" type="text" required
                                                value="{{ $tanggal_akhir }}">
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-block btn-sm" type="submit">Export (.xlsx)</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Modal Export-->
