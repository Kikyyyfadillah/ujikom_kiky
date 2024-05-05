@extends('template/layout')

@push('stytle')
@endpush

@section('content')

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="row" style="display: inline-block;">
            <div class="top_tiles">
                <div class="header">
                    <p style="font-size: 30px;"><strong>Halo, Selamat datang di MoodCafe</strong> </br></p>
                </div>
            </div>
            <div class="animated flipInY col-lg-4 col-md-3 col-sm-5 ">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-users"></i></div>
                    <div class="count">{{$count_pelanggan}}</div>
                    <h3>Pelanggan</h3>
                </div>
            </div>
            <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 ">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-credit-card"></i></div>
                    <div class="count">{{$count_transaksi}}</div>
                    <h3>Transaksi</h3>
                </div>
            </div>
            <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 ">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-money-bill-wave"></i></div>
                    <div class="count" style="font-size: 30px;">Rp. {{ number_format($pendapatan, 0, ',', '.') }}</div>
                    <h3>Pendapatan</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Transaction Summary <small>Weekly progress</small></h2>
                    <div class="filter">
                        <!-- Elemen input tanggal -->
                        <form action="{{ route('grafik.index') }}" method="GET">
                            <label for="tanggal_mulai">Tanggal Mulai:</label>
                            <input type="date" id="tanggal_mulai" name="tanggal_mulai">

                            <label for="tanggal_selesai">Tanggal Selesai:</label>
                            <input type="date" id="tanggal_selesai" name="tanggal_selesai">

                            <button type="submit">Filter</button>
                        </form>
                    </div>
                    <div class="clearfix"></div>
                </div>

                        <!-- Grafik dan data lainnya -->
                        <div class="demo-container" style="height:280px">
                            <div id="chart_plot_02" class="demo-placeholder"></div>
                        </div>
                        <div class="tiles">
                            <div class="col-md-4 tile">
                                <span>Total Transaksi</span>
                                <h2>{{ $count_transaksi }}</h2>
                                <span class="sparkline11 graph" style="height: 140px;">
                                    <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                </span>
                            </div>
                            <div class="col-md-4 tile">
                                <span>Total Pendapatan</span>
                                <h2>Rp. {{ number_format($pendapatan, 0, ',', '.') }}</h2>
                                <span class="sparkline22 graph" style="height: 160px;">
                                    <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                </span>
                            </div>
                            <div class="col-md-4 tile">
                                <span>Total Pelanggan</span>
                                <h2>{{ $count_pelanggan }}</h2>
                                <span class="sparkline11 graph" style="height: 160px;">
                                    <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- jumlah penjualan teratas -->
                <div class="col-md-3 col-sm-8 ">
                    <div>
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Top 5 Penjualan</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <ul class="list-unstyled top_profiles scroll-view">
                                @foreach ($detailTransaksi as $p)
                                <li class="media event">
                                    <a>
                                        <img width="70px" src="{{asset('image')}}/{{ $p->menu-> image }}" alt="" style="margin-right: 20px;">
                                    </a>
                                    <div class="media-body">
                                        <a class="title" style="font-size: 18px;">Menu : {{ $p->menu->nama_menu}}</a>
                                        <p style="font-size: 14px;"><strong> Harga : Rp. {{ number_format($p->menu->harga, 0, ',', '.') }}</strong></p>
                                        </p>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- jumlah pelanggan teratas -->
                <div class="col-md-4 col-sm-12 ">
                    <div>
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Top 5 Pelanggan</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <ul class="list-unstyled top_profiles scroll-view">
                                @foreach ($pelanggan as $p)
                                <li class="media event">
                                    <a class="pull-left border-aero profile_thumb">
                                        <i class="fa fa-user aero"></i>
                                    </a>
                                    <div class="media-body">
                                        <a class="title">{{ $p->nama }}</a>
                                        <p><strong>{{ $p->email }}</strong><strong> | +{{ $p->no_tlp }}</strong></p>
                                        <p>
                                            <medium>{{ $p->alamat }}</medium>
                                        </p>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>


                <!-- jumlah stok terendah -->
                <div class="col-md-4 col-sm-12 ">
                    <div>
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Stok Menu</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <ul class="list-unstyled top_profiles scroll-view">
                                @foreach ($stok as $p)
                                <li class="media event">
                                    <a>
                                        <img width="70px" src="{{asset('image')}}/{{ $p->menu-> image }}" alt="" style="margin-right: 20px;">
                                    </a>
                                    <div class="media-body">
                                        <a class="title" style="font-size: 18px;">Menu : {{ $p->menu->nama_menu}}</a>
                                        <p style="font-size: 14px;"><strong>Stok : {{ $p->jumlah }}</strong></p>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- jumlah penjualan teratas -->
                <div class="col-md-4 col-sm-12 ">
                    <div>
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Transaksi Terakhir</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <ul class="list-unstyled top_profiles scroll-view">
                                @foreach ($detailTransaksi as $p)
                                <li class="media event">
                                    <a>
                                        <img width="70px" src="{{asset('image')}}/{{ $p->menu-> image }}" alt="" style="margin-right: 20px;">
                                    </a>
                                    <div class="media-body">
                                        <a class="title" style="font-size: 18px;">{{ $p->menu->nama_menu }}</a>
                                        <p style="font-size: 14px;"><strong>Rp. {{ number_format($p->transaksi->total_harga, 0, ',', '.') }}</strong></p>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- /page content -->

@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('chart_transaksi').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: json_encode($labels),
            datasets: [{
                label: 'Jumlah Transaksi',
                data: json_encode($data),
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
@endpush