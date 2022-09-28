@extends('layouts.app')

@section('title', 'Dashboard')

@push('css')
@endpush

@section('content')
    <div class="pd-ltr-20">
        <div class="row">
            <div class="col-xl-6 mb-30">
                <div class="card-box height-100-p widget-style1">
                    <div class="d-flex flex-wrap align-items-center">
                        <div class="progress-data">
                            <div id="chart"></div>
                        </div>
                        <div class="widget-data">
                            <div class="h4 mb-0">TOTAL</div>
                            <div class="weight-600 font-14">Transaksi</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 mb-30">
                <div class="card-box height-100-p widget-style1">
                    <div class="d-flex flex-wrap align-items-center">
                        <div class="progress-data">
                            <div id="chart2"></div>
                        </div>
                        <div class="widget-data">
                            <div class="h4 mb-0">TOTAL</div>
                            <div class="weight-600 font-14">Barang</div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-xl-3 mb-30">
                <div class="card-box height-100-p widget-style1">
                    <div class="d-flex flex-wrap align-items-center">
                        <div class="progress-data">
                            <div id="chart3"></div>
                        </div>
                        <div class="widget-data">
                            <div class="h4 mb-0">350</div>
                            <div class="weight-600 font-14">Campaign</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 mb-30">
                <div class="card-box height-100-p widget-style1">
                    <div class="d-flex flex-wrap align-items-center">
                        <div class="progress-data">
                            <div id="chart4"></div>
                        </div>
                        <div class="widget-data">
                            <div class="h4 mb-0">$6060</div>
                            <div class="weight-600 font-14">Worth</div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="row">
            <div class="col-xl-12 mb-30">
                <div class="card-box height-100-p pd-20">

                    <div class="clearfix mb-20">
                        <div class="pull-left">
                            <h4 class="text-blue h4">10 Penjualan Terlaris</h4>
                        </div>
                        <div class="pull-right">
                            <small class="">{{ $tglAwal }} - {{ $tglAkhir }}</small>
                        </div>
                    </div>
                    <div id="dril-data-transaksi"></div>
                    <div id="pie-data-transaksi"></div>
                </div>
            </div>
            {{-- <div class="col-xl-5 mb-30">
                <div class="card-box height-100-p pd-20">
                    <h2 class="h4 mb-20">5 Penjualan Terendah</h2>
                    <div id="pie-data-transaksi"></div>
                </div>
            </div> --}}
        </div>

    </div>


@endsection

@push('js')
    {{-- <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script src="https://code.highcharts.com/modules/cylinder.js"></script> --}}
    {{-- https://jsfiddle.net/gh/get/library/pure/highcharts/highcharts/tree/master/samples/highcharts/demo/3d-pie-donut --}}
    <script src="{{ asset('js/highcharts/highcharts.js') }}"></script>
    <script src="{{ asset('js/highcharts/highcharts-3d.js') }}"></script>
    {{-- <script src="{{ asset('js/highcharts/cylinder.js') }}"></script> --}}

    {{-- reference : https://onlinewebtutorblog.com/line-graph-integration-with-laravel-8-tutorial-example/
    reference : https://www.highcharts.com/docs/chart-concepts/series --}}

    <script>
        Highcharts.chart('pie-data-transaksi', {
            chart: {
                type: 'pie',
                options3d: {
                    enabled: true,
                    alpha: 45
                }
            },
            credits: {
                enabled: false
            },
            title: false,
            plotOptions: {
                pie: {
                    innerSize: 100,
                    depth: 45
                }
            },
            series: [{
                name: 'Total',
                data: {!! json_encode($chart_terlaris) !!}
            }]
        });
    </script>
    <script>
        Highcharts.chart('dril-data-transaksi', {
            chart: {
                type: 'column',
                // options3d: {
                // enabled: true,
                // alpha: 15,
                // beta: 15,
                // depth: 50,
                // viewDistance: 25
                // }
            },
            credits: {
                enabled: false
            },

            title: false,

            yAxis: {
                title: false
            },
            legend: {
                enabled: false
            },

            xAxis: {
                type: 'category'
            },

            plotOptions: {
                series: {
                    depth: 25,
                    alpha: 15,
                    beta: 15,
                    colorByPoint: true
                }
            },

            series: [{
                type: 'column',
                name: 'Total',
                data: {!! json_encode($chart_terlaris) !!}
            }]
        });
    </script>

    <script src="{{ asset('assets/src/plugins/apexcharts/apexcharts.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/vendors/scripts/dashboard.js') }}"></script> --}}
    {{-- https://apexcharts.com/javascript-chart-demos/radialbar-charts/gradient/ --}}
    <script>
        var options = {
            series: [{!! json_encode($transaksiCount) !!}],
            grid: {
                padding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 0
                },
            },
            chart: {
                height: 100,
                width: 70,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: '50%',
                    },
                    dataLabels: {
                        name: {
                            show: false,
                            color: '#fff'
                        },
                        value: {
                            show: true,
                            color: '#333',
                            offsetY: 5,
                            fontSize: '15px',
                            // ----------------
                            formatter: function(val) {
                                return parseInt(val);
                            },
                        }
                    }
                }
            },
            colors: ['#ecf0f4'],
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    type: 'diagonal1',
                    shadeIntensity: 0.8,
                    gradientToColors: ['#1b00ff'],
                    inverseColors: false,
                    opacityFrom: [1, 0.2],
                    opacityTo: 1,
                    stops: [0, 100],
                }
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0,
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0,
                    }
                },
                active: {
                    filter: {
                        type: 'none',
                        value: 0,
                    }
                },
            }
        };


        var options2 = {
            series: [{!! json_encode($barangCount) !!}],
            grid: {
                padding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 0
                },
            },
            chart: {
                height: 100,
                width: 70,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: '50%',
                    },
                    dataLabels: {
                        name: {
                            show: false,
                            color: '#fff'
                        },
                        value: {
                            show: true,
                            color: '#333',
                            offsetY: 5,
                            fontSize: '15px',
                            // ----------------
                            formatter: function(val) {
                                return parseInt(val);
                            },
                        }
                    }
                }
            },
            colors: ['#ecf0f4'],
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    type: 'diagonal1',
                    shadeIntensity: 1,
                    gradientToColors: ['#009688'],
                    inverseColors: false,
                    opacityFrom: [1, 0.2],
                    opacityTo: 1,
                    stops: [0, 100],
                }
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0,
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0,
                    }
                },
                active: {
                    filter: {
                        type: 'none',
                        value: 0,
                    }
                },
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

        var chart2 = new ApexCharts(document.querySelector("#chart2"), options2);
        chart2.render();
    </script>
@endpush
