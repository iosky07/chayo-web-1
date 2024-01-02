<x-app-layout>
        <section class="section">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Pelanggan</h4>
                            </div>
                            <div class="card-body">
                                {{ $customer }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>News</h4>
                            </div>
                            <div class="card-body">
                                42
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Reports</h4>
                            </div>
                            <div class="card-body">
                                1,201
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Online Users</h4>
                            </div>
                            <div class="card-body">
                                47
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-statistic-2">
                        <div class="card-stats">
                            <div class="card-stats-title">Order Statistics -
                                <div class="dropdown d-inline">
                                    <a class="font-weight-600 dropdown-toggle" data-toggle="dropdown" href="#" id="orders-month">August</a>
                                    <ul class="dropdown-menu dropdown-menu-sm">
                                        <li class="dropdown-title">Select Month</li>
                                        <li><a href="#" class="dropdown-item">January</a></li>
                                        <li><a href="#" class="dropdown-item">February</a></li>
                                        <li><a href="#" class="dropdown-item">March</a></li>
                                        <li><a href="#" class="dropdown-item">April</a></li>
                                        <li><a href="#" class="dropdown-item">May</a></li>
                                        <li><a href="#" class="dropdown-item">June</a></li>
                                        <li><a href="#" class="dropdown-item">July</a></li>
                                        <li><a href="#" class="dropdown-item active">August</a></li>
                                        <li><a href="#" class="dropdown-item">September</a></li>
                                        <li><a href="#" class="dropdown-item">October</a></li>
                                        <li><a href="#" class="dropdown-item">November</a></li>
                                        <li><a href="#" class="dropdown-item">December</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-icon shadow-primary bg-primary">
                                <i class="fas fa-archive"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Sisa Tagihan Bulan Lalu</h4>
                                </div>
                                <div class="card-body">
                                    Rp. {{ number_format($prev_months, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-archive"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Tagihan Bulan Ini</h4>
                            </div>
                            <div class="card-body">
                                Rp. {{ number_format($this_month, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-statistic-2">
                        <div class="card-chart">
                            <canvas id="balance-chart" height="80"></canvas>
                        </div>
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Tagihan</h4>
                            </div>
                            <div class="card-body">
                                Rp. {{ number_format($sum_total_bill, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <x-slot name="header_content">
                <h1>Dashboard</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Layout</a></div>
                    <div class="breadcrumb-item">Default Layout</div>
                </div>
            </x-slot>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </section>
</x-app-layout>
