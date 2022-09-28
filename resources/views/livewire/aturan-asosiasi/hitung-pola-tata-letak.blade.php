{{-- rule 2: support 5:  5 Januari 2022 - 5 Maret 2022 --}}

<div class="pd-ltr-20 xs-pd-20-10">


    <div class="row pb-10">
        <div class="col-xl-6 col-lg-6 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">{{ $tglAwal }} - {{ $tglAkhir }}
                        </div>
                        <div class="font-14 text-secondary weight-500">Range Tanggal Transaksi</div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#00eccf" style="color: rgb(0, 236, 207);"><i
                                class="icon-copy dw dw-calendar1"></i></div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">{{ $min_support }}%</div>
                        <div class="font-14 text-secondary weight-500">Minimum Support</div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon"><i class="icon-copy fa fa-arrows-h" aria-hidden="true"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">{{ $min_confidence }}%</div>
                        <div class="font-14 text-secondary weight-500">Minimum Confidence</div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon"><i class="icon-copy fa fa-arrows-h" aria-hidden="true"></i></div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="min-height-200px">
        <div class="pd-20 card-box mb-30">
            <div class="clearfix mb-20">
                <div class="pull-left">
                    <h4 class="text-blue h4">DATA TRANSAKSI</h4>
                </div>
                <div class="pull-right">
                    <a href="{{ route('tata-letak-barang.create') }}" class="btn btn-primary btn-sm"> Kembali</a>
                </div>
            </div>


            <div class="table-responsive">
                <table class="table table-bordered ">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col" class="w-25">Kode Transaksi</th>
                            <th scope="col">Jenis Bahan Bangunan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($data_transaksi as $key => $data)
                            <?php $i++; ?>
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $key }}</td>
                                {{-- htmlspecialchars(): Argument #1 ($string) must be of type string, array given --}}
                                <td>{{ implode(', ', $data) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if (count($data_transaksi) >= 10 && count($data_transaksi) != $stopLoadTransaksi)
                <button wire:click.prevent="loadDataTransaksi" class="btn btn-primary btn-sm btn-block">Tampilkan Lebih
                    Banyak
                </button>
            @endif
        </div>
    </div>

    {{-- ITERASI 1 --}}
    <div class="min-height-200px">
        <!-- Bordered table  start -->
        <div class="pd-20 card-box mb-30">
            <div class="clearfix mb-20">
                <div class="pull-left">
                    <h4 class="text-blue h4">C1 (Kandidat 1-itemset)</h4>
                    <small>
                        <p>Jika terdapat tabel berwarna <code>Merah</code> maka item tersebut kurang dari batasan
                            minimum
                            support <strong>{{ $min_support }}%</strong>
                        </p>
                    </small>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No </th>
                        <th scope="col">Item</th>
                        <th scope="col">Total</th>
                        <th scope="col">Support(%)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0; ?>
                    @foreach ($kandidat1 as $K1)
                        <?php $i++; ?>
                        <tr class="{{ $K1['support_persen'] < $min_support ? 'table-danger' : '' }}">
                            <td>{{ $i }}</td>
                            <td>{{ $K1['nama_item'] }}</td>
                            <td>{{ $K1['jumlah'] }}</td>
                            <td>{{ $K1['support_persen'] }}%</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if (count($kandidat1) >= 10 && count($kandidat1) != $stopLoadKandidat1)
                <button wire:click.prevent="loadKandidat1" class="btn btn-primary btn-sm btn-block mb-10">Tampilkan
                    Lebih
                    Banyak
                </button>
            @endif

            {{-- cek jika data large1 kosong --}}
            @empty($large1)
                <div class="alert alert-warning" role="alert">
                    Proses Berhenti dikarenakan tidak ada data yang melebihi minimum support <b>{{ $min_support }}%</b>
                    yang telah ditetapkan
                </div>
            @else
                <div class="clearfix mb-20 mt-5">
                    <div class="pull-left">
                        <h4 class="text-blue h4">L1 (Large 1-itemset)</h4>
                        <p class="mb-5"><small>Pola Frekuensi Tinggi (1-itemset)</small></p>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No </th>
                            <th scope="col">Item</th>
                            <th scope="col">Total</th>
                            <th scope="col">Support(%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($large1 as $L1)
                            <?php $i++; ?>
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $L1['nama_item'] }}</td>
                                <td>{{ $L1['jumlah'] }}</td>
                                <td>{{ $L1['support_persen'] }}%</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if (count($large1) >= 10 && count($large1) != $stopLoadLarge1)
                    <button wire:click.prevent="loadLarge1" class="btn btn-primary btn-sm btn-block">Tampilkan Lebih
                        Banyak
                    </button>
                @endif
            @endempty
        </div>
        <!-- Bordered table End -->
    </div>
    {{-- END ITERASI 1 --}}

    {{-- ITERASI 2 --}}
    @if (count($kandidat2) > 0)
        <div class="min-height-200px">
            <!-- Bordered table  start -->
            <div class="pd-20 card-box mb-30">
                <div class="clearfix mb-20">
                    <div class="pull-left">
                        <h4 class="text-blue h4">C2 (Kandidat 2-itemset)</h4>
                        <small>
                            <p>Jika terdapat tabel berwarna <code>Merah</code> maka item tersebut kurang dari batasan
                                minimum
                                support <strong>{{ $min_support }}%</strong>
                            </p>
                        </small>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No </th>
                            <th scope="col">Items</th>
                            <th scope="col">Total</th>
                            <th scope="col">Support(%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($kandidat2 as $K2)
                            <?php $i++; ?>
                            <tr class="{{ $K2['support_persen'] < $min_support ? 'table-danger' : '' }}">
                                <td>{{ $i }}</td>
                                <td>{{ $K2['nama_item'] }}</td>
                                <td>{{ $K2['jumlah'] }}</td>
                                <td>{{ $K2['support_persen'] }}%</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if (count($kandidat2) >= 10 && count($kandidat2) != $stopLoadKandidat2)
                    <button wire:click.prevent="loadKandidat2" class="btn btn-primary btn-sm btn-block mb-10">Tampilkan
                        Lebih
                        Banyak
                    </button>
                @endif

                {{-- cek jika data large2 kosong --}}
            @empty($large2)
                <div class="alert alert-warning" role="alert">
                    Proses Berhenti dikarenakan tidak ada data yang melebihi minimum support
                    <b>{{ $min_support }}%</b>
                    yang telah ditetapkan
                </div>
            @else
                <div class="clearfix mb-20 mt-5">
                    <div class="pull-left">
                        <h4 class="text-blue h4">L2 (Large 2-itemset)</h4>
                        <p class="mb-5"><small>Pola Frekuensi Tinggi (2-itemset)</small></p>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No </th>
                            <th scope="col">Items</th>
                            <th scope="col">Total</th>
                            <th scope="col">Support(%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($large2 as $L2)
                            <?php $i++; ?>
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $L2['nama_item'] }}</td>
                                <td>{{ $L2['jumlah'] }}</td>
                                <td>{{ $L2['support_persen'] }}%</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if (count($large2) >= 10 && count($large2) != $stopLoadLarge2)
                    <button wire:click.prevent="loadLarge2" class="btn btn-primary btn-sm btn-block">Tampilkan Lebih
                        Banyak
                    </button>
                @endif
            @endempty
        </div>
        <!-- Bordered table End -->
    </div>
@endif
{{-- END ITERASI 2 --}}

{{-- ATURAN ASOSIASI 2 ITEMSET --}}
<livewire:aturan-asosiasi.rule-dua-item />
{{-- END ATURAN ASOSIASI 2 ITEMSET --}}

{{-- ITERASI 3 --}}
@if (count($kandidat3) && count($large1) && count($large2) > 0)
    <div class="min-height-200px">
        <div class="pd-20 card-box mb-30">
            <div class="clearfix mb-20">
                <div class="pull-left">
                    <h4 class="text-blue h4">C3 (Kandidat 3-itemset)</h4>
                    <small>
                        <p>Jika terdapat tabel berwarna <code>Merah</code> maka item tersebut kurang dari batasan
                            minimum
                            support <strong>{{ $min_support }}%</strong>
                        </p>
                    </small>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No </th>
                        <th scope="col">Items</th>
                        <th scope="col">Total</th>
                        <th scope="col">Support(%)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0; ?>
                    @foreach ($kandidat3 as $K3)
                        <?php $i++; ?>
                        <tr class="{{ $K3['support_persen'] < $min_support ? 'table-danger' : '' }}">
                            <td>{{ $i }}</td>
                            <td>{{ $K3['nama_item'] }}</td>
                            <td>{{ $K3['jumlah'] }}</td>
                            <td>{{ $K3['support_persen'] }}%</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if (count($kandidat3) >= 10 && count($kandidat3) != $stopLoadKandidat3)
                <button wire:click.prevent="loadKandidat3"
                    class="btn btn-primary btn-sm btn-block mb-10">Tampilkan
                    Lebih
                    Banyak
                </button>
            @endif

        @empty($large3)
            <div class="alert alert-warning" role="alert">
                Proses Berhenti dikarenakan tidak ada data yang melebihi minimum support
                <b>{{ $min_support }}%</b>
                yang telah ditetapkan
            </div>
        @else
            <div class="clearfix mb-20 mt-5">
                <div class="pull-left">
                    <h4 class="text-blue h4">L3 (Large 3-itemset)</h4>
                    <p class="mb-5"><small>Pola Frekuensi Tinggi (3-itemset)</small></p>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No </th>
                        <th scope="col">Items</th>
                        <th scope="col">Total</th>
                        <th scope="col">Support(%)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0; ?>
                    @foreach ($large3 as $L3)
                        <?php $i++; ?>
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $L3['nama_item'] }}</td>
                            <td>{{ $L3['jumlah'] }}</td>
                            <td>{{ $L3['support_persen'] }}%</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if (count($large3) >= 10 && count($large3) != $stopLoadLarge3)
                <button wire:click.prevent="loadLarge3" class="btn btn-primary btn-sm btn-block">Tampilkan Lebih
                    Banyak
                </button>
            @endif
        @endempty
    </div>
</div>
@endif
{{-- END ITERASI 3 --}}

{{-- ATURAN ASOSIASI 3 ITEMSET --}}
<livewire:aturan-asosiasi.rule-tiga-item />
{{-- END ATURAN ASOSIASI 3 ITEMSET --}}

</div>
